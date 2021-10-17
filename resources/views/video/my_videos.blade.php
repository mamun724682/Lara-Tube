@extends('layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <!-- Recommended section -->
        <div class="container-fluid">
            <div class="grid_title">My Uploaded Videos</div>
            <div class="row">
                @forelse($videos as $video)
                    <div class="col-md-3 col-sx-10 p-2">
                        <a href="{{ route('video.show', $video->id) }}">
                            <div class="card">
                                <img src="{{ $video->thumbnail }}" alt="image" height="174"/>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <p class="mb-2" style="overflow: visible"
                                           title="{{ $video->title }}">
                                            {{ $video->title }}</p>
                                        <p style="color:#606060;">
                                            {{ $video->numeralFormat($video->views) }} {{ Str::plural('view', $video->views) }} {{ $video->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
