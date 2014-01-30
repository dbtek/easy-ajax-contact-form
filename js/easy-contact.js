$(document).ready(function(){

    $('#eac-form').submit(function(e){
        var eacAlert = $('#eac-alert');
        eacAlert.fadeOut();

        $.post('service.php',$(this).serialize(), function(data){
            data = $.parseJSON(data);
            if(data.status == 'fail'){
                eacAlert.html(data.log);
                eacAlert.fadeIn();
            }
            else{
                var eacThanks = $('#eac-thanks');
                eacAlert.html('Thank you for the feedback!');
                eacThanks.fadeIn();
            }
        });

        e.preventDefault();
    });

});