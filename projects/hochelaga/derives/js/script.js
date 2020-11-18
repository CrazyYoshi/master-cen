$(window).on("load",function(){ "use strict";
    $(".loader").fadeOut(800);
    checkVisibilityToPlay();
    setTimeout(checkVisibilityToPlay, 1000);
});
// loader start
// loader end

var scrollToAnchor = function (anchor) {
    var anchor = $(anchor);
    $('html,body').stop().animate(
        {scrollTop: anchor.offset().top},
        'slow',
        'swing'
    );


};

var checkOnScreen = function(div){
    return !$(div).visible();
};

var actualAnchor = function (offsets) {
    var scroll = $(document).scrollTop();
    var index = 0;
    for (var j = 0; j < offsets.length; j++) {
        if (scroll >= offsets[j]) {
            index = j;
        }
    }
    return index;
};

var getOffsets = function (divs) {
    var i = 0;
    var offsets = [];
    $('section').each(function () {
        offsets[i] = $(this).offset().top;
        i++;
    });
    return offsets;
};

var animateByOffsets = function () {
    var actualStep = actualAnchor(getOffsets('section'));

    //Menu activate
    var stepid = 'a[link="#' + parseInt(actualStep) + '"]';
    $("nav .active-state").removeClass('active-state');
    $(stepid).addClass('active-state');

    //Section active
    var prevStep = (actualStep - 1 < 0) ? 0 : actualStep - 1;
    var nextStep = (actualStep + 1 > getOffsets('section').length) ? getOffsets('section').length : actualStep + 1;
    $("#" + actualStep + " > *").addClass("active");

    if (nextStep != actualStep)
        $("#" + nextStep + " > *").removeClass("active");
    if (prevStep != actualStep)
        $("#" + prevStep + " > *").removeClass("active");


    return actualStep;
};

var playAudioForAnchor = function (bool) {
    if (actualAnchor(getOffsets('section')) == 0) {
        ion.sound.play('son-empreintes');
        return true;
    }
    else if (bool) {
        ion.sound.stop('son-empreintes');
        return false;
    }
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

var checkVisibilityToPlay = function(){
    $(".row").each(function(){
        if($(this).visible(true)){
            $(this).find('.left').each(function(){$(this).addClass('visible')});
            $(this).find('.right').each(function(){$(this).addClass('visible')});
        }
        else{
            $(this).find('.left').each(function(){$(this).removeClass('visible')});
            $(this).find('.right').each(function(){$(this).removeClass('visible')});
        }
    });

    $("video").each(function(){

        if(checkOnScreen(this)){
            pauseVid(this);
        }
        else{
            playVid(this);
        }

    });



};
$(function () {

    $(document).bind('scroll', function() {
        // "Disable" the horizontal scroll.
        if ($(document).scrollLeft() !== 0) {
            $(document).scrollLeft(0);
        }
    });

    var userMuted = false;
    ion.sound({
        sounds: [
            {name: "sonITWMythe"}
        ],
        path: "content/scene 4 - mythe/",
        preload: true,
        multiplay: false,
        volume: 0.8
    });


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

    $(".scene4 #play").click(function(){
        userMuted = !userMuted;
       !userMuted ?  ion.sound.play('sonITWMythe') : ion.sound.stop('sonITWMythe');
    });

    //audioPlay = playAudioForAnchor(audioPlay);


    //Event binding

    $("nav a").click(function () {
        scrollToAnchor($(this).attr("link"));
    });

    $(document).scroll(function (event) {
        step = animateByOffsets();
        checkVisibilityToPlay();

        if($(".scene4").visible(true) && !userMuted){
            ion.sound.play('sonITWMythe');
        }else{
            ion.sound.stop('sonITWMythe');
        }

        //audioPlay = playAudioForAnchor(audioPlay);
    });



});