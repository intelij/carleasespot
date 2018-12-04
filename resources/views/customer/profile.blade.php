@extends('frontend.layouts.app')
@section('content')
    <div class="page-header-area-2 gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="small-breadcrumb">
                        <div class="breadcrumb-link">
                            <ul>
                                <li>
                                    <a href="../index.html">
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="javascript:void(0);" class="active">
                                        Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="section-padding no-top gray">
                        <div class="container">
                            <div class="row">
                                <!-- Middle Content Area -->
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    @if(Session('success') || Session('error'))
                                        {!! message() !!}
                                    @endif
                                    <section class="search-result-item">
                                        <a class="image-link" href="javascript:void(0);">
                                            <img class="image" alt="Profile Picture" src="{{$user->photo != '' ? asset('assets/user_files/'.$user->uuid.'/'.$user->photo) : asset('assets/user_files/no-image.jpg')}}" id="user_dp" />
                                        </a>
                                        <div class="search-result-item-body">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <h4 class="search-result-item-heading sb_put_user_name"></h4>
                                                    <p class="info">
                                                    <h2>{{$user->name}}</h2>
                                                    <span class="profile_tabs link" id="view_profile" data-action="{{route('customer.show',$user)}}"><i class="fa fa-user"></i>&nbsp;Profile</span>
                                                    <span class="profile_tabs link" id="update_profile" data-action="{{route('customer.get_update_profile')}}"><i class="fa fa-edit"></i>&nbsp; Edit Profile</span>
                                                    </p>
                                                    <p class="info sb_put_user_address"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="dashboard-menu-container">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="menu-name link"><a href="{{route('customer.favorites')}}">My Favorites</a></div>
                                                </a>
                                            </li>
                                        
                                        </ul>
                                    </div>
                                </div>
                                <!-- Middle Content Area  End -->
                            </div>
                            <br />
                            <div class="form-group">
                                
                                <div class="clearfix"></div>
                            </div>

                            <div id="carspot_res">
                                <div class="profile-section margin-bottom-20">
                                    <div class="profile-tabs">
                                        <div class="tab-content">
                                            <div class="profile-edit tab-pane fade in active" id="profile">
                                                <h2 class="heading-md">Manage your profile</h2>
                                                <dl class="dl-horizontal">
                                                    <dt><strong>Your name</strong></dt>
                                                    <dd>{{$user->name}}</dd>
                                                    <dt><strong>Email Address </strong></dt>
                                                    <dd>{{$user->email}}</dd>
                                                    <dt><strong>Phone Number </strong></dt>
                                                    <dd>{{$user->phone}}</dd>
                                                    <dt><strong>Address </strong></dt>
                                                    <dd>{{$user->address}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        (function($){
            $(document).on('click','.link', function(){
                $('#carspot_res').addClass('spinner');
                var action = $(this).attr('data-action');
                $.get(action, function(data){
                    $('#carspot_res').html(data);
                }).done(function() {
                    $('#carspot_res').removeClass('spinner');
                });
            });
            $(document).on('submit', '.ajax-profile-submit', function(e){
                $('#carspot_res').addClass('spinner');
                e.preventDefault();
                var $form = $(this);
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success : function(data){
                        window.location.reload('true');
                    },
                    error : function(jqXhr, json, errorThrown){
                        var errors = jqXhr.responseJSON;
                        var errorStr = '';
                        $.each( errors, function( key, value ) {
                            $('input[name="'+key+'"]').parents('.form-group').addClass("has-error");
                            errorStr += '- ' + value[0] + '<br/>';
                        });
                        var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                        $form.prepend(errorsHtml);
                    },
                    complete : function(){
                        $('#carspot_res').removeClass('spinner');
                    }
                });
            });
        })(jQuery);
    </script>
@endsection