<!DOCTYPE html>
<html lang="en">

<head>
    <title>Villa Loma</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="black">
    <link rel="icon" href="{{ asset('public/front/images/logo.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

    <link rel="stylesheet" href="{{ asset('public/front/css/sharp-thin.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ asset('public/front/css/sharp-solid.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ asset('public/front/css/sharp-regular.css')}}" type="text/css">

    <link rel="stylesheet" href="{{ asset('public/front/css/sharp-light.css')}}" type="text/css">
    <link href="{{ asset('public/front/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/front/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Push Styles -->
    @stack('stylesheet')
</head>

<body>

    <!-- <div id="prelodaer"></div> -->
    @if (!Request::routeIs('userdashboard'))
    <!-- ======================================= header starts ======================================== -->

    <header id="header" class="main_header">
        <div class="container">
            <div class="nav-sec-holder">
                <div class="logo"><a href="index.html">
                        <img src="{{ asset('public/front/images/logo-footer.png')}}" alt=""></a>
                </div>
                <div class="menu-nav">
                    <div class="nav_wrapper">
                        <span class="toggle-menu"><img src="{{ asset('public/front/images/menu-icon.png')}}" alt=""></span>
                        <nav class="nav_sec">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                {{-- <li>
                                    <a href="{{route('our-rooms')}}">Our Room</a>
                                </li> --}}
                                <li class="nav-contact mob_contact">
                                    @auth
                                        @if (Auth::user()->role == 'user')
                                            <a href="{{route('userdashboard')}}">Welcome, {{ Auth::user()->name }}</a>
                                        @else
                                            <a href="{{ route('user-login') }}">Sign In</a>
                                        @endif
                                    @else
                                        <a href="{{ route('user-login') }}">Sign In</a>
                                    @endauth
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ======================================= header ends ======================================== -->
    @endif
    @yield('adminContent')

    @if (!Request::routeIs('userdashboard'))
    <!-- ======================================= main_footer starts ======================================== -->
    <footer class="main_footer" style="background-image: url({{ asset('public/front/images/footer-bg.png')}});">
        <div class="container">
            <div class="footer-up">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="footer-form">
                            <div class="cmn-title">
                                <span>Rooms & Suites</span>
                                <h2>Contact Us</h2>
                            </div>
                            <form action="#">
                                <div class="input-wrapper">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="input-wrapper">
                                    <input type="email" placeholder="Email">
                                </div>
                                <div class="input-wrapper">
                                    <input type="tel" placeholder="Phone Number">
                                </div>
                                <div class="input-wrapper">
                                    <textarea cols="15" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="input-wrapper">
                                    <input type="submit" value="Consult Now">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="foot-info">
                            <h4>Contact Information</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
                            <ul>
                                <li>
                                    <div class="info-logo"><img src="{{ asset('public/front/images/address.png')}}" alt=""></div>
                                    <p>44, Kestopur - Baguiati Flyover, Prafulla Kanan, Narayantala, Kolkata, West Bengal 700059</p>
                                </li>
                                <li>
                                    <div class="info-logo"><img src="{{ asset('public/front/images/mail.png')}}" alt=""></div>
                                    <p><a href="mailto:info@luxuryhotel.com">info@lotushotel.com</a></p>
                                </li>
                                <li>
                                    <div class="info-logo"><img src="{{ asset('public/front/images/phone.png')}}" alt=""></div>
                                    <p><a href="tel:855 100 4444">855 100 4444</a></p>
                                </li>
                            </ul>
                            <div class="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31674.91496597831!2d88.4141541660533!3d22.595416530267062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02759bb5d7c6a9%3A0x6e0766f360bbcff4!2sKestopur%2C%20Kolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1735212092353!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-down">
            <div class="container">
                <div class="footer-down-holder">
                    <p>© 2024 <a href="index.html">The Lotus</a>, All Rights Reserved</p>
                    <ul>
                        <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- ======================================= main_footer ends ======================================== -->
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="responsive.css" type="text/css">
    <link href="{{ asset('public/front/css/aos.css')}}" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/front/css/jquery.fancybox.min.css')}}" />
    <script src="{{ asset('public/front/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('public/front/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('public/front/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/front/js/component.js')}}"></script>
    <script src="{{ asset('public/front/js/edit-js.js')}}"></script>
    <script src="{{ asset('public/front/js/aos.js')}}"></script>
    <!-- Push Script -->
    @stack('scripts')
</body>

</html>
