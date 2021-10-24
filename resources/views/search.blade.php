@extends('layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-10">

        @if($videos->count() > 0)
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
                        {{ $videos->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        @endif

        @if($channels->count() > 0)
            <div class="container-fluid mt-4">
                <div class="grid_title">Channels</div>
                <div class="card p-2 bg-white">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Videos</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($channels as $channel)
                            <tr>
                                <td><img src="{{ $channel->image() }}" width="40px" alt="" class="rounded"></td>
                                <td>{{ $channel->name }}</td>
                                <td>{{ $channel->videos_count }}</td>
                                <td><a href="{{ route('channels.show', $channel->id) }}"><i class="fas fa-eye"></i> View</a></td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $channels->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        @endif

        <p><br></p>
        <p><br></p>
    </div>
@endsection
