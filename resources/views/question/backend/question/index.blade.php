@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách câu hỏi</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách câu hỏi",
        "src" => route('questions.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách câu hỏi
    </h1>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @include('components.search',['module'=>$module,'htmlOption' => $htmlOption,'configIs' => $configIs])
            @can('questions_create')
            <a href="{{route('questions.create')}}" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            @endcan
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        @can('questions_destroy')
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        @endcan
                        <th>STT</th>
                        <th>TIÊU ĐỀ</th>
                        <th>VỊ TRÍ</th>
                        <th>DANH MỤC</th>
                        <th>NGƯỜI TẠO</th>
                        <th>NGÀY TẠO</th>
                        <th>HIỂN THỊ</th>
                        @include('components.table.is_thead')
                        <th>#</th>
                    </tr>
                </thead>
                <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
                    @foreach($data as $v)
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        @can('questions_destroy')
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        @endcan
                        <td>
                            {{$data->firstItem()+$loop->index}}
                        </td>
                        <td>
                            <div class="flex">
                                <div class="flex-1">
                                    <a href="{{ url( config('app.locale') == 'vi' ? $v->slug : config('app.locale').'/'.$v->slug ) }}" target="_blank" class=" text-primary font-medium"><?php echo $v->title; ?></a>
                                </div>
                            </div>
                        </td>
                        @include('components.order',['module' => $module])
                        <td class="whitespace-nowrap">
                            @if( isset($v->catalogues) )
                            <a class="text-danger" href="{{route('questions.index',['catalogueid' => $v->catalogues->id])}}">   {{$v->catalogues->title}}</a><br>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ isset($v->user->name) ? $v->user->name : 'Người dùng đặt câu hỏi' }}
                        </td>
                        <td>
                            @if($v->created_at)
                            {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        <td class="w-40">
                            @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                            $v->id])
                        </td>
                        @include('components.table.is_tbody')
                        <td class="table-report__action w-56 ">
                            <div class="flex justify-center items-center">
                                @can('questions_edit')
                                <a class="flex items-center mr-3" href="{{ route('questions.edit',['id'=>$v->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                @endcan
                                @can('questions_destroy')
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa câu hỏi, câu hỏi sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            {{$data->links()}}
        </div>
        <!-- END: Pagination -->
    </div>
</div>
@endsection