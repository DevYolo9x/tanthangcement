@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".datepicker_time").datepicker({
                dateFormat: "yy-mm-dd",
                duration: "fast"
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="product"]').change(function() {
                var id = $(this).val();
                $.get(
                    '{{ route("patient.getMaxPatient") }}', {
                        type: 'GET',
                        id: id
                    },
                    function(data) {
                        var elQuantity = $('#validationQuantity');
                        var quantity = 0;
                        if( data ) {
                            quantity = data.val;
                        }
                        elQuantity.prop('disabled', false)
                        elQuantity.attr('max', quantity);
                        elQuantity.prev().find('.inventory').html('(Số lượng nhỏ hơn ' + quantity + ')');
                        elQuantity.prev().find('.inventory').removeClass('d-none');
                    }
                );
            })
        })
    </script>
@endpush