<div class="col-md-3">
    <div class="profile-nav">
        <div class="widget">
            <div class="widget-body">
                <div class="user-heading round">
                    <a href="#">
                        <img src="https://ui-avatars.com/api/?name={{Auth::guard('customer')->user()->name}}" alt="">
                    </a>
                    <h1>{{ $detail->name }}</h1>
                    <p>{{ $detail->email }}</p>
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li class="@if( Request::url() == route('customer.dashboard') ) active @endif"><a href="{{ route('customer.dashboard') }}"> <i class="fa fa-user"></i> Thông tin tài khoản</a></li>
                    <li class="@if( Request::url() == route('patient.index') || Request::url() == route('patient.create') ) active @endif">
                        <a href="{{ route('patient.index') }}">
                            <i class="fas fa-users"></i> Bênh nhân
                            <span class="label label-info pull-right r-activity">{{ countPatient(Auth::guard('customer')->user()->id) }}</span>
                        </a>
                    </li>
                    <li class="@if( request()->is('thanh-vien/dat-mua') || request()->is('thanh-vien/dat-mua/*') ) active  @endif">
                        <a href="{{ route('patientBuy.index') }}" class="@if( request()->is('thanh-vien/dat-mua') ) active @endif">
                            <i class="fas fa-users"></i> Danh sách đặt hàng
                        </a>
                        <ul class="sub-menu" style="display: none">
                            <li class="@if( request()->is('thanh-vien/dat-mua/create') ) active @endif">
                                <a href="{{ route('patientBuy.create') }}">Đặt hàng</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{route('customer.logout')}}"> <i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>