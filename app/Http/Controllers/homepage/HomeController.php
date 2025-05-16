<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Components\Comment;
use App\Components\System;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Components\Nestedsetbie;
use App\Components\Helper;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

use App\Events\AloneEvent;

class HomeController extends Controller
{
    protected $comment;
    protected $system;
    protected $Nestedsetbie;
    protected $Helper;

    public function __construct()
    {
        $this->comment = new Comment();
        $this->system = new System();
        $this->Helper = new Helper();
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_products'));
    }
    public function index()
    {
        $fcSystem = $this->system->fcSystem();
        $slideFeedback = getSlider('testimonials');

        $homeNews = \App\Models\CategoryArticle::select('id', 'title', 'slug', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
            ->with(['posts'])
            ->get()
            ->map(function($query) {
                $query->setRelation('posts', $query->posts->take(6));
                return $query;
            });

            // dd($slideFeedback);
            
        $homeAdvantage = \App\Models\CategoryArticle::select('id', 'title', 'slug')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'highlight' => 1])
            ->with(['posts'])
            ->get()
            ->map(function($query) {
                $query->setRelation('posts', $query->posts->take(8));
                return $query;
            });
            
        $homeProducts = \App\Models\CategoryProduct::with('articlesRelationship')
            ->where([
                'alanguage' => config('app.locale'),
                'publish' => 0,
                'ishome' => 1
            ])
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($category) {
                $category->setRelation(
                    'products',
                    $category->articlesRelationship
                        ->where('alanguage', config('app.locale'))
                        ->where('publish', 0)
                        ->sortByDesc('id')
                        ->take(10)
                        ->values()
                );
                return $category;
            });

        if( request()->view == 'admin' ) {
            $dev = \App\Models\CategoryProduct::with('articlesRelationship')
                ->where([
                    'alanguage' => config('app.locale'),
                    'publish' => 0,
                    'ishome' => 1
                ])
                ->orderBy('order', 'asc')
                ->take(3)
                ->get()
                ->map(function ($category) {
                    $category->setRelation(
                        'products',
                        $category->articlesRelationship
                            ->where('alanguage', config('app.locale'))
                            ->where('publish', 0)
                            ->sortByDesc('id')
                            ->take(10)
                            ->values()
                    );
                    return $category;
                });
            dd($dev);
        }

        //page: HOME
        $page = Page::with('fields')->where(['alanguage' => config('app.locale'), 'page' => 'index', 'publish' => 0])->select('id', 'title', 'image', 'meta_title', 'meta_description')->first();
        $fields = [];
        if (!empty($page->fields) && count($page->fields) > 0) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }

        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        return view('homepage.home.index', compact('page', 'seo', 'fcSystem', 'slideFeedback', 'homeNews', 'homeProducts', 'homeAdvantage'));
    }

    public function api()
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=Hanoi&appid=886705b4c1182eb1c69f28eb8c520e20';
        $requestURL = Http::get($url);
        if ($requestURL->status() === 200) {
            $response = $requestURL->getBody()->getContents();
            $response_json = json_decode($response);
            dd($response_json);
        } else {
            echo 'Error';
            die;
        }
    }

    public function crawler()
    {

        $url = 'https://www.thegioididong.com/dtdd';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $data = [];
        $i = 0;
        $crawler->filter('ul.homeproduct li.item')->each(
            function (Crawler $node) {
                $data['name'] = $node->filter('h3')->text();
                $data['price'] = $node->filter('.price strong')->text();
                $data['wholeStar'] = $node->filter('.icontgdd-ystar')->count();
                $data['halfStar'] = $node->filter('.icontgdd-hstar')->count();
                $data['rate'] = $data['wholeStar'] + 0.5 * $data['wholeStar'];
            }
        );
        dd($data);
    }

    public function sitemap()
    {
        /*
        $Tags = \App\Models\Tag::select('id', 'slug', 'created_at')->where('alanguage', config('app.locale'))->where('publish', 0)->get();
        $Brands = \App\Models\Brand::select('id', 'slug', 'created_at')->where('alanguage', config('app.locale'))->where('publish', 0)->get(); */
        $router = DB::table('router')->select('slug', 'created_at')->get();
        return response()->view('homepage.home.sitemap', compact('router'))->header('Content-Type', 'text/xml');
    }
    public function wishlist_index()
    {
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], TRUE) : NULL;

        if (!empty($wishlist)) {
            $data = \App\Models\Product::select('products.id', 'products.title', 'products.image_json', 'products.image', 'products.slug', 'products.price', 'products.price_sale', 'products.price_contact')
                ->where(['products.alanguage' => config('app.locale'), 'products.publish' => 0])
                ->whereIn('products.id', $wishlist)
                ->orderBy('products.order', 'asc')
                ->orderBy('products.id', 'desc')
                ->with('getTags')
                ->get();
        } else {
            $data = [];
        }


        $fcSystem = $this->system->fcSystem();
        $seo['canonical'] = route('homepage.wishlist_index');
        $seo['meta_title'] = "Danh sách sản phẩm yêu thích";
        $seo['meta_description'] = "Danh sách sản phẩm yêu thích";
        return view('homepage.home.wishlist', compact('seo', 'fcSystem', 'data'));
    }
    public function wishlist(Request $request)
    {
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], TRUE) : NULL;
        $quantity = $wishlist ? count($wishlist) : 0;
        $productID = $request->id;
        $type = 'add';
        $alert = [
            'alert' => trans('index.Notification'),
            'message' => '',
            'status' => 400,
            'type' => '',
        ];
        if (!empty($wishlist)) {
            if (in_array($productID, $wishlist)) {
                $filtered = collect($wishlist)->filter(function ($value, $key) use ($productID) {
                    return $value != $productID;
                });
                $type = 'remove';
                $quantity--;
                setcookie('wishlist', json_encode($filtered), time() + (86400 * 30), '/');
                $alert['message'] = trans('index.RemoveFavorite');
                $alert['type'] = $type;
                return response()->json($alert);
            } else {
                $cookie = collect($wishlist)->push($request->id)->all();
                $quantity++;
                setcookie('wishlist', json_encode($cookie), time() + (86400 * 30), '/');
                $alert['message'] = trans('index.AddFavorite');
                $alert['status'] = 200;
                $alert['type'] = $type;
                return response()->json($alert);
            }
        } else {
            $quantity++;
            setcookie('wishlist', json_encode(array($request->id)), time() + (86400 * 30), '/');
            $alert['message'] = trans('index.AddFavorite');
            $alert['status'] = 200;
            $alert['type'] = $type;
            return response()->json($alert);
        }
    }

    public function wishlist_old(Request $request)
    {
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], TRUE) : NULL;
        $quantity = $wishlist ? count($wishlist) : 0;
        $productID = $request->id;
        if (!empty($wishlist)) {
            if (in_array($request->id, $wishlist)) {
                $filtered = collect($wishlist)->filter(function ($value, $key) use ($productID) {
                    return $value != $productID;
                });
                $quantity--;
                setcookie('wishlist', json_encode($filtered), time() + (86400 * 30), '/');
                return response()->json(['message' => 'Xóa sản phẩm khỏi Danh sách sản phẩm yêu thích thành công', 'status' => 400, 'quantity' => $quantity]);
            } else {
                $cookie = collect($wishlist)->push($request->id)->all();
                $quantity++;
                setcookie('wishlist', json_encode($cookie), time() + (86400 * 30), '/');
                return response()->json(['message' => 'Thêm sản phẩm vào Danh sách sản phẩm yêu thích thành công', 'status' => 200, 'quantity' => $quantity]);
            }
        } else {
            $quantity++;
            setcookie('wishlist', json_encode(array($request->id)), time() + (86400 * 30), '/');
            return response()->json(['message' => 'Thêm sản phẩm vào Danh sách sản phẩm yêu thích thành công', 'status' => 200, 'quantity' => $quantity]);
        }
    }

    public function sentStore( Request $request ) {
        $message = $request->query->get('message', 'Hey guys!');
         event(new AloneEvent($message));

         return "Message \" $message \" has been sent.";
    }

    public function sents () {

        return view('homepage.home.sent');
    }
}