var red = '#e55757';
var green = '#3a9e4c';

$('document').ready(function() {
    //login
    function submitLoginForm() {
        var data = $('#login-form').serialize();

        $.ajax({
            type: 'POST',
            url: '/ajax/login.php',
            data: data,
            success: function(data) {
                if (data == '1') {
                    $('.login__input').css('border-color', green);
                    $('.login__input').css('color', green);
                    setTimeout('window.location.href = "/"; ', 1000);
                } else {
                    $('login__error').html(data);
                    $('.login__input').addClass('error');
                    $('.login__error').html('<p>Incorrect username or password.</p>');
                }
                console.log(data);
            }
        });
    }

    $('#login-form').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            password: '',
            username: ''
        },
        submitHandler: submitLoginForm
    });
});
