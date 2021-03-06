<!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">

<head>
<style>
ul.list {
    margin: 16px 0 16px 20px;
}

li.list-item {
    list-style-type: disc;
    padding: 0 0 0 0;
}
</style>

    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>The First Ever Car Leasing Dealer Marketplace - carleasespot.com</title>
    <link rel='dns-prefetch' href='http://www.google.com/' />
    <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
    <link rel='dns-prefetch' href='http://s.w.org/' />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <link rel='stylesheet' href='{{asset('assets/includes/js/jquery-ui-1.12.1/jquery-ui.min.css')}}' type='text/css' media='all' />
    <link rel="stylesheet" href="{{ asset('assets/css/custom/common.css')}}" type="text/css" />
    <link rel='stylesheet' id='popup-video-iframe-style-css' href='{{asset('assets/css/video_player55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='bootstrap-css' href='{{asset('assets/css/bootstrap55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-theme-css' href='{{asset('assets/css/style55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-theme-slug-fonts-css' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,600italic,700,700italic,900italic,900,300,300italic%7CPoppins:400,500,600&amp;subset=latin,latin-ext' type='text/css' media='all' />
    <link rel='stylesheet' id='et-line-fonts-css' href='{{asset('assets/css/et-line-fonts55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='animate-css' href='{{asset('assets/css/animate.min55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flaticon-css' href='{{asset('assets/css/flaticon55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flaticon2-css' href='{{asset('assets/css/flaticon255fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-icons-css' href='{{asset('assets/css/custom_icons55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-select2-css' href='{{asset('assets/css/select2.min55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='nouislider-css' href='{{asset('assets/css/nouislider.min55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='owl-carousel-css' href='{{asset('assets/css/owl.carousel55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='owl-theme-css' href='{{asset('assets/css/owl.theme55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-custom-css' href='{{asset('assets/css/custom55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='toastr-css' href='{{asset('assets/css/toastr.min55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-woo-css' href='{{asset('assets/css/woocommerce55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='minimal-css' href='{{asset('assets/skins/minimal/minimal55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='fancybox2-css' href='{{asset('assets/css/jquery.fancybox.min55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='slider-css' href='{{asset('assets/css/slider55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='carspot-menu-css' href='{{asset('assets/css/carspot-menu55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-media-css' href='{{asset('assets/css/responsive-media55fe.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='defualt-color-css' href='{{asset('assets/css/colors/defualt.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href='{{asset('assets/css/font-awesome.min5243.css')}}' type='text/css' media='all' />
    <link href="{{asset('assets/js/custom/bootstrap-dialog/bootstrap-dialog.css')}}" rel="stylesheet">
    <link rel='stylesheet' id='font-awesome-css' href='{{asset('assets/css/custom/styles.css')}}' type='text/css' media='all' />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://docs.angularjs.org/angular-sanitize-1.0.0rc10.min.js"></script>
    @yield('styles')
</head>
<body class="page-template-default page page-id-15 wpb-js-composer js-comp-ver-5.4.5 vc_responsive" ng-app="app">
<div class="loading" id="sb_loading">&#8230;</div>
<div class="sb-top-bar_notification">
    <a href="javascript:void(0)">
        For a better experience please change your browser to CHROME, FIREFOX, OPERA or Internet Explorer.
    </a>
</div>
<div class="colored-header">
    <div class="header-top dark">
        <div class="container">
            <div class="row">
                <div class="header-top-left col-md-5 col-sm-5 col-xs-12 hidden-xs">
                    <ul class="listnone">
                        <li><a href="../support-center/index.html"></a></li>
                    </ul>
                </div>
                <div class="header-right col-md-7 col-sm-7 col-xs-12 ">
                    <div class="pull-right ">
                        <ul class="listnone">
                            @if (!empty(auth()->guard('web')->user()))
                                @php($logged_user = auth()->guard('web')->user())
                                <li class="dropdown">
                                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false"><i class="icon-envelope"></i>Messages
                                        <div class="notify"></div>
                                    </a>
                                    <ul class="dropdown-menu mailbox animated bounceInDown">
                                    <li>
                                        <div class="drop-title">You have <span class="msgs_count">0</span> new notification(s)                                                    </div>
                                    </li>
                                    <li><div class="message-center"></div></li></ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img class="img-circle resize" alt="Avatar" src="{{$logged_user->photo != '' ? asset('assets/user_files/'.$logged_user->uuid.'/'.$logged_user->photo) : asset('assets/user_files/no-image.jpg')}}">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('profile')}}">Dashboard</a></li>
                                        <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                                    </ul>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
				@elseif(!empty(auth()->guard('api')->user()))
				@php($customer = auth()->guard('api')->user())
                                <li class="dropdown">
                                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false"><i class="icon-envelope"></i>Messages
                                        <div class="notify"></div>
                                    </a>
                                    <ul class="dropdown-menu mailbox animated bounceInDown">
                                    <li>
                                        <div class="drop-title">You have <span class="msgs_count">0</span> new notification(s)
                                        </div>
                                    </li>
                                    <li><div class="message-center"></div></li></ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <img class="img-circle resize" alt="Avatar" src="{{$customer->photo != '' ? asset('assets/user_files/'.$customer->uuid.'/'.$customer->photo) : asset('assets/user_files/no-image.jpg')}}">
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('customer.profile')}}">Dashboard</a></li>
                                        <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                                    </ul>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>				
                            @else
                                <li>
                                    <a href="{{route('customer.login')}}"><i class="fa fa-sign-in"></i> Login </a>
                                </li>
                                <li>
                                    <a href="{{route('customer.signup')}}"><i class="fa fa-unlock" aria-hidden="true"></i> Register </a>
                                </li>
                                <br class="mbr">
                                <li><a href="{{route('register')}}" class="btn btn-theme">Sell Your Car</a></li>
                                <li><a href="{{route('login')}}" class="btn btn-theme">Dealer login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navigation Menu -->
    <div class="clearfix"></div>
    <!-- menu start -->
    <nav id="menu-1" class="mega-menu">
        <!-- menu list items container -->
        <section class="menu-list-items">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- menu logo -->
                        <ul class="menu-logo">
                            <li>
                                <a href="{{route('home')}}">
                                    <img src="{{asset('assets/images/2017/06/logo-2.png')}}" alt="Logo">
                                </a>
                            </li>
                        </ul>
                        <!-- menu links -->
                        <ul class="menu-links">
                            <!--li><a  href="{{route('home')}}">Home</a></li-->
                            <li><a data-toggle="collapse" href="#cartype_content" role="button" aria-expanded="false" aria-controls="cartype_content">Car Types  </a></li>
                            <li><a  href="{{url('comparison')}}">Compare Cars  </a></li>
                            <li><a  href="{{url('reviews')}}">Reviews  </a></li>
                            <li><a  href="{{url('howworks')}}">How it works</a></li>
                            <li><a  href="{{url('aboutus')}}">About Us  </a></li>
                        </ul>
                        <ul class="menu-search-bar">
                            <li>
                                <div class="contact-in-header clearfix">
                                    
                                    <span>
                                        EVERY DEALER PRICE GURANTEED
                                        <br>
                                        <strong>OR WE'll MATCH IT</strong>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </nav>
    <!-- menu end -->
    
</div>

@yield('content')
<div id="ajax-modal" class="modal fade" role="dialog" data-backdrop="static"><div class="modal-dialog"></div></div>
<div id="loading_modal" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>
</div>
<footer class="footer-bg white">
    <div class="footer-top">
        @yield('homepage_footer')
        <div class="container">
            <div class="row"><br><br></div>
            <div class="row">
                <div class="col-md-3  col-sm-6 col-xs-12">
                    <div class="widget">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{asset('assets/images/2017/06/logo-2.png')}}" class="img-responsive" alt="Site Logo">
                            </a>
                        </div>
                        <p>The First Ever Car Leasing Marketplace. <br> Why go from dealer to dealer shopping for your next lease when we can bring all the dealers to you!</p>
                        <ul class="apps-donwloads">
                            <li>
                                <a href="#"><img src="{{asset('assets/images/googleplay.png')}}" alt="Android App"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('assets/images/appstore.png')}}" alt="IOS App"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2  col-sm-6 col-xs-12">
                    <div class="widget socail-icons">
                        <h5>Follow Car Lease Spot</h5>
                        <ul>
                            <li>
                                <a class="Facebook" href="https://m.facebook.com/Carleasespotcom-180378332672509/?ref=bookmarks">
                                    <i class="fa fa-facebook"></i>
                                </a><span><a  href="https://m.facebook.com/Carleasespotcom-180378332672509/?ref=bookmarks">Facebook</a></span>
                            </li>
                            <li>
                                <a class="Twitter" href="https://twitter.com/Carleasespot">
                                    <i class="fa fa-twitter "></i>
                                </a><span><a  href="https://twitter.com/Carleasespot">Twitter</a></span>
                            </li>
                            <li>
                                <a class="Linkedin" href="https://www.linkedin.com/in/carleasespotcom/">
                                    <i class="fa fa-linkedin "></i>
                                </a><span><a  href="https://www.linkedin.com/in/carleasespotcom/">Linkedin</a></span>
                            </li>
                            <li>
                                <a class="Google" href="https://plus.google.com/u/0/108346057051905275199">
                                    <i class="fa fa-google-plus"></i>
                                </a><span><a  href="https://plus.google.com/u/0/108346057051905275199">Google</a></span>
                            </li>
                            <li>
                                <a class="YouTube" href="https://www.youtube.com/channel/UC0Y7K4Z3zCp0Y22k0zq3wDQ/videos">
                                    <i class="fa fa-youtube-play"></i>
                                </a><span><a  href="https://www.youtube.com/channel/UC0Y7K4Z3zCp0Y22k0zq3wDQ/videos">YouTube</a></span>
                            </li>
                            <li>
                                <a class="Pinterest" href="#">
                                    <i class="fa fa-pinterest "></i>
                                </a><span><a  href="#">Pinterest</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2  col-sm-6 col-xs-12">
                    <div class="widget my-quicklinks">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="http://synergyautohub.com/comparison">Compare Cars</a></li>
                            <li><a href="http://synergyautohub.com/register">Sell Your Car</a></li>
                            <li><a href="http://synergyautohub.com/customer/login">Login</a></li>
                            <li><a href="http://synergyautohub.com/login">Dealer Login</a></li>
                            <li><a href="http://synergyautohub.com/terms">Terms of Use</a></li>
                            <li><a href="http://synergyautohub.com/policies">Privacy Policy</a></li>
                            <li><a href="http://synergyautohub.com/visitors">Visitor Agreement</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5  col-sm-6 col-xs-12">
                    <div class="widget widget-newsletter">
                        <h5>Sign up for the Car Lease Spot newsletter </h5>
                        <div class="fieldset">
                            <p>Get Informed When We Think An Outstanding Lease Deal Is Posted  </p>
                            <form onSubmit="return checkVals();">
                                <input name="sb_email" id="sb_email" placeholder="Enter your email address" type="text" autocomplete="off" required>
                                <input class="submit-btn" id="save_email" value="Submit" type="button">
                                <input class="submit-btn no-display" id="processing_req" value="Processing..." type="button">
                                <input type="hidden" id="sb_action" value="footer_action" />
                            </form>
                        </div>
                    </div>
                    <div class="copyright">
                        <p>Copyright 2017 © Carleasespot.com <a href="http://synergyautohub.com/terms">Terms And Conditions</a></p>
  
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    var base_url = "{{url('/')}}";
</script>
<script type='text/javascript' src='{{asset('assets/includes/js/jquery/jquery-3.3.1.min.js')}}'></script>

<script type='text/javascript' src='{{asset('assets/includes/js/jquery/jquery-migrate.min330a.js')}}'></script>

<script type='text/javascript' src='{{asset('assets/js/bootstrap.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/includes/js/jquery-ui-1.12.1/jquery-ui.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/toastr.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/animateNumber.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/easing55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/carousel.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/dropzone55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/carspot-menu55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/form-dropzone55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/icheck.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/modernizr55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery.appear.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery.countTo55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery.inview.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/nouislider.all.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/perfect-scrollbar.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/select2.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/slide55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/color-switcher55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/parsley.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/hello55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery-te.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery.tagsinput.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/bootstrap-confirmation.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/jquery.fancybox.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/test.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/wow55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/video_player55fe.js')}}'></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js"></script>
<script type='text/javascript' src='{{asset('assets/js/custom55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/jQueryInputNumberMask/jquery.masknumber.js')}}'></script>
<script src="{{asset('assets/js/custom/bootstrap-dialog/bootstrap-dialog.js')}}"></script>
<script type='text/javascript' src='{{asset('assets/js/custom/scripts.js')}}'></script>

@yield('scripts')
<script>
    (function($) {
        "use strict";
        // Adding email in mailchimp
        $('#processing_req').hide();
        $('#save_email').on('click', function() {
            var sb_email = $('#sb_email').val();
            var sb_action = $('#sb_action').val();
            if (carspot_validateEmail(sb_email)) {
                $('#save_email').hide();
                $('#processing_req').show();
                $.post('{{route('newslettersignup')}}', {
                    action: 'sb_mailchimp_subcribe',
                    email: sb_email,
                }).done(function(data) {
                    $('#processing_req').hide();
                    $('#save_email').show();
                    if (data.success) {
                        toastr.success('Thank you, we will get back to you.', 'Success!', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-bottom-right"
                        });
                        $('#sb_email').val('');
                    } else {
                        toastr.error('There is some error, please check your API-KEY and LIST-ID.', 'Error!', {
                            timeOut: 2500,
                            "closeButton": true,
                            "positionClass": "toast-bottom-right"
                        });
                    }
                });
            } else {
                toastr.error('Please add valid email.', 'Error!', {
                    timeOut: 2500,
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                });
            }
        });

    })(jQuery);
    function checkVals() {
        return false;
    }
    
</script>
</body>
</html>
