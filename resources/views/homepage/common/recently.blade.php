 <?php
    $recently_viewed = Session::get('products.recently_viewed');

    if (!empty($recently_viewed)) {
        $recentlyProduct = \App\Models\Product::select('products.id', 'products.title', 'products.image_json', 'products.image', 'products.slug', 'products.price', 'products.price_sale', 'products.price_contact')
            ->where(['products.alanguage' => config('app.locale'), 'products.publish' => 0])
            ->whereIn('products.id', $recently_viewed)
            ->orderBy('products.order', 'asc')
            ->orderBy('products.id', 'desc')
            ->with('getTags')
            ->get();
    }

    ?>
 @if(!empty($recentlyProduct))
 <section class="recently-view-product py-[30px] md:py-12 wow fadeInUp">
     <div class="">
         <h2 class="title-primary text-center text-f24 uppercase font-bold">
             Sản phẩm đã xem
         </h2>
         <div class="nav-recently-product mt-[20px] md:mt-[30px]">
             <div class="slider-product owl-carousel">
                 @foreach($recentlyProduct as $key=>$item)
                 <?php echo htmlItemProduct($key, $item) ?>

                 @endforeach
             </div>
         </div>
     </div>
 </section>
 @endif
