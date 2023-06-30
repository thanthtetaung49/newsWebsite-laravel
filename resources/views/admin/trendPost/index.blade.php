@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trend post list page</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>Post ID</th>
                                <th>Post Title</th>
                                <th>Post Image</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trendPosts as $post)
                                <tr>
                                    <td class="align-middle">{{ $post->post_id }}</td>
                                    <td class="align-middle">{{ Str::words($post->title, 7, '...') }}</td>
                                    <td class="align-middle col-3">
                                        @if ($post->image == null)
                                            <img class="rounded shadow-sm w-100"
                                                src="{{ asset('./defaultImage/default.jpg') }}" alt="default.jpg">
                                        @else
                                            <img class="rounded shadow-sm w-100"
                                                src="{{ asset('./storage/postImage/' . $post->image) }}"
                                                alt="{{ $post->image }}">
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('trendPostDetail', $post->post_id) }}">
                                            <button class="btn btn-sm bg-dark text-white"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="d-flex justify-content-center">
                {{ $trendPosts->links() }}
            </div>
        </div>
    </div>
@endsection
