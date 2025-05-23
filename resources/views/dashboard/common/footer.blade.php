@yield('script-dashboard')

<script src="{{ asset('backend/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/jquery-2.2.2.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('library/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('library/sweetalert/sweetalert.min.js') }}"></script>
<link href="{{asset('library/select2/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('library/select2/select2.full.min.js')}}"></script>
<script src="{{asset('library/toastr/toastr.min.js')}}"></script>

<script>
    function sweet_error_alert(title, message) {
        swal({
            title: title,
            text: message
        });
    }
    setTimeout(function() {
        $('#rowthongbao').hide();
    }, 2000);
</script>
<script src="{{ asset('library/ckeditor/ckeditor.js') }}" charset="utf-8"></script>
<script src="{{ asset('backend/library/function.js?v=123928232') }}" type="text/javascript"></script>

<!-- test -->
<script src="{{asset('library/ckfinder/samples/js/sf.js')}}"></script>
<script src="{{asset('library/ckfinder/samples/js/tree-a.js')}}"></script>
<script src="{{asset('library/ckfinder/ckfinder.js')}}"></script>
<script>
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    $(document).on("click", ".img-thumbnail", function() {
        openKCFinder($(this), 'img-thumbnail')
    });

    // $(document).on("click", ".img-colors", function() {
    //     openKCFinder($(this), 'img-colors')
    // });

    /*chọn hình: openKCFinderSlide*/
    function openKCFinderSlide(button) {
        openKCFinder($(this), 'slide')
    }

    function selectFileUpload(name = '') {
        openKCFinder(name, 'selectFileUpload')
    }

    function openKCFinder(field, $type = '') {
        CKFinder.modal({
            chooseFiles: true,
            width: 1000,
            height: 700,
            top: 0,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    var url = escapeHtml(file.getUrl());
                    console.log($type);
                    if ($type == 'img-thumbnail') {
                        field.parent().next().val(url);
                        field.attr("src", BASE_URL + url);
                    } else if ($type == 'slide') {
                        $('.upload-list').show();
                        $('.upload-list .grid').prepend(slide_render(BASE_URL + escapeHtml(file.getUrl())));
                        $('.click-to-upload ').hide();
                    } else if ($type == 'selectFileUpload') {
                        console.log(field);
                        $('#mainThmb-' + field).attr("src", BASE_URL + url);
                        $('#' + field + '_old').val(url);
                        // field.parent().parent().addClass('active');
                    } else if ($type == 'image') {
                        field.val(url);
                        field.parent().find('img').attr("src", BASE_URL + url);
                    } else if ($type == 'files') {
                        field.val(url);
                    } else if ($type == 'addItem') {
                        field.val(url);
                        field.parent().find('.img-thumbnail').attr("src", BASE_URL + url);
                    } else {
                        field.value = escapeHtml(url);
                        field.prev().find('.img-thumbnail').attr("src", BASE_URL + url);
                    }
                });
            }
        });
    }
</script>
@include('components.alert-success')