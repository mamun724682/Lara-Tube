@extends('layouts.app')

@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <!-- Profile section -->
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-md-12 col-xs-12">
                    <channel-uploads :channel="{{ $channel }}" inline-template>
                        <div class="card p-3 d-flex justify-content-center align-items-center border"
                             onclick="document.getElementById('video').click()" style="cursor: pointer" v-if="!selected">
                            <i class="fab fa-youtube text-danger" style="font-size: 100px"></i>
                            <p class="text-center">Upload Videos</p>
                            <input type="file" ref="videos" id="video" class="d-none" multiple @change="upload">
                        </div>

                        <div class="card p-3 border" v-else>
                            <div class="my-4" v-for="video in videos">
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="progress[video.name]" aria-valuemin="0" aria-valuemax="100" :style="{ width: `${progress[video.name]}%` }"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 180px; color: white; font-size: 18px;background: #808080">
                                            Loading thumbnail...
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="text-center">@{{ video.name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </channel-uploads>
                </div>
            </div>
        </div>
        <!-- Profile Section -->
    </div>
@endsection
