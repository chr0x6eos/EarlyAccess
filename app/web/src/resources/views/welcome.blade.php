<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EarlyAccess') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ mix('css/nunito.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">

    <link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-light">
<!-- banner -->
<div class="banner">
    <div class="agileinfo-dot">
        <div class="agileits-logo">
            <h1><a href="/">Mamba</a></h1>
        </div>  
        <div class="w3layouts-banner-info">
            <div class="container">
                <div class="w3layouts-banner-slider">
                    <div class="w3layouts-banner-top-slider">
                        <div>
                            <div class="banner_text" style="margin-bottom: 30%">
                                <h3>Early Access available now!</h3>
                                <div class="w3-button" style="padding-top:10%">
                                    <a href="/register">Register now</a>
                                </div>
                                <p>OR</p>
                                <div class="w3-button">
                                    <a href="/login">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about"> 
    <div class="container"> 
        <div class="welcome">
            <div class="agileits-title"> 
                <h2>Welcome to Mamba</h2>
                <p>Mamba is the newest upcoming release of the award winning indie-developer team EarlyAccess Studios.</p>
            </div> 
            <div class="clearfix"> </div>
        </div> 
    </div>
</div>

<div class="jarallax w3about-img-2">
    <div class="agileinfo-dot">
        <div class="container" style="padding-top:20%">
            <div class="banner_text">
                <h3>Innovative gameplay</h3>
                <p style="margin-bottom: 30%">Build on the newest version of the SNAK Engine, Mamba allows for unique gameplay like never before. <br> With graphics like never seen before you will take on the role of a green mamba and chase your prey through the jungle. An advanced skill system (to be released in a later version) allows players to adapt to their environment. </p>
            </div>
        </div>
    </div>
</div>

<!-- markets -->
<div class="markets" id="markets">
    <div class="container">
        <div class="agileits-title"> 
            <h3>Upcoming Features</h3>
        </div>
        <div class="markets-grids">
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-gamepad" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Suspendisse</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Aliquam</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Consectetur</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Bibendum</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Vestibulum</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 w3ls-markets-grid">
                <div class="agileits-icon-grid">
                    <div class="icon-left">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="icon-right">
                        <h5>Fermentum</h5>
                        <p>Phasellus dapibus felis elit, sed accumsan arcu gravida vitae. Nullam aliquam erat at lectus ullamcorper, nec interdum neque hendrerit.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<div class="jarallax w3about-img-3">
    <div class="agileinfo-dot">
        <div class="container" style="padding-top:20%">
            <div class="banner_text">
                <h3>Huge map</h3>
                <div class="testimonial-img-info">
                    <h4 style="margin-bottom: 30%">Yes the map is huge.</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about"> 
    <div class="container"> 
        <div class="welcome">
            <div class="agileits-title"> 
                <h2>Gameplay</h2>
                <p>Check out the latest gameplay below:</p>
            </div> 
            <div class="clearfix"> </div>
        </div> 
    </div>
</div>

<div class="jarallax">
    <video autoplay muted loop id="gameplay">
        <source src="images/gameplay.mp4" type="video/mp4">
    </video>
</div>

<div class="about"> 
    <div class="container"> 
        <div class="welcome">
            <div class="agileits-title"> 
                <h2>Stats</h2>
                <p>Currently 
                    @php
                        try {
                            echo DB::table('users')->count();
                        } catch (\Exception $e) {
                            echo '0';
                        }
                    @endphp
                    players are playing. Join them now!</p>
            </div> 
            <div class="clearfix"> </div>
        </div> 
    </div>
</div>

<div class="jarallax w3about-img-4">
	<div class="testimonial-dot">
        <div class="container">
            <div class="agileits-title testimonial-heading"> 
                <h3>Multiplayer</h3> 
            </div>
            <div class="w3-agile-testimonial">
                <div class="slider">
                    <div class="callbacks_container">
                        <ul class="rslides callbacks callbacks1">
                            <li>
                                <div class="testimonial-img-grid">
                                    <div class="testimonial-img t-img1">
                                        <img src="images/ts2.jpg" alt="" />
                                    </div>
                                    <div class="testimonial-img">
                                        <img src="images/ts3.jpg" alt="" />
                                    </div>
                                    <div class="testimonial-img t-img2">
                                        <img src="images/ts1.jpg" alt="" />
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="testimonial-img-info">
                                    <h3>Play against up to 128 player in thrilling fast-paced multiplayer battles. Choose from fan-favorite modi such as:</p>
                                    <p>
                                        <h4>Conquest</h4>
                                        <h4>Battle Royale</h4>
                                        <h4>Capture The Flag</h4>
                                        <h4>And many more...</h4>
                                    </p>
                                    <p style="margin-bottom: 30%"></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-4 amet-sed"> 
                <div class="footer-title">
                    <h3>About Us</h3>
                </div> 
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-md-4 amet-sed amet-medium">
                <div class="footer-title">
                    <h3>Twitter Feed</h3>
                </div>
                <p>We are experiencing issues with the game-key API. Please be patient as our team fixes the issue.</p>
                <p>We are excited to annouce that we opened registration for early access today! <a href="/register">Register now!</a></p>
            </div>
            <div class="col-md-4 amet-sed ">
                <div class="footer-title">
                    <h3>Subscribe to our newsletter</h3>2017
                <div class="support">
                    <form action="#" method="post">
                        <input type="email" placeholder="Enter email...." required=""> 
                        <input type="submit" value="Subscribe" class="botton">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container">
        <p class="footer-class">© 2021 EarlyAccess Studios . All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
    </div>
</div>
</body>
</html>