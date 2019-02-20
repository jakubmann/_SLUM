var red = '#e55757';
var green = '#3a9e4c';



function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25 + o.scrollHeight) + "px";
}


/********************************
 *                               *
 *              AJAX             *
 *                               *
 ********************************/
$('document').ready(function() {

    //text form
    function submitTextForm() {
        var data = $('#text-form').serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax/text.php',
            data: data,
            success: function(data) {
                console.log(data);
                if (data == 0) {
                    $('.text__title').css('border-color', green);
                    $('.text__title').css('color', green);
                    $('.text__body').css('border-color', green);
                    $('.text__body').css('color', green);
                    $('#error').html('<div class="alert">Posted!</div>');
                    setTimeout('window.location.href = "/"; ', 1000);
                }
                if (data == 3) {
                    $('#error').html('<div class="alert">You must be logged in!</div>');
                }

            }
        })
    }

    $('#text-form').validate({
        rules: {
            title: {
                required: true
            },
            body: {
                required: true
            }
        },
        messages: {
            title: 'Please enter a title.',
            body: 'Please enter text.'
        },
        submitHandler: submitTextForm
    });

    //registration
    function submitRegisterForm() {
        var data = $('#register-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'ajax/register.php',
            data: data,
            success: function(data) {
                if (data == 1) {
                    $('#error').html('<div class="alert">Email already taken!</div>');
                } else if (data == 2) {
                    $('#error').html('<div class="alert">Username already taken!</div>');
                } else if (data == 'registered') {
                    $('#register-form').html('<div class="alert--success">Check your email inbox!</div>');
                } else {
                    $('#error').html('<div class="alert">' + data + '</div>')
                }
            }
        });
    }

    $('#register-form').validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 25
            },
            password_confirm: {
                required: true,
                equalTo: '#password'
            },
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            username: {
                required: 'Please enter a username',
                minlenght: 'Username must have at least 3 characters',
                maxlength: 'Username can\'t have more than 20 characters'
            },
            firstname: 'Please enter your first name',
            lastname: 'Please enter your last name',
            password: {
                required: 'Please provide a password',
                minlength: 'Password must have at least 8 characters'
            },
            email: 'Please enter a valid email address',
            password_confirm: {
                required: 'Please confirm your password',
                equalTo: 'Passwords do not match!'
            }
        },
        submitHandler: submitRegisterForm
    });

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
                    $('.login__button_login').css('background-color', green);
                    setTimeout('window.location.href = "/"; ', 1000);
                } else if (data == '2') {
                    $('login__error').html(data);
                    $('.login__input').addClass('error');
                    $('.login__error').html('<p>Incorrect username or password.</p>');
                } else if (data == '3') {
                    $('login__error').html(data);
                    $('.login__input').addClass('error');
                    $('.login__error').html('<p>You must confirm your email.</p>');
                } else if (data == '4') {
                    $('login__error').html(data);
                    $('.login__input').addClass('error');
                    $('.login__error').html('<p>Incorrect email token.</p>');
                }
                console.log(data);
            },
            error: function(data) {
                alert(data.statusText);
            }
        });
    }

    $('#login-form').validate({
        rules: {
            username: {
                required: true
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
