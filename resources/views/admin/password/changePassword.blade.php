@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <legend class="text-center">Change Password</legend>
                    </div>
                    <div class="card-body">
                        {{-- start alert --}}
                        @if (session('changePasswordFail'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('changePasswordFail') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- end alert --}}
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form class="form-horizontal" action="{{ route('userChangePasswordUpdate') }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="inputOldPassword">Old Password</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputOldPassword" name="oldPassword"
                                                   type="password" placeholder="Enter old password...">
                                            @error('oldPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @if (session('changePasswordFail'))
                                                <span class="text-danger">Password didn't match your old password.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="inputNewPassword">New Password</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputNewPassword" name="newPassword"
                                                   type="password" placeholder="Enter new password...">
                                            @error('newPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="inputConfirmPassword">Confirm
                                            Password</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputConfirmPassword" name="confirmPassword"
                                                   type="password" placeholder="Enter confirm password...">
                                            @error('confirmPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-10">
                                            <button class="btn bg-dark text-white" type="submit">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
