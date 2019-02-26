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
    var postCount = 0;
    var postDisplay = 3;
    var page = 1;

    $.post('/home/pageNumber', {
        postCount: postDisplay
    }, function(data) {
        pageCount = data;
        $('.pagenumber').html(page + "/" + pageCount);
    });

    $(".posts__button--next").click(function() {
        if (page != pageCount) {
            postCount += postDisplay;
            page++;
            $('.posts__button--previous').show();
        }
    });

    $(".posts__button--previous").click(function() {
        if (postCount - postDisplay >= 0) {
            postCount -= postDisplay;
            page--;
            $('.posts__button--next').show();
        }
        else {
            $('.posts__button--previous').hide();
        }
    });

    $(".posts__button").click(function() {
        console.clear();
        console.log('page: ' + page);
        console.log('postCount: ' + postCount);

        if (page <= pageCount) {
            if (page == pageCount) {
                $('.posts__button--next').hide();
            }
            $('html, body').animate({
                scrollTop: $("#posts").offset().top
            }, 250);
            $('.posts').fadeOut('fast', function() {
                $(".posts").load("/home/posts", {
                    postCount: 3,
                    previousCount: postCount
                });
                $('.posts').fadeIn(500);
            });
            $('.pagenumber').html(page + "/" + pageCount);
        }
    });

    $(".submissions__resolve").each(function(i, obj) {
        if ($(this).html() == 0) {
            $(this).css('background-color', red);
            $(this).css('color', red);
        }
        else {
            $(this).css('background-color', green);
            $(this).css('color', green);
        }
    });

    $(".submissions__resolve").click(function() {
        var outcome = $(this).html();
        var id = $(this).attr('rel');

        if (outcome == 0) {
            outcome = 1;
        }
        else if (outcome == 1) {
            outcome = 0;
        }

        $.ajax({
            type: 'POST',
            url: '/admin/resolve',
            data: ({"id":id, "outcome":outcome}),
            success: function(data) {
                console.log(data);
                if (data == '1') {
                    setTimeout('window.location.href = "/admin/submissions"; ', 0);
                }
            },
            error: function(data) {
            }
        });
    });

    $(".submissions__delete").click(function() {
        var del = true;
        var id = $(this).attr('rel');
        if (window.confirm("Are you sure?")) {
            $.post('/admin/delete', {
                id: id
            });
        }
        else {
            var del = false;
        }
        console.log(del);
        if (del) {
            $(this).parent().parent().fadeOut('slow');
        }
    });

    //text form
    function submitTextForm() {
        var data = $('#text-form').serialize();
        $.ajax({
            type: 'POST',
            url: '/home/submitPost',
            data: data,
            success: function(data) {
                if (data == '0') {
                    $('.submit_text__wrapper').css('border-color', green);
                    $('.text__title').css('color', green);
                    $('.text__body').css('color', green);
                    $('#error').html('<div class="alert">Posted!</div>');
                    setTimeout('window.location.href = "/"; ', 1000);
                } else if (data == '1') {
                    $('#error').html('There already is a post with this text!');
                } else if (data == '3') {
                    $('#error').html('You must be logged in!');
                }

            }
        });
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
            url: '/register/register',
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
            url: '/login/login',
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

    //submission
    function submitSubmissionForm() {
        var data = $('#submission-form').serialize();

        $.ajax({
            type: 'POST',
            url: '/about/submit',
            data: data,
            success: function(data) {
                if (data == "1") {
                    $(".submission-form__subject").css("border-color", green);
                    $(".submission-form__subject").css("color", green);
                    $(".submission-form__description").css("border-color", green);
                    $(".submission-form__description").css("color", green);
                    $(".submission-form__submit").css("background-color", green);
                    $(".submission-form__message").html("Your submission will be considered");
                }
                else if (data == "2") {
                    $(".submission-form__subject").css("border-color", red);
                    $(".submission-form__subject").css("color", red);
                    $(".submission-form__description").css("border-color", red);
                    $(".submission-form__description").css("color", red);
                    $(".submission-form__submit").css("background-color", red);
                    $(".submission-form__message").html("Something went wrong.");
                    $(".submission-form__message").css("color", red);
                }
            },
            error: function(data) {
                alert(data.statusText);
            }
        });
    }

    $('#submission-form').validate({
        rules: {
            subject: {
                required: true
            },
            description: {
                required: true
            }
        },
        messages: {
            subject: 'You must enter the subject.',
            description: 'You must enter the description.'
        },
        submitHandler: submitSubmissionForm
    });

    function submitSearchForm() {
        var data = $('#search-form').serialize();
        alert(data);
    }

    $('#search-form').validate({
        rules: {
            search: {
                required: true
            }
        },
        messages: {
            search: ""
        },
        submitHandler: submitSearchForm
    });
});
