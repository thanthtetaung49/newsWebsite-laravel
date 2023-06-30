@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-5 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create News</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('postCreate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="postTitle">Post Title</label>
                            <input class="form-control" id="postTitle" name="postTitle" type="text"
                                   value="{{ old('postTitle') }}" placeholder="Enter post title.." />
                            @error('postTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postDescription">Post Description</label>
                            <textarea class="form-control" id="postDescription" name="postDescription" type="text"
                                      placeholder="Enter post description...">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postImage">Post Image</label>
                            <input class="form-control" id="postImage" name="postImage" type="file" />
                            @error("postImage")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postCategory">Post Category</label>
                            <select class="form-control" id="postCategory" name="postCategory">
                                <option value="">Choose option</option>
                                @foreach ($categoryData as $data)
                                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post detail list</h3>

                    <div class="card-tools">
                        <form action="{{ route('post') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input class="form-control float-right" name="postSearch" type="text"
                                       value="{{ request('postSearch') }}" placeholder="Search">

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
                                <th>Post ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($postData) > 0)
                                @foreach ($postData as $data)
                                    <tr>
                                        <td class="align-middle">{{ $data->id }}
                                            <input id="inputId" type="hidden" value="{{ $data->id }}">
                                        </td>
                                        <td class="col-2 align-middle">
                                            @if ($data->image != null)
                                                <img class="rounded shadow-sm w-100"
                                                     src="{{ asset('./storage/postImage/' . $data->image) }}"
                                                     alt="{{ $data->image }}">
                                            @else
                                                <img class="rounded shadow-sm w-100" src="{{ asset('./defaultImage/default.jpg') }}"
                                                     alt="default.jpg">
                                            @endif

                                        </td>
                                        <td class="align-middle" id="inputTitle">{{ Str::words($data->title, 2, '...') }}</td>
                                        <td class="align-middle"id="inputDescription">{{ Str::words($data->description, 2, '...') }}</td>
                                        <td class="align-middle">{{ Str::words($data->category_title, 2, '...') }}</td>
                                        
                                        <td class="align-middle">
                                            <a href="{{ route('postEdit', $data->id )}}">
                                                <button class="btn btn-sm bg-dark text-white edit-btn" title="Edit"><i
                                                   class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="{{ route('postDelete', $data->id) }}">
                                                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"
                                                       title="delete"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">This is no post data...</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="mt-3">
                {{ $postData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
