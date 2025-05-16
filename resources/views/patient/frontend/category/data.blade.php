@if($data)
    <div class="flex flex-wrap justify-start mx-[-15px] mt-10">
        @foreach ($data as $k => $item)
        {!! htmlItemNews($item, '', 'lg:w-1/3', 'lg:w-2/3') !!}
        @endforeach
    </div>
    <div class="pagenavi wow fadeInUp mt-[20px]">
        <?php echo $data->links() ?>
    </div>
@endif