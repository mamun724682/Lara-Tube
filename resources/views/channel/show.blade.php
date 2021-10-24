@extends('layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <!-- Profile section -->
        <div class="container-fluid">
            <div class="grid_title">Channel</div>
            @if($channel->editable())
                <form action="{{ route('channels.update', $channel->id) }}" method="post" enctype="multipart/form-data" id="update-channel-form">
                    @csrf
                    @method('PATCH')

                    <div class="row p-2">
                        <div class="col-md-2 col-xs-2 mt-4">
                            <div class="channel-avatar">
                                <div class="channel-avatar-overlay" onclick="document.getElementById('image').click()">
                                    <i class="fa fa-camera-retro" aria-hidden="true" style="font-size: xxx-large;"></i>
                                </div>
                                <img src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>
                        <input onchange="document.getElementById('update-channel-form').submit()" type="file" name="image" id="image" class="d-none">

                        <div class="col-md-6  col-xs-6 pl-2">
                            <div class="profile">
                                <div class="profile_title">
                                    Name: <input type="text" name="name" value="{{ $channel->name }}">
                                    <div class="float-right">
                                        <subscribe-button :initial-subscriptions="{{ $channel->subscriptions }}" :channel="{{ $channel }}"/>
                                    </div>
                                </div>
                                <div class="profile_title1">Email: {{ $channel->user->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-md-12 col-xs-12">
                            <textarea name="description" class="form-control" id="">{{ $channel->description }}</textarea>
                        </div>
                    </div>

                    <div class="clearfix">
                        <button class="btn btn-primary float-right m-2">Update Channel</button>
                    </div>
                </form>
            @else
                <div class="row p-2">
                    <div class="col-md-2 col-xs-2 mt-4">
                        <div class="channel-avatar">
                            <img src="{{ $channel->image() }}" alt="">
                        </div>
                    </div>

                    <div class="col-md-6  col-xs-6 pl-2">
                        <div class="profile">
                            <div class="profile_title">
                                Name: {{ $channel->name }}
                                <div class="float-right">
                                    <subscribe-button :initial-subscriptions="{{ $channel->subscriptions }}" :channel="{{ $channel }}"/>
                                </div>
                            </div>
                            <div class="profile_title1">Email: {{ $channel->user->email }}</div>

                        </div>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-12 col-xs-12">
                        {{ $channel->description }}
                    </div>
                </div>
            @endif
        </div>
        <!-- Profile Section -->

        <hr>
        <div class="container-fluid">
            <div class="grid_title">Videos</div>
            <div class="card p-2 bg-white">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $video)
                            <tr>
                                <td><img src="{{ $video->thumbnail }}" width="40px" alt="" class="rounded"></td>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->views }}</td>
                                <td>{{ $video->percentage == 100 ? 'Live' : 'Processing' }}</td>
                                <td><a href="{{ route('video.show', $video->id) }}"><i class="fas fa-eye"></i> View</a></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $videos->links() }}
                </div>
            </div>

        </div>

        <p><br></p>
        <p><br></p>
    </div>
@endsection
