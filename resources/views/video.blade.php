@extends('layouts.app')

@section('content')
    {{--    @dd($video->views)--}}
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
                                    <div class="row">
                                        <div class="col-3 border-bottom border-dark">
                                            <a href="#" style="color:#606060;" title="I like this">
                                                <svg style="height: 18px; width: 18px;margin: auto;"
                                                     viewBox="0 0 24 24">
                                                    <path
                                                        d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.91l-.01-.01L23 10z"
                                                        fill="#606060"></path>
                                                </svg>
                                                500K
                                            </a>
                                        </div>
                                        <div class="col-3 border-bottom border-dark">
                                            <a href="#" style="color:#606060;" title="I dislike this">
                                                <svg style="height: 18px; width: 18px;margin: auto;"
                                                     viewBox="0 0 24 24">
                                                    <path
                                                        d="M15 3H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v1.91l.01.01L1 14c0 1.1.9 2 2 2h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 23l6.59-6.59c.36-.36.58-.86.58-1.41V5c0-1.1-.9-2-2-2zm4 0v12h4V3h-4z"
                                                        fill="#606060"></path>
                                                </svg>
                                                17K
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <a href="#" style="color:#606060;" title="Share">
                                                <svg style="height: 18px; width: 18px;margin: auto;"
                                                     viewBox="0 0 24 24">
                                                    <path
                                                        d="M11.7333 8.26667V4L19.2 11.4667L11.7333 18.9333V14.56C6.4 14.56 2.66667 16.2667 0 20C1.06667 14.6667 4.26667 9.33333 11.7333 8.26667Z"
                                                        fill="#606060"></path>
                                                </svg>
                                                SHARE
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <a href="#" style="color:#606060;" title="Save">
                                                <svg style="height: 18px; width: 18px;margin: auto;"
                                                     viewBox="0 0 24 24">
                                                    <path
                                                        d="M14 10H2v2h12v-2zm0-4H2v2h12V6zm4 8v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM2 16h8v-2H2v2z"
                                                        fill="#606060"></path>
                                                </svg>
                                                SAVE
                                            </a>
                                        </div>
                                    </div>
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
                            <div class="row mb-4">
                                <div class="col-12 m-4" style="color: #303030; font-weight: bold">10,699 Comments</div>
                                <div class="col-1">
                                    <img id="img" width="30" src="images/icon/avatar.png" class="rounded-circle">
                                </div>
                                <div class="col-11">
                                    <form>
                                        <input type="text" name="comment" class="input_comment"
                                               placeholder="Add a public comment...">
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="row mt-4">
                                <div class="col-1">
                                    <img id="img" width="48" src="images/icon/avatar.png" class="rounded-circle">
                                </div>
                                <div class="col-11">
                                    <div><b>Vasudha Deshpande</b> 3 months ago</div>
                                    <div>Mummy ke taane aur arijit ke gaane... Dil ko chhu jaate hain❤😘</div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-1">
                                    <img id="img" width="48" src="images/icon/avatar.png" class="rounded-circle">
                                </div>
                                <div class="col-11">
                                    <div><b>Vasudha Deshpande</b> 3 months ago</div>
                                    <div>Mummy ke taane aur arijit ke gaane... Dil ko chhu jaate hain❤😘</div>
                                </div>
                            </div> -->
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
