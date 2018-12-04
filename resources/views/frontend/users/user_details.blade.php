<div class="profile-section margin-bottom-20">
    <div class="profile-tabs">
        <div class="tab-content">
            <div class="profile-edit tab-pane fade in active" id="edit">
                <h2 class="heading-md">Manage your Security Settings</h2>
                <p>Manage Your Account</p>
                <div class="clearfix"></div>
                {!! Form::model($user, ['route' => ['users.update', $user->uuid], 'method'=>'PATCH','class'=>'ajax-profile-submit needs-validation','novalidate','files'=>true]) !!}
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>Your Name</label>
                            <input type="text" class="form-control margin-bottom-20" value="{{$user->name}}" name="name">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>Email Address <span class="color-red">*</span></label>
                            <input type="text" class="form-control margin-bottom-20" value="{{$user->email}}" name="email" readonly>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label>Contact Number</label>
                            <input type="text" class="form-control margin-bottom-20" name="phone" value="{{$user->phone}}">
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label>Address</label>
                            <input type="text" class="form-control margin-bottom-20" name="address" value="{{$user->address}}">
                        </div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-12 col-xs-12 ">
                                <label>Profile Picture<span class="color-red">*</span></label>
                                <div class="input-group">
								<span class="input-group-btn">
								<span class="btn btn-default btn-file">
								Profile Picture
								<input type="file" id="profile_photo" name="profile_photo" accept = "image/*" class="sb_files-data form-control">
								</span>
								</span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-1 no-padding">
                                <img id="img-upload" class="img-responsive" src="{{$user->photo != '' ? asset('assets/user_files/'.$user->uuid.'/'.$user->photo) : asset('assets/user_files/no-image.jpg')}}" alt="Profile Picture" width="100" height="100" />
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                            <p class="help-block">
                                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Disable for Demo">Change Password</a>
                            </p>
                            <button type="submit" class="btn btn-theme btn-sm" id="user_profile_update">
                                Update My Info
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="custom-modal">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header rte">
                                <h2 class="modal-title">Password Change</h2>
                            </div>
                            <form id="sb-change-password">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input placeholder="Current Password" class="form-control" type="password"  name="current_pass" id="current_pass">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input placeholder="New Password" class="form-control" type="password" name="new_pass" id="new_pass">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input placeholder="Confirm Password" class="form-control" type="password" name="con_new_pass" id="con_new_pass">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-theme btn-sm" type="button" id="change_pwd">Reset My Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
