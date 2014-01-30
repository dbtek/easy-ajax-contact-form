$(document).ready(function(){

    var eacForm = $('#eac-form');
    eacForm.submit(function(e){
        var eacAlert = $('#eac-alert');
        eacAlert.fadeOut();

        $.post('service.php',$(this).serialize(), function(data){
            data = $.parseJSON(data);
            if(data.status == 'fail'){
                eacAlert.html(data.log);
                eacAlert.fadeIn();
            }
            else {
                var eacThanks = $('#eac-thanks');
                eacThanks.html('Your message has been sent. Thanks for the feedback!');
                eacForm.fadeOut();
                eacThanks.fadeIn();
            }
        });

        e.preventDefault();
    });

});