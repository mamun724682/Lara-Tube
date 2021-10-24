@extends('layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-10">

        <div class="container-fluid">
            <div class="row">

                @forelse($videos as $video)
                    <div class="col-md-3 col-sx-10 p-2">
                        <a href="{{ route('video.show', $video->id) }}">
                            <div class="card">
                                <img src="{{ $video->thumbnail }}" alt="image" height="174" />
                                <div class="row">
                                    <div class="col-2 mt-3">
                                        <img id="img" width="48" src="{{ $video->channel->image() }}" class="rounded-circle">
                                    </div>
                                    <div class="col-10 mt-3">
                                        <p class="mb-2">{{ $video->title }}</p>
                                        <p style="color:#606060;">
                                            {{ $video->channel->name }} <i class="fas fa-check-circle"></i><br>
                                            {{ $video->numeralFormat($video->views) }} {{ Str::plural('view', $video->views) }} • {{ date('M d, Y', strtotime($video->created_at)) }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse

            </div>

            <div class="d-flex justify-content-center my-4">
                {{ $videos->links() }}
            </div>

        </div>
    </div>
@endsection
