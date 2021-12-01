//Submit edit profile form on button press
$('#form_submit_button').click(function(){
    $('form').each(function(){
        $(this).submit();
    });
});

