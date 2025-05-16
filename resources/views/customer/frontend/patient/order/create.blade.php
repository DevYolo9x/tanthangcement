@extends('homepage.layout.home')
@section('content')
    <?php
    $product = [];
    $maxQty = 0;
    if( old('product') ){
        $product = App\Models\Product::find(old('product'));
        $maxQty = $product->quantity;
    }

    ?>
    {!! htmlBreadcrumb($seo['meta_title']) !!}
    <div class="container page-customer wow fadeInUp">
        <div class="row">
            @include('customer/frontend/auth/common/sidebar')
            <div class="col-md-9">
                <div class="underline-tabs mb-5">
                    <ul class="nav nav-tabs" id="underlineTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-user-information" data-bs-toggle="tab"
                                    data-bs-target="#user-information" type="button" role="tab" aria-selected="true">
                                Thêm mới đơn hàng
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="underlineTabsContent">
                        <div class="tab-pane fade show active" id="patient-create" role="tabpanel">
                            <form action="{{ route('patientBuy.store') }}" method="POST" id="patientBuy">
                                @csrf

                                <div class="form-group">
                                    <label for="validationCode" class="form-label">Mô tả<sup>*</sup></label>
                                    <input type="text"
                                           class="form-control @if (checkErrorValidate($errors, 'title')) is-invalid @endif"
                                           value="{{ old('title') }}" id="validationTitle" name="title"
                                           aria-describedby="validationtitleFeedback">
                                    {!! renderErrorValidate($errors, 'title') !!}
                                </div>

                                <div id="select-container">
                                    @php
                                        $oldProducts = old('products', []);
                                        $oldQuantities = old('quantities', []);
                                    @endphp

                                    @if( $oldProducts )
                                        @foreach ($oldProducts as $i => $product)
                                            <div class="row mb-2">
                                                <div class="col-md-5 form-group">
                                                    <label class="form-label">Sản phẩm<sup>*</sup></label>
                                                    <select name="products[]" class="form-control select2">
                                                        @foreach ($products as $id => $item)
                                                            <option value="{{ $id }}" {{ $id == $product ? 'selected' : '' }}>{{ $item['text'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("products.$i")
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label">Số lượng<sup>*</sup> <span class="inventory badge rounded-pill bg-danger">(Số lượng nhỏ hơn {{getMaxQtyPatient($product)}})</span></label>
                                                    <input type="number" name="quantities[]" class="form-control" value="{{ $oldQuantities[$i] ?? '' }}">
                                                    @error("quantities.$i")
                                                    <small class="text-danger">{!! nl2br(e($message)) !!}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-1 form-group text-sm-end">
                                                    <label class="form-label w-100 opacity-0">Xoá</label>
                                                    <button type="button" class="btn btn-danger remove-btn header-top" style="min-width: unset;width: 100%;">x</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <button type="button" class="btn btn-info mb-3" id="add-select" style="background: var(--primary-color)">+ Thêm sản phẩm</button>

                                <div class="box-submit text-sm-end">
                                    <button type="submit" class="btn btn-info" style="background: var(--primary-color)" id="addBuy">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('customer.frontend.patient.script')
