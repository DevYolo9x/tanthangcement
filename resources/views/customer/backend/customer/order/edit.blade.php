@extends('dashboard.layout.dashboard')
@section('title')
    <title>Cập nhật đơn hàng</title>
@endsection
@section('breadcrumb')
    <?php
    $array = array(
        [
            "title" => "Danh sách đơn hàng",
            "src" => route('customerOrder.index', ['customerID' => $customerID]),
        ],
        [
            "title" => "Cập nhật",
            "src" => 'javascript:void(0)',
        ]
    );
    echo breadcrumb_backend($array);
    ?>
@endsection
@section('content')
    <div class="content">
        <div class=" flex items-center mt-8">
            <h1 class="text-lg font-medium mr-auto">
                Cập nhật đơn hàng
            </h1>
        </div>
        <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('customerOrder.update', ['customerID' => $customerID, 'orderID' => $detail->id])}}" method="post" enctype="multipart/form-data" id="patientBuy">
            <div class="col-span-12 md:col-span-4">
                <div class="box p-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-3">
                        <div class="font-medium text-base truncate">Thông tin người mua</div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <b>Họ và tên:</b> <span class=" decoration-dotted ml-1">{{$customer->name}}</span>
                        </div>
                        <div class="flex items-center">
                            <b>Số điện thoại:</b> <span class=" decoration-dotted ml-1">{{$customer->phone}}</span>
                        </div>
                        @if($customer->email)
                            <div class="flex items-center">
                                <b>Email:</b> <span class="decoration-dotted ml-1">{{$customer->email}}</span>
                            </div>
                        @endif
                        <div class="flex items-center">
                            <b>Địa chỉ:</b> <span class=" decoration-dotted ml-1">{{$customer->address}}</span>
                        </div>
                        @if(!empty($customer->ward_name->name))
                            <div class="flex items-center">
                                <b>Phường/Xã:</b> <span class=" decoration-dotted ml-1">{{$customer->ward_name->name}}</span>
                            </div>
                        @endif
                        @if(!empty($customer->district_name->name))
                            <div class="flex items-center">
                                <b>Quận/Huyện:</b> <span class=" decoration-dotted ml-1">{{$customer->district_name->name}}</span>
                            </div>
                        @endif
                        @if(!empty($customer->city_name->name))
                            <div class="flex items-center">
                                <b>Tỉnh/Thành phố:</b> <span class=" decoration-dotted ml-1">{{$customer->city_name->name}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-8">
                <div class="box p-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-3">
                        <div class="font-medium text-base truncate">Thông tin</div>
                    </div>
                    <div>
                        @csrf
                        <div class="form-group mt-2">
                            <label for="validationCode" class="form-label">Tên đơn hàng<sup>*</sup></label>
                            <input type="text" class="form-control" value="{{ $detail->title }}" id="validationTitle" name="title">
                            @error('title')
                            <small class="text-danger">{!! nl2br(e($message)) !!}</small>
                            @enderror
                        </div>

                        <div id="select-container">

                            @php
                                $oldProducts = !empty($data_payments['ids']) ? $data_payments['ids'] : old('products');
                                $oldQuantities = !empty($data_payments['quantities']) ? $data_payments['quantities'] : old('quantities');
                                $payment_id = !empty($data_payments['payment_id']) ? $data_payments['payment_id'] : [];
                            @endphp

                            @if( $oldProducts )
                                @foreach ($oldProducts as $i => $product)
                                    <div class="row grid grid-cols-12 gap-6 mt-3">
                                        <div class="ol-span-12 md:col-span-4 form-group">
                                            <label class="form-label">Sản phẩm<sup>*</sup></label>
                                            <select name="products[]" class="form-control select2">
                                                @foreach ($products as $id => $item)
                                                    <option value="{{ $item['id'] }}" {{ $item['id'] == $product ? 'selected' : '' }}>{{ $item['text'] }}</option>
                                                @endforeach
                                            </select>
                                            @error("products.$i")
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <input type="hidden" value="{{ $payment_id[$i] }}" name="ids[]">
                                        </div>
                                        <div class="col-span-12 md:col-span-6 form-group">
                                            <label class="form-label">Số lượng<sup>*</sup> <span class="badge bg-danger hidden inventory p-1 rounded-full rounded-pill text-white text-xs">(Số lượng nhỏ hơn {{getMaxQtyPatient($product)}})</span></label>
                                            <input type="number" name="quantities[]" class="form-control" value="{{ $oldQuantities[$i] ?? '' }}">
                                            @error("quantities.$i")
                                            <small class="text-danger">{!! nl2br(e($message)) !!}</small>
                                            @enderror
                                        </div>
                                        <div class="col-span-12 md:col-span-1 form-group text-sm-end">
                                            <label class="form-label w-100 opacity-0">Xoá</label>
                                            <button type="button" class="btn btn-danger remove-btn header-top" style="min-width: unset;width: 100%;">x</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <button type="button" class="btn btn-info mb-3 mt-3" id="add-select" style="background: var(--primary-color)">+ Thêm sản phẩm</button>
                    </div>
                    <div class="">
                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary" id="addBuy">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@include('customer.backend.customer.order.script')