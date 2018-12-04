<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @php($names = explode( " ", Auth::guard('admin')->user()->name))
                        {!! Html::image(asset(auth()->guard('admin')->user()->photo != '' ? 'assets/user_files/admins/'.auth()->guard('admin')->user()->uuid.'/'.auth()->guard('admin')->user()->photo : 'assets/user_files/no-image.jpg'), 'photo',['class'=>'img-avatar']) !!}
                        {{ucfirst($names[0])." ".strtoupper($names[1][0]).'.'}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{route('admin_profile')}}"> Profile</a></li>
                        <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                    <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>