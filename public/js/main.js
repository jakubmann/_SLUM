var red = '#e55757';
var green = '#3a9e4c';

$('document').ready(function() {
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
                    $('#register-form').html('<div class="alert--success">Registered successfully!</div>');
                    setTimeout('window.location.href = "index.php"; ', 1000);
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
                minlength: 3
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
                minlength: 'Username must have at least 3 characters'
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
