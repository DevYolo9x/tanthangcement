<!-- start: box 9  -->
<div class="request-section bg-gray-50 py-[30px] md:py-[50px] mt-[50px] wow fadeInUp">
    <div class="container mx-auto px-3">
        <h2 class="title-primary text-f25 md:text-f30 font-bold text-center">
            {{$fcSystem['title_2']}}
        </h2>
        <div class="desc-title text-f16 text-center mt-[10px] md:mt-[15px] mb-[30px] md:max-w-[60%] mx-auto">
            <p>
                {{$fcSystem['title_3']}}
            </p>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full md:w-1/2">
                <form action="" class="form-subscribe">
                    @csrf
                    @include('homepage.common.alert')
                    <input type="text" placeholder="{{trans('index.Fullname')}}*" name="fullname" class="w-full px-2 outline-none focus:outline-none hover:outline-none h-[45px] rounded-[5px] border border-gray-100 text-f15 mb-[20px]" />
                    <input type="text" placeholder="Email*" name="email" class="w-full px-2 outline-none focus:outline-none hover:outline-none h-[45px] rounded-[5px] border border-gray-100 text-f15 mb-[20px]" />
                    <input type="text" placeholder="{{trans('index.Phone')}}*" name="phone" class="w-full px-2 outline-none focus:outline-none hover:outline-none h-[45px] rounded-[5px] border border-gray-100 text-f15 mb-[20px]" />
                    <input type="text" placeholder="{{trans('index.Company')}}*" name="company" class="w-full px-2 outline-none focus:outline-none hover:outline-none h-[45px] rounded-[5px] border border-gray-100 text-f15 mb-[20px]" />
                    <textarea name="message" id="" cols="30" rows="10" placeholder="{{trans('index.textWhy')}}" class="w-full px-2 py-2 outline-none focus:outline-none hover:outline-none h-[100px] rounded-[5px] border border-gray-100 text-f15"></textarea>
                    <div class="text-center">
                        <button type="submit" class="btn-submit button-link inline-block py-[10px] px-[25px] border rounded-[30px] text-white mt-[10px] md:mt-[20px] hover:bg-white hover:text-color_primary transition-all bg-color_primary border-color_primary">
                            <span>{{trans('index.sendRequiment')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end: box 9-->
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-submit").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo route('contactFrontend.subcribers') ?>",
                type: 'POST',
                data: {
                    _token: $(".form-subscribe input[name='_token']").val(),
                    fullname: $(".form-subscribe input[name='fullname']").val(),
                    email: $(".form-subscribe input[name='email']").val(),
                    phone: $(".form-subscribe input[name='phone']").val(),
                    company: $(".form-subscribe input[name='company']").val(),
                    message: $(".form-subscribe textarea[name='message']").val(),
                },
                success: function(data) {
                    if (data.status == 200) {
                        $(".form-subscribe .print-error-msg").css('display', 'none');
                        $(".form-subscribe .print-success-msg").css('display', 'block');
                        $(".form-subscribe .print-success-msg span").html("<?php echo $fcSystem['message_1'] ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        $(".form-subscribe .print-error-msg").css('display', 'block');
                        $(".form-subscribe .print-success-msg").css('display', 'none');
                        $(".form-subscribe .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
</script>
@endpush