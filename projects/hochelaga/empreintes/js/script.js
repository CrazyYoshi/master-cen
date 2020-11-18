var scrollToAnchor = function (anchor) {
    anchor = $(anchor);
    $('html,body').stop().animate(
        {scrollTop: anchor.offset().top},
        'slow',
        'swing'
    );


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
        ion.sound.play('son-hochelaga-femme');
        return true;
    }
    else if (bool) {
        ion.sound.stop('son-hochelaga-femme');
        return false;
    }
};


$(function () {

    $(document).bind('scroll', function() {
        // "Disable" the horizontal scroll.
        if ($(document).scrollLeft() !== 0) {
            $(document).scrollLeft(0);
        }
    });

    var audioPlay = false;
    ion.sound({
        sounds: [
            {name: "son-hochelaga-femme"}
        ],
        path: "audio/",
        preload: true,
        multiplay: false,
        volume: 1.0
    });

    var offsets = getOffsets("section");
    var nbSections = offsets.length;
    var step = animateByOffsets();
    audioPlay = playAudioForAnchor(audioPlay);


    //Event binding

    $(document).scroll(function (event) {
        step = animateByOffsets();
        audioPlay = playAudioForAnchor(audioPlay);
    });

    var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel"

    $(document).bind(mousewheelevt, function (e) {

        var delta = (mousewheelevt == "DOMMouseScroll")? -e.detail : e.originalEvent.wheelDelta;
        var newStep = step;
        if (delta / 120 > 0) {
            newStep--;
        }
        else {
            newStep++;
        }
        newStep = (newStep < 0) ? 0 : (newStep >= nbSections) ? nbSections - 1 : newStep;
        scrollToAnchor("#" + newStep);

    });
});