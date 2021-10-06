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
                                {{--                            <img src="https://joeschmoe.io/api/v1/Youtube">--}}
                                <img src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>
                        <input onchange="document.getElementById('update-channel-form').submit()" type="file" name="image" id="image" class="d-none">

                        <div class="col-md-6  col-xs-6 pl-2">
                            <div class="profile">
                                <div class="profile_title">
                                    Name: <input type="text" name="name" value="{{ $channel->name }}">
                                    <div class="float-right">
                                        <subscribe-button :subscriptions="{{ $channel->subscriptions }}" :channel="{{ $channel }}" inline-template>
                                            <button @click="toggleSubscription" type="button" class="btn btn-danger">
                                                @{{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} @{{ count }} @{{ owner ? 'Subscriber' : '' }}
                                            </button>
                                        </subscribe-button>
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
                                    <subscribe-button :subscriptions="{{ $channel->subscriptions }}" :channel="{{ $channel }}" inline-template>
                                        <button @click="toggleSubscription" type="button" class="btn btn-danger">
                                            @{{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} @{{ count }} @{{ owner ? 'Subscriber' : '' }}
                                        </button>
                                    </subscribe-button>
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
            <div class="grid_title">My Subscription</div>
            <div class="card p-2 bg-white">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Subscription details</th>
                        <th>Started on</th>
                        <th>Expiry on</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Starter</td>
                        <td>21/05/2020</td>
                        <td>30/06/2020</td>
                        <td>Active</td>
                        <td><a href="#"><i class="fas fa-times"></i> Cancel</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>

        <p><br></p>
        <p><br></p>
    </div>
@endsection
