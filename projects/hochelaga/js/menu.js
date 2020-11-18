$(function () {

    var button = $('#hamburger');
    var menu = $('#unroll');
    var link = $('#unroll a');

    button.click(function(){
       if (button.hasClass('active')){
           button.removeClass('active');
           menu.removeClass('active');
       }
       else{
           button.addClass('active');
           menu.addClass('active');
       }
    });

    link.click(function(){
       button.trigger('click');
    });

});