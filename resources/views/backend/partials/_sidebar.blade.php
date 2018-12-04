<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Carspot</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                {!! Html::image(asset(auth()->guard('admin')->user()->photo != '' ? 'assets/user_files/admins/'.auth()->guard('admin')->user()->uuid.'/'.auth()->guard('admin')->user()->photo : 'assets/user_files/no-image.jpg'), 'photo',['class'=>'img-circle profile_img']) !!}
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                @php($names = explode( " ", Auth::guard('admin')->user()->name))
                <h2>{{ucfirst($names[0])." ".strtoupper($names[1][0]).'.'}}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="{{route('admin.dealers.index')}}"><i class="fa fa-users"></i> Dealers</a></li>
                    <li><a href="{{route('admin.customers.index')}}"><i class="fa fa-users"></i> Customers</a></li>
                    <li><a href="{{route('admin.listings.index')}}"><i class="fa fa-desktop"></i> Listings</a></li>
                    <li><a href="{{route('admin.makes.index')}}"><i class="fa fa-car"></i> Makes</a></li>
                    <li><a href="{{route('admin.models.index')}}"><i class="fa fa-bus"></i> Models</a></li>
                    <li><a href="{{route('admin.trims.index')}}"><i class="fa fa-bus"></i> Trims</a></li>
                    <li><a href="{{route('admin.inquiries.index')}}"><i class="fa fa-question-circle"></i> Dealer Inquiries</a></li>
                      <li><a href="{{url('admin/terms')}}"><i class="fa fa-question-circle"></i>Terms And Conditions</a></li>
                <li><a href="{{url('admin/policies')}}"><i class="fa fa-question-circle"></i>Privacy And Policy</a></li>  
                    <li><a href="{{route('admin.newsletter_signups.index')}}"><i class="fa fa-envelope"></i> Newsletter Signups</a></li>
                    <li><a href="{{route('admin.car_images.index')}}"><i class="fa fa-image"></i> Car Images</a></li>
                    <li><a href="{{route('admin.upload_excel.index')}}"><i class="fa fa-image"></i> Upload Excel</a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>