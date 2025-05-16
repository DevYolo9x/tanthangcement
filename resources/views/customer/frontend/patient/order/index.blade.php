@extends('homepage.layout.home')

@section('content')

    {!! htmlBreadcrumb($seo['meta_title']) !!}

    <?php
    $product = request()->product;
    ?>

    <div class="container page-customer wow fadeInUp">

        <div class="row">

            @include('customer/frontend/auth/common/sidebar')

            <?php

            $success = session('success');

            $error = session('error');

            ?>

            <div class="col-md-9">

                {!! alertSuccess($success) !!}

                {!! alertError($error) !!}

                <div class="form-flex">

                    <form action="" class="">

                        <div class="input-group input-daterange group-top">
                            <input type="text" class="form-control date date-control" value="{{ request()->start_date }}" name="start_date" >
                            <span class="input-group-addon">đến</span>
                            <input type="text" class="form-control date date-control" value="{{ request()->end_date }}" name="end_date" >
                        </div>

                        <div class="group-bottom">
                            <div class="left-box">
                                <div class="search-product">
                                    <select name="product" class="form-control select2">
                                        <option value="">-- Sản phẩm --</option>
                                        @foreach ($products as $id => $item)
                                            <option value="{{ $item['id'] }}" {{ $item['id'] == $product ? 'selected' : '' }}>{{ $item['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="text" class="form-control" name="keyword" value="{{ request()->keyword }}"

                                       placeholder="Nhập tên hoặc mã" style="display: inline-block">


                                <button class="btn btn-info">Tìm kiếm</button>
                            </div>

{{--                            <a href="{{ route('patientBuy.create') }}" class="btn btn-info add-patient" style="background: var(--primary-color)">+ <span>Thêm mới</span></a>--}}
                        </div>
                    </form>
                </div>

                <div class="main-box clearfix">
                    @if( $product )
                        <div class="totalPatient form-control">
                            <h3>Thống kê số lượng:</h3>
                            <div>Tổng số lượng đã mua: <b class="text-danger"> {{ App\Models\Patient_payment_items::getTotalQty($product, Auth::guard('customer')->user()->id) }}</b></div>
                            <div>Tổng số lượng đã bán: <b class="text-danger">{{ App\Models\Patient::getTotalQtyBought($product, Auth::guard('customer')->user()->id) }}</b></div>
                            <div>Tổng số lượng còn lại: <b class="text-danger">{{ App\Models\Patient_payment_items::getTotalQty($product, Auth::guard('customer')->user()->id) - App\Models\Patient::getTotalQtyBought($product, Auth::guard('customer')->user()->id) }}</b></div>
                        </div>
                    @endif

                    @if (isset($data) && count($data))

                        <div class="table-responsive">

                            <table class="table user-list">

                                <thead>

                                <tr>

                                    <th style="padding-left: 0"><span>Mô tả</span></th>

                                    <th style="padding-left: 0"><span>Sản phẩm</span></th>

                                    <th class="text-center"><span>Thời gian</span></th>

                                    {{--<th class="text-center"><span>#</span></th>--}}

                                </tr>

                                </thead>

                                <tbody>

                                @foreach ($data as $item)

                                    <tr>

                                        <td>
                                            <div class="text-body"><b>{!! $item->title !!}</b></div>
                                        </td>

                                        <td>

                                            <a href="javascript:void(0)" class="user-link">
                                                @foreach( $item->payment_items as $payment_item )
                                                    <?php
                                                    $product = json_decode($payment_item->data_json);
                                                    ?>
                                                    @if( $product )
                                                        <div class="payment-item">
                                                            <span class="title">{!! $product->title !!}</span>
                                                            <span class="qty text-danger">SL: {!! $payment_item->quantity !!}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </a>

                                        </td>

                                        <td class="text-center">

                                            {{ date('d-m-Y', strtotime($item->created_at)) }}

                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="wow fadeInUp">{!! $data->links() !!}</div>

                    @else

                        <p>Không có đơn hàng!</p>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            font-size: 14px;
            line-height: 15px;
            height: 38px;
        }
        .select2-container .select2-selection--single .select2-selection__arrow {
            width: 15px;
            height: 15px;
            top: 50%;
            margin-top: -7px;
        }
        .search-product {
            width: 30%;
        }
        .select2-results__option {
            font-size: 14px;
        }
        .form-flex .date-control {
            width: 20%;
            max-width: 20%;
        }
        @media (max-width: 767px) {
            .form-flex .date-control {
                width: 35%;
                max-width: 35%;
            }
            .form-flex .group-bottom {
                flex-wrap: wrap;
            }
            .form-flex .group-bottom .left-box {
                width: 100%;
            }
            .search-product {
                width: 35%;
            }
            .add-patient {
                margin-top: 10px;
            }
        }
    </style>

@endsection

@include('customer.frontend.patient.script')
