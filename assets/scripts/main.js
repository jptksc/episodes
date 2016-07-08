
/***********************************************************************************
  
Panel Toggles
  
************************************************************************************/

$(document).ready(function() {
    $(document).on('click', '.open', function() {
        var myelement = $(this).attr('href');

        $('.opened').not(myelement).addClass('fade-out');

        $(myelement).removeClass('fade-out closed').addClass('opened animated fast fade-in');

        setTimeout(function(){
            $('.opened').not(myelement).removeClass('opened').addClass('closed');
        }, 500);
        
        return false;
    });
    
    $(document).on('click', '.close', function() {
        var myelement = $(this).attr('href');
        
        $(myelement).removeClass('fade-in opened').addClass('animated fast fade-out');

        setTimeout(function(){  
            $(myelement).addClass('closed');
        }, 500);
        
        return false;
    });
});

/***********************************************************************************
  
Video Toggles
  
************************************************************************************/

$(document).ready(function() {
    $(document).on('click', '.start', function() {
        
        // Gather video variables.
        var videoType = $(this).data('video-type');
        var videoID = $(this).data('video-id');
        
        $('#video .video').addClass(''+videoType+'');
        
        // YouTube embeds.        
        if (videoType === 'youtube') {
            $('#video .video').empty().append('<iframe src="//www.youtube.com/embed/'+videoID+'?rel=0&autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        } 
        
        // Vimeo embeds.
        if (videoType === 'vimeo') {
            $('#video .video').empty().append('<iframe src="https://player.vimeo.com/video/'+videoID+'?autoplay=1" frameborder="0" autoplay="true" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        }

        // Wistia embeds.
        if (videoType === 'wistia') {
            $('#video .video').empty().append('<iframe src="//fast.wistia.net/embed/iframe/'+videoID+'" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen></iframe><script src="//fast.wistia.net/assets/external/E-v1.js"></script>');
        }
        
        return false;
    });
    
    $(document).on('click', '.stop', function() {
        setTimeout(function() {
            $('#video .video').empty().removeClass('youtube vimeo');
        }, 200);
        
        return false;
    });
});

/***********************************************************************************
  
Counting Plays and Loves
  
************************************************************************************/

$(document).ready(function(){
    $(document).on('click', '.count', function() {

        // Variables.
        var video = $(this).data('video');
        var meta = $(this).data('meta');

        $.ajax({
            type: 'POST',
            url: 'assets/works/post-count.php',
            data: {video: video, meta: meta}
        });

        $('#'+video+' .'+meta+'').addClass('animated fast fade-out');

        setTimeout(function(){  
            $('#'+video+' .'+meta+' span').load('index.php #'+video+' .'+meta+' span');
            $('#'+video+' .'+meta+'').removeClass('fade-out').addClass('fade-in');
        }, 500);

        return false;
    });
});

/***********************************************************************************
  
The More Panel for Videos
  
************************************************************************************/

$(document).ready(function(){
    $('.more').click(function(){

        // Variables.
        var video = $(this).data('video');
        var video_id = $(this).data('video-id');
        var video_type = $(this).data('video-type');

        var $play = '<a class="icon play open start count" href="#video" data-video-type="'+video_type+'" data-video-id="'+video_id+'" data-video="'+video+'" data-meta="plays" style="background-image: url(\'content/'+video+'.jpg\');"></a>';
        var $title = $('#'+video+' .copy').contents('h2');
        var $text = $('#'+video+' .copy').contents('p');

        $('#more .content').empty().append($play).append($title.clone()).append($text.clone());
    });
});

/***********************************************************************************
  
Contact Form Textarea Limitation & Autosize
  
************************************************************************************/

$(document).ready(function() {
    $('textarea').autosize();
});

$('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = 600,
        remain = parseInt(set - tlength);
    $('p.characters').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1));
    }
});

/***********************************************************************************
  
Contact Form Processing
  
************************************************************************************/

$(function() {

    // Get the form.
    var form = $('#contact-form');

    // Get the messages div.
    var formMessages = $('#contact-form .form-message');

    // Set up an event listener for the contact form.
    $(form).submit(function(e) {

        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })

        .done(function(response) {

            // Make sure that the formMessages div has the 'success' class.
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text.
            $(formMessages).text(response);

            // Clear the form.
            $('#name').val('');
            $('#email').val('');
            $('#message').val('');
        })

        .fail(function(data) {

            // Make sure that the formMessages div has the 'error' class.
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
        });
    });
});

/***********************************************************************************
  
Mailchimp Form Processing
  
************************************************************************************/

$(function() {

    // Get the form.
    var form = $('#mailchimp-form');

    // Get the messages div.
    var formMessages = $('#mailchimp-form .form-message');

    // Set up an event listener for the subscribe form.
    $(form).submit(function(e) {

        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })

        .done(function(response) {

            // Make sure that the formMessages div has the 'success' class.
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text.
            $(formMessages).text(response);

            // Clear the form.
            $('#mc-email').val('');
        })

        .fail(function(data) {

            // Make sure that the formMessages div has the 'error' class.
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured.');
            }
        });
    });
});
