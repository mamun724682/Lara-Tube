@extends('layouts.app')

@section('content')
    <!-- main content -->
    <div class="container-fluid watch_video">
        <div class="row pt-4">
            <div class="col-md-8 video_box">
                <video
                    id="my-video"
                    class="video-js video_responsive"
                    controls
                    preload="auto"
                    width="1250"
                    poster="{{ $video->thumbnail }}"
                    data-setup="{}"
                >
                    <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}'
                            type="application/x-mpegURL"/>
                </video>

                @if($video->editable())
                    <form action="{{ route('video.update', $video->id) }}" method="post">
                        @csrf
                        @endif

                        <div class="p-1 pt-3">
                            <div class="title">
                                @if($video->editable())
                                    <input type="text" name="title" class="form-control" value="{{ $video->title }}">
                                @else
                                    {{ $video->title }}
                                @endif
                            </div>
                            <div class="row mt-2 border-bottom">
                                <div class="col-7">
                                    <div
                                        style="color:#606060;">{{ $video->numeralFormat($video->views) }} {{ Str::plural('view', $video->views) }}
                                        • {{ date('M d, Y', strtotime($video->created_at)) }}</div>
                                </div>
                                <div class="col-5 text-right">

                                    <votes :default_votes="{{ $video->votes }}" entity_owner="{{ $video->channel->user_id }}" entity_id="{{ $video->id }}"></votes>

                                </div>
                            </div>
                            <div class="row mt-4 border-bottom ">
                                <div class="col-1 pr-0 w-2 text-right">
                                    <img id="img" width="48"
                                         src="{{ $video->channel->image() }}"
                                         class="rounded-circle">
                                </div>
                                <div class="col-9 pl-0">
                                    <p style="color:#303030;">
                                        <b>{{ $video->channel->name }}</b> <i class="fas fa-check-circle"></i><br>
                                        <span style="color:#606060">{{ $video->numeralFormat($video->channel->subscriptions->count()) }} subscribers</span>
                                    </p>

                                    @if($video->editable())
                                        <textarea name="description" class="form-control">{!! $video->description !!}</textarea>
                                        <button type="submit" class="btn btn-primary mt-2 mb-2 float-right">Update</button>
                                    @else
                                        <p>{!! $video->description !!}</p>
                                    @endif

                                </div>
                                <div class="col-2 text-right">
                                    <subscribe-button :initial-subscriptions="{{ $video->channel->subscriptions }}"
                                                      :channel="{{ $video->channel }}"/>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 m-4" style="color: #303030; font-weight: bold">10,699 Comments</div>
                            </div>

                            <comments :video="{{ $video }}"></comments>

                        </div>

                        @if($video->editable())
                    </form>
                @endif

            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-6">Up Next</div>
                </div>

                @forelse($otherVideos as $item)
                    <div class="container-fluid video_list mb-2">
                        <a href="{{ route('video.show', $item->id) }}">
                            <div class="card">
                                <div class="row p-0">
                                    <div class="col-md-5">
                                        <img class="video_list_responsive"
                                             src="{{ $item->thumbnail }}" alt="image" width="100%"
                                             height="94"/>
                                    </div>
                                    <div class="col-md-7 p-0">
                                        <p class="mb-1 title"
                                           title="{{ $item->title }}">
                                            {{ $item->title }}</p>
                                        <p style="color:#606060;">
                                            {{ $item->channel->name }} <i class="fas fa-check-circle"></i> <br>
                                            {{ $item->numeralFormat($item->views) }} {{ Str::plural('view', $item->views) }}
                                            • {{ $item->created_at->diffForHumans() }}
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

    <!-- main content -->
@endsection

@push('style')
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet"/>
@endpush

@push('script')
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
    <script>
        window.CURRENT_VIDEO_ID = "{{ $video->id }}"
    </script>
    <script src="{{ asset('js/player-view.js') }}"></script>
@endpush
