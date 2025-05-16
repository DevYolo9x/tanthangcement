@extends('homepage.layout.home')

@section('content')

    {!! htmlBreadcrumb($seo['meta_title']) !!}

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

                        <input type="text" class="form-control w-50" name="keyword" value="{{ request()->keyword }}"

                            placeholder="Nhập tên hoặc mã" style="display: inline-block">

                        

                        <button class="btn btn-info">Tìm kiếm</button>

                    </form>

                    <a href="{{ route('patient.create') }}" class="btn btn-info add-patient"

                        style="background: var(--primary-color)">

                        + <span>Thêm mới</span>

                    </a>

                </div>



                <div class="main-box clearfix">

                    @if (isset($data) && count($data))

                        <div class="table-responsive">

                            <table class="table user-list">

                                <thead>

                                    <tr>

                                        <th><span>Họ và tên</span></th>

                                        <th><span>Ngày lắp</span></th>

                                        <th><span>Ngày hết hạn</span></th>

                                        <th><span>Số lượng</span></th>

                                        <th class="text-center"><span>#</span></th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($data as $item)

                                        <tr>

                                            <td>

                                                <a href="javascript:void(0)" class="user-link">{{ $item->name }}</a>

                                            </td>

                                            <td>

                                                {{ date('d-m-Y', strtotime($item->installation_date)) }}

                                            </td>

                                            <td>

                                                {{ date('d-m-Y', strtotime($item->expiration_date)) }}

                                            </td>

                                            <td>

                                                {{ $item->quantity }}

                                            </td>

                                            <td class="text-center">

                                                <a href="{{ route('patient.edit', ['id' => $item->id]) }}"

                                                    class="table-link">

                                                    <span class="fa-stack">

                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 6L8 12V16H12L18 10M14 6L17 3L21 7L18 10M14 6L18 10M10 4L4 4L4 20L20 20V14" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

                                                    </span>

                                                </a>

                                                <a href="javascript:void(0)" onclick="deleteUser({{ $item->id }}, this)"

                                                    class="table-link danger">

                                                    <span class="fa-stack" style="background: #fe635f;">

                                                        <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></g></svg>

                                                    </span>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="wow fadeInUp">{!! $data->links() !!}</div>

                    @else

                        <p>Không có bệnh nhân!</p>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection



@push('css')

    <link rel="stylesheet" href="{{ asset('frontend/css/customer.css') }}">

    <style>

        .home-form {

            display: none;

        }

        .form-flex {

            display: flex;

            align-items: center;

            justify-content: space-between;

        }



        .form-flex form {

            display: flex;

            align-items: center;

            width: 40%;

            white-space: nowrap;

        }



        .form-flex input {

            font-size: 14px;

            height: 37px;

            margin-right: 10px;

        }



        .form-flex button {}

    </style>

@endpush



@push('javascript')

<script>

    function deleteUser(id, el) {

        if (confirm("Bạn có muốn xoá người bệnh không?") == true) {

            var url = BASE_URL + 'thanh-vien/benh-nhan/delete/'+id

            $.ajax({

                url: url,

                type: 'POST',

                data: {

                    id: id,

                    _token : $('meta[name="csrf-token"]').attr('content')

                },

                success: function(res) {

                    alert('Xoá thành công!');

                    el.parents('tr').remove();

                },

                error: function(err) {

                    alert('Có lỗi xảy ra, vui lòng thử lại sau!');

                }

            });

        } 



    }

</script>

@endpush

