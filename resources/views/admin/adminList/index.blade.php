@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            {{-- start  alert  --}}
            @if (session('accountDeleteSuccess'))
                <div class="col-3 offset-9">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('accountDeleteSuccess') }}</strong>
                        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            {{-- end alert --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin list page</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin#list') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input class="form-control float-right" name="accountSearch" type="text"
                                       value="{{ request('accountSearch') }}" placeholder="Search">

                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userData as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    @if ($data->email == null)
                                        <td>-</td>
                                    @else
                                        <td>{{ $data->email }}</td>
                                    @endif
                                    @if ($data->phone == null)
                                        <td>-</td>
                                    @else
                                        <td>{{ $data->phone }}</td>
                                    @endif
                                    @if ($data->gender == null)
                                        <td>-</td>
                                    @else
                                        <td>{{ $data->gender }}</td>
                                    @endif
                                    @if ($data->address == null)
                                        <td>-</td>
                                    @else
                                        <td>{{ $data->address }}</td>
                                    @endif
                                    <td>
                                        @if (Auth::user()->id != $data->id)
                                            @if (count($userData) == 1)
                                                <a href="#">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                           class="fas fa-trash-alt"></i></button>
                                                </a>
                                            @else
                                                <a href="{{ route('admin#accountDelete', $data->id) }}">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                           class="fas fa-trash-alt"></i></button>
                                                </a>
                                            @endif
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="mt-3">
                {{ $userData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
