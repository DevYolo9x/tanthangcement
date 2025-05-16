<?php
$pageLayMauXN = getPage('schedule_sampling');
$pageDatLichKham = getPage('schedule_an_appointment');
?>

<section class="block-service-selection wow fadeInUp">
    <div class="container">
        <div class="block-service-selection">
            <div class="block-content">
                <div class="block-title">
                    {!! $fcSystem['title_5'] !!}
                </div>

                @if( isset($pageLayMauXN) )
                    <div class="service-selection-item">
                        <div class="info">
                            <div class="images"> <img src="{{ showField($pageLayMauXN->fields, 'config_colums_input_img_select_service') }}" alt=""> </div>
                            <div class="detail">
                                <h3 class="title">{{ $pageLayMauXN->title }}</h3>
                                <div class="excerpt">{{ strip_tags($pageLayMauXN->description) }}</div>
                                <div class="actions"> <a href="{{ url('dat-lich-lay-mau') }}" class="btn btn-primary">Đặt lịch</a>
                                </div>
                            </div>
                            <div class="actions"> <a href="{{ url('dat-lich-lay-mau') }}" class="btn btn-primary">Đặt lịch</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if( isset($pageDatLichKham) )
                    <div class="service-selection-item">
                        <div class="info">
                            <div class="images"> <img src="{{ showField($pageDatLichKham->fields, 'config_colums_input_img_select_service') }}" alt=""> </div>
                            <div class="detail">
                                <h3 class="title">{{ $pageDatLichKham->title }}</h3>
                                <div class="excerpt">{{ strip_tags($pageDatLichKham->description) }}</div>
                                <div class="actions"> <a href="{{ url('dat-lich-kham') }}" class="btn btn-primary">Đặt lịch</a>
                                </div>
                            </div>
                            <div class="actions"> <a href="{{ url('dat-lich-kham') }}" class="btn btn-primary">Đặt lịch</a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="block-images">
                @if( isset($fcSystem['title_6']) )
                <img src="{{ asset($fcSystem['title_6']) }}" alt="bác sĩ lựa chọn dịch vụ">
                @endif
            </div>
        </div>
    </div>
</section>