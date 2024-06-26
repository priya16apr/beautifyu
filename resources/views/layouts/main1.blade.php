<!DOCTYPE html>
<html lang="zxx">

@php $setting = getAllSetting(); @endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex">
    <link rel="icon" type="image/x-icon" href="{{$setting['favicon']}}">

    @yield('header-seo')
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">

    <script src="/js/common-form-validation.js"></script>
</head>

<body>
    
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <div class="offcanvas__logo"><a href="/"><img src="{{$setting['company_logo']}}" alt="{{$setting['company_logo_alt']}}"></a></div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            @if(session('beautify_customer'))
                <a href="{{route('myaccount')}}">My Account</a>
                <a href="{{route('logout')}}">Logout</a>
            @else
                <a href="{{route('login')}}">Login</a>
                <!-- <a href="{{route('signup')}}">Register</a> -->
                <a href="{{route('signup_step1')}}">Register</a>
            @endif
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img src="{{$setting['company_logo']}}" alt="{{$setting['company_logo_alt']}}"></a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-8 text-right"></div>
                <div class="col-lg-3">
                    <div class="header__right">
                        
                        @if(session('beautify_customer'))
                            <div class="header__right__auth">
                                <a href="{{route('myaccount')}}" class="shoping-ccart">My Account</a>
                                <a href="{{route('logout')}}" class="shoping-ccart">Logout</a>
                            </div>
                        @else
                            <div class="header__right__auth">
                                <a href="{{route('login')}}" class="shoping-ccart">Login</a>
                                <a href="{{route('signup_step1')}}" class="shoping-ccart">Register</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    
    @yield('mid-content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Top Products Categories:</h6>
                        {{ getFooterMenu() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-dark last-footer">
            <div class="container">
                <div class="row pt-4">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="/"><img src="{{$setting['company_logo']}}" alt="{{$setting['company_logo_alt']}}"></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer__widget">
                            <h6>Useful Links</h6>
                            <ul>
                                @php App\Http\Controllers\SettingController::getContentPage(); @endphp
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer__widget">
                            <h6>Account</h6>
                            <ul>
                                <li><a href="{{ url('my-account') }}">My Account</a></li>
                                <li><a href="{{ url('shopping-cart') }}">My Cart</a></li>
                                <li><a href="{{ url('check-out') }}">Checkout</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer__widget">
                            <h6>Need Assisstance?</h6>
                            <ul>
                            <li>Email us: <a href="{{$setting['footer_emailid']}}">{{$setting['footer_emailid']}}</a></li>
                            <li>Whatsapp: <a href="tel:{{$setting['footer_whatsapp']}}">{{$setting['footer_whatsapp']}}</a></li>
                            <li>Call us on: <a href="tel:{{$setting['footer_callus']}}">{{$setting['footer_callus']}}</a></li>
                            </ul>
                            <h6 class="mt-4">CONNECT with us</h6>
                            <div class="footer__social">
                                @if($setting['social_facebook'])
                                    <a target="_blank" href="{{$setting['social_facebook']}}"><i class="fa fa-facebook"></i></a>
                                @endif

                                @if($setting['social_twitter'])
                                    <a target="_blank" href="{{$setting['social_twitter']}}"><i class="fa fa-twitter"></i></a>
                                @endif

                                @if($setting['social_youtube'])
                                    <a target="_blank" href="{{$setting['social_youtube']}}"><i class="fa fa-youtube-play"></i></a>
                                @endif

                                @if($setting['social_instagram'])
                                    <a target="_blank" href="{{$setting['social_instagram']}}"><i class="fa fa-instagram"></i></a>
                                @endif

                                @if($setting['social_pinterest'])
                                    <a target="_blank" href="{{$setting['social_pinterest']}}"><i class="fa fa-pinterest"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright__text">
                        <p>Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> All rights reserved
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </footer>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/main.js"></script>

    <script>
        $('#recipeCarousel').carousel({
            interval: 10000
        })

        $('.carousel .carousel-item').each(function () {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

    </script>

</body>
</html>

@yield('footer-js')