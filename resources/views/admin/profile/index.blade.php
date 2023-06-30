@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-9 offset-sm-3 mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <legend class="text-center">User Profile</legend>
                    </div>
                    <div class="card-body">
                        {{-- start alert --}}
                        @if (session('updateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session("updateSuccess") }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- end alert --}}
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form class="form-horizontal" action="{{ route('userUpdate') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="inputName">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="inputName" name="name" type="text"
                                                   value="{{ old('name', $user->name) }}" placeholder="Enter name...">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="inputEmail">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="inputEmail" name="email" type="email"
                                                   value="{{ old('email', $user->email) }}" placeholder="Enter email...">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="inputPhone">Phone</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="inputPhone" name="phone" type="text"
                                                   value="{{ old('phone', $user->phone) }}" placeholder="09xxx...">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="inputGender">Gender</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="inputGender" name="gender">
                                                @if ($user->gender == 'male')
                                                    <option value="">Select option...</option>
                                                    <option value="male" selected>male</option>
                                                    <option value="female">female</option>
                                                @elseif ($user->gender == 'female')
                                                    <option value="">Select option...</option>
                                                    <option value="male">male</option>
                                                    <option value="female" selected>female</option>
                                                @else
                                                    <option value="" selected>Select option...</option>
                                                    <option value="male">male</option>
                                                    <option value="female">female</option>
                                                @endif
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="inputAddress">Address</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputAddress" name="address" cols="10" rows="5"
                                                      placeholder="Enter address...">{{ old('address', $user->address) }}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <a href="{{ route('userChangePassword') }}">Change Password</a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button class="btn bg-dark text-white" type="submit">Submit</button>
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
