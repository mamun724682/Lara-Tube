var myPlayer = videojs('my-video');
var viewLogged = true;

myPlayer.on('timeupdate', function() {
    var percent = Math.ceil(myPlayer.currentTime()/myPlayer.duration() * 100);

    if(percent > 5 && viewLogged){

        axios.put('/videos/' + window.CURRENT_VIDEO_ID)

        viewLogged = false
    }
});
