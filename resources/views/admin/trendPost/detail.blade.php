@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-8 offset-2 mt-4">
            <div class="mb-3">
                <a href="{{ route('trendPost') }}" class="btn bg-dark text-light">Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>{{ $post->title }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if ($post->image == null)
                                <img class="rounded shadow-sm w-100" src="{{ asset('./defaultImage/default.jpg') }}"
                                    alt="default.jpg">
                            @else
                                <img class="rounded shadow-sm w-100"
                                    src="{{ asset('./storage/postImage/' . $post->image) }}" alt="{{ $post->image }}">
                            @endif
                        </div>
                        <div class="col-12 mt-4">
                            <p>
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
