<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>THE LOTUS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('public/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('public/assets/css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .left-section {
            background: url("{{ asset('public/assets/img/login-side.jpg') }}") no-repeat center center;
            display: none;
            background-size: cover;
            width: 50%;
        }

        .left-section {
            background: url("{{ asset('public/assets/img/login-side.jpg') }}") no-repeat center center;
            display: block;
            background-size: cover;
            width: 50%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left-section"></div>
        <div class="right-section">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" width="300" style="align-items: center">
            <div class="login-container">
                <div class="logo-login">
                    <img src="{{ asset('public/assets/img/logo.png') }}">
                </div>
                <form class="login-form" action="" id="loginForm">
                    @csrf
                    <div class="form-control">
                        <label for="email">Email Address</label>
                        <div class="each_field">
                            <i class="fas fa-user icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                id="email" autocomplete="username" required>
                        </div>
                        <span class="text-danger error-email"></span>
                    </div>

                    <div class="form-control">
                        <label for="password">Password</label>
                        <div class="each_field">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" name="password" placeholder="Password" id="password"
                                autocomplete="current-password" required>
                        </div>
                        <span class="text-danger error-password"></span>
                    </div>

                    <button type="submit" id="btnDataSave">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/js/sweetalert.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                }
            },
            submitHandler: function(form) {
                $('#btnDataSave').text('Processing...').prop('disabled', true);
                $.ajax({
                    url: "{{ route('loginsubmit') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(form).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            showToast(response.message, 'success');
                            $('#loginForm')[0].reset();
                            setTimeout(function() {
                                window.location.href =
                                    '{{ url('admin/dashboard') }}';
                            }, 2000);
                        } else {
                            showToast(response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $('.text-danger').text('');
                            for (let field in errors) {
                                $(`.error-${field}`).text(errors[field][0]);
                            }
                        } else {
                            showToast('Something went wrong. Please try again.',
                                'error');
                        }
                    },
                    complete: function() {
                        $('#btnDataSave').text('Login').prop('disabled', false);
                    }
                });
            }
        });

        function showToast(message, type = 'success') {
            const toastClass = type === 'success' ? 'arToaster' : 'arToaster-error';
            const toastElement = `<div class="${toastClass}">${message}</div>`;
            $("body").append(toastElement);

            setTimeout(() => {
                $(`.${toastClass}`).addClass("show");
            }, 20);

            setTimeout(() => {
                $(`.${toastClass}`).removeClass("show");
                setTimeout(() => {
                    $(`.${toastClass}`).remove();
                }, 400);
            }, 2000);
        }
    });
</script>

</html>
