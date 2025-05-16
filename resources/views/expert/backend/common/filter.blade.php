<?php
if ($errors->any()) {
    $catalogue  = old('attribute_catalogue');
    $checkbox  = old('checkbox_val');
    $attribute = old('attribute');
} else if ($action == 'update') {
    $version_json = json_decode(base64_decode($detail->version_json), true);
    $checkbox = $version_json[0];
    $catalogue  = $version_json[1];
    $attribute = $version_json[2];
}
if (isset($title_version)) {
    $version = count($title_version);
} else {
    $version = 0;
}
?>
<div class="box p-5 mt-3 space-y-3 <?php if (!in_array('attributes', $dropdown)) { ?>hidden<?php } ?>">
    <div>
        <label class="form-label text-base font-medium">Bộ lọc sản phẩm</label>
    </div>
    <div class="ibox mb-5 block-version" data-countattribute_catalogue="<?php echo count($htmlAttribute) - 1 ?>">
        <div class="ibox-title">
            <div class="grid justify-between text-base  items-center">
                <div class="col-span-2">
                </div>
                <div class="text-right">
                    <a class="show-version btn btn-elevated-success px-3 py-1 text-white" href="javascript:void(0)" <?php echo (!empty($catalogue)) ? 'style="display:none"' : '' ?>>
                        <i data-lucide="plus" class="w-2/3 h-6 text-white"></i>
                    </a>
                    <a class="hide-version btn btn-danger px-3 py-1" href="javascript:void(0)" <?php echo (!empty($catalogue)) ? '' : 'style="display:none"' ?>>Đóng</a>
                </div>
            </div>
        </div>
        <div class="ibox-content mt-5" style=" <?php echo (!empty($catalogue)) ? '' : 'display:none"' ?>">
            <div class="block-attribute">
                <div class="mb-3 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="width: 30%;">Tên thuộc tính</td>
                                <td style="width: 50%;">Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy)</td>
                                <td style="width: 10%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($catalogue)) { ?>
                                <?php foreach ($catalogue as $key => $value) {
                                    if (isset($attribute_json[$key])) { ?>
                                        <tr data-id="<?php echo $value ?>" <?php echo (isset($checkbox[$key]) && $checkbox[$key] == 1) ? 'class="bg-choose"' : '' ?>>
                                            <td>
                                                <select class="form-control select3" name="attribute_catalogue[]" tabindex="-1" aria-hidden="true">
                                                    @foreach($htmlAttribute as $k=>$v)
                                                    <option value="{{$k}}" {{ $value == $k ? 'selected' : ''  }}>{{$v}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($value == 0) { ?>
                                                    <input type="text" class="form-control" disabled="disabled">
                                                <?php } else { ?>
                                                    <select name="attribute[<?php echo $key ?>][]" data-stt="{{$key}}" data-json="<?php echo (isset($attribute_json[$key])) ? base64_encode(json_encode($attribute_json[$key])) : '' ?>" data-condition="<?php echo $value ?>" class="form-control selectMultipe" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.." data-module="attributes" style="width: 100%;">
                                                    </select>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a type="button" class="text-danger delete-attribute" data-id="">
                                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true" style="fill: red;width:20px;height20px">
                                                        <path d="M8 3.994c0-1.101.895-1.994 2-1.994s2 .893 2 1.994h4c.552 0 1 .446 1 .997a1 1 0 0 1-1 .997h-12c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zm-3 10.514v-6.508h2v6.508a.5.5 0 0 0 .5.498h1.5v-7.006h2v7.006h1.5a.5.5 0 0 0 .5-.498v-6.508h2v6.508a2.496 2.496 0 0 1-2.5 2.492h-5c-1.38 0-2.5-1.116-2.5-2.492z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex" style="padding: 0px 20px 10px 0px;">
                    <a href="javascript:void(0)" data-attribute="<?php echo base64_encode(json_encode($htmlAttribute)) ?>" class="add-attribute btn btn-danger" data-id=""><i class="fa fa-plus"></i> Thêm thuộc tính cho sản phẩm
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    td.s_tdVariable {
    display: none;
}
</style>