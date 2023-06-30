@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-3 mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit posts</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postUpdate', $postData->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="postTitle">Post Title</label>
                                <input class="form-control" id="postTitle" name="postTitle" type="text"
                                       value="{{ old('postTitle', $postData->title) }}" placeholder="Enter post title.." />
                                @error('postTitle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="postDescription">Post Description</label>
                                <textarea class="form-control" id="postDescription" name="postDescription" type="text"
                                          placeholder="Enter post description...">{{ old('postDescription', $postData->description) }}</textarea>
                                @error('postDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block" for="postImage">
                                    Post Image
                                    <div class="text-center mt-2 p-3" style="border: 2px dashed gray">
                                        @if ($postData->image == null)
                                            <img class="rounded shadow w-25" src="{{ asset('./defaultImage/default.jpg') }}"
                                                 alt="default.jpg">
                                        @else
                                            <img class="rounded shadow w-25"
                                                 src="{{ asset('storage/postImage/' . $postData->image) }}" alt="">
                                        @endif
                                    </div>
                                </label>
                                <input class="form-control d-none" id="postImage" name="postImage" type="file" />
                                @error('postImage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="postCategory">Post Category</label>
                                <select class="form-control" id="postCategory" name="postCategory">
                                    <option value="">Choose option</option>
                                    @foreach ($categoryData as $data)
                                        <option value="{{ $data->id }}" @if ($data->id == $postData->category_id)
                                            selected
                                        @endif>{{ $data->title }}</option>
                                    @endforeach
                                </select>
                                @error('postCategory')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn bg-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
