
var checkOnScreen = function(div){
    return !$(div).visible();
};


var OverlayVideo = function (obj) {

    var overlay = obj.siblings(".overlay-video");

    if(obj.get(0).paused){
        overlay.fadeIn(500);
    }
    else{
        overlay.fadeOut(500);
    }

};

var pauseVid = function(objJS){
    objJS.pause();
    OverlayVideo($(objJS));
}

var playVid = function(objJS){
    objJS.play();
    OverlayVideo($(objJS));
}

var interfaceVid = function(objJS){
    objJS.paused ? playVid(objJS) : pauseVid(objJS);
}

var restartVid = function(objJS){
    objJS.currentTime = 0;
    objJS.load();
    objJS.play()
    OverlayVideo($(objJS));
}

$(function () {

    $("video").click(function () {
        interfaceVid(this);
    });
    $(".play").click(function(){
        var video = $(this).parent().parent().siblings("video");
        interfaceVid(video.get(0));
    });
    $(".restart").click(function(){
        var video = $(this).parent().parent().siblings("video");
        restartVid(video.get(0));
    });
    $(".home video").trigger('click');

    $("video").each(function () {
        OverlayVideo($(this));
        this.volume = 0.5;
    });


    $(document).scroll(function (event) {
        $("video").each(function(){

            if(checkOnScreen(this)){
                pauseVid(this);
            }
            else{
                playVid(this);
            }

        });
    });

});