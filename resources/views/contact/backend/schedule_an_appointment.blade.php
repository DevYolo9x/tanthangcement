@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh sách đặt lịch khám</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách đặt lịch khám",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')

<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách đặt lịch khám
    </h1>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @include('components.search',['module'=>$module])

        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        <th class="whitespace-nowrap">STT</th>
                        <th class="whitespace-nowrap">Họ và tên</th>
                        <th class="whitespace-nowrap">Số điện thoại</th>
                        <th class="whitespace-nowrap">Ngày đặt lịch</th>
                        <th class="whitespace-nowrap">Giờ đặt lịch</th>
                        <th class="whitespace-nowrap">Nội dung</th>
                        <th class="whitespace-nowrap">Ngày gửi</th>
                        <th class="whitespace text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        <td>
                            {{$data->firstItem()+$loop->index}}
                        </td>
                        <td>
                            <p><?php echo $v->fullname; ?></p>
                        </td>
                        <td>
                            <p><?php echo $v->phone; ?></p>
                        </td>
                        <td>
                            <p><?php echo date('d-m-Y', strtotime($v->date)); ?></p>
                        </td>
                        <td>
                            <p><?php echo $v->time_booinkg; ?></p>
                        </td>
                        <td>
                            {!! (!empty($v->subject)?$v->subject .'<br>':'') !!}
                            {{ !empty($v->message)?$v->message:'' }}
                        </td>
                        <td>
                            {{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3 openModal" onclick="openModal('<?php echo base64_encode(json_encode($v)) ?>')" href="javascript:void(0)" data-toggle="modal">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
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


<div id="myModal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Thông tin đặt lịch khám
                </h2>

            </div> <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Họ và tên</label>
                    <input type="text" class="form-control w-full modal_fullname" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Số điện thoại</label>
                    <input type="text" class="form-control w-full modal_phone" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Ngày sinh</label>
                    <input type="text" class="form-control w-full modal_birthday" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Email</label>
                    <input type="text" class="form-control w-full modal_email" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Giới tính</label>
                    <input type="text" class="form-control w-full modal_gender" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Tỉnh/Thành phố</label>
                    <input type="text" class="form-control w-full modal_city" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Quận/Huyện</label>
                    <input type="text" class="form-control w-full modal_district" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Địa chỉ</label>
                    <input type="text" class="form-control w-full modal_address" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Ngày khám</label>
                    <input type="text" class="form-control w-full modal_date" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-6">
                    <label class="form-label font-semibold">Thời gian</label>
                    <input type="text" class="form-control w-full modal_time_booking" value="" disabled>
                </div>
                <div class=" col-span-12 lg:col-span-12">
                    <label class="form-label font-semibold">Nội dung</label>
                    <textarea name="" class="form-control w-full modal_message" disabled></textarea>
                </div>
            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Đóng
                </button>
            </div> <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->


@endsection


@push('javascript')

<script>
    const myModal = tailwind.Modal.getInstance(document.querySelector("#myModal"));
    function openModal(data) {
        var json = JSON.parse(atob(data));
        $('.modal_fullname').val(json.fullname);
        $('.modal_phone').val(json.phone);
        $('.modal_birthday').val(json.birthday.split('-').reverse().join('-'));
        $('.modal_email').val(json.email);
        $('.modal_gender').val(json.gender);
        $('.modal_city').val(json.city);
        $('.modal_district').val(json.district);
        $('.modal_address').val(json.address);
        $('.modal_date').val(json.date.split('-').reverse().join('-'));
        $('.modal_time_booking').val(json.time_booinkg);
        $('.modal_message').val(json.message);
        myModal.show();
    }
</script>
    
@endpush