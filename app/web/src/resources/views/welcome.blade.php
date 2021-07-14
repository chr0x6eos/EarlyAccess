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
            </div> 
        </div>
    </div>

    <div class="jarallax w3about-img-2">
        <div class="agileinfo-dot">
            <div class="container" style="padding-top:20%">
                <div class="banner_text">
                    <h3>Innovative gameplay</h3>
                    <p style="margin-bottom: 30%">
                        Build on the newest version of the SNAK Engine, Mamba allows for unique gameplay like never before. <br> 
                        With graphics like never seen before you will take on the role of a green mamba and chase your prey through the jungle. An advanced skill system (to be released in a later version) allows players to adapt to their environment. 
                        Learn to use the environment to unlock powerful upgrades and dominate the jungle. But beware of the highly intelligent AI that analyses your game style and uses machine-learning to give you a new challenge every time.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="markets">
        <div class="container">
            <div class="agileits-title"> 
                <h3>Upcoming Releases</h3>
            </div>
            <div class="markets-grids">
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>Multiplayer</h5>
                            <p>Jump into multiplayer battles against up to 128 players in different challenging modi. This feature planned for Q3 this year.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>Skill system</h5>
                            <p>Skill your player to adapt to towards the harsh environment of the jungle. This feature is planned for Q4 this year.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>UI overhaul</h5>
                            <p>General update of the UI to give the best experience possible for all players. This feature is planned for Q4 this year.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>New Content</h5>
                            <p>Constant supply of new maps, skins, skills and multiplayer modi are planned to be released over the course of the next year.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>Story Mode</h5>
                            <p>The main campaign contains over 100 hours of game-play with many side-missions, collectables and more. It will be released Q2 next year.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 w3ls-markets-grid">
                    <div class="agileits-icon-grid">
                        <div class="icon-right">
                            <h5>Bugfixes & Improvements</h5>
                            <p>We are constantly in contact with our community to gather feedback to guarantee the best experience for all our players.</p>
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
                        <h4 style="margin-bottom: 30%">Yes the map is huge. Like really really huge. It is the hugest map you will ever play on.</h4>
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
            </div> 
        </div>
    </div>

    <div class="jarallax">
        <video autoplay muted loop class="gameplay">
            <source src="images/gameplay.mp4" type="video/mp4">
        </video>
    </div>

    <div class="about"> 
        <div class="container"> 
            <div class="welcome">
                <div class="agileits-title"> 
                    <h2>Stats</h2>
                    <p>Currently
                        <strong>
                            @php
                                try {
                                    echo DB::table('users')->count();
                                } catch (\Exception $e) {
                                    echo '0';
                                }
                            @endphp
                        </strong>
                        players are playing. Join them now and engage in thrilling multiplayer battles against friends and foes.</p>
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
                                    <div class="testimonial-img-info">
                                        <h3>Play against up to 128 player in thrilling fast-paced multiplayer battles. Choose from fan-favorite modi such as:</p>
                                        <p>
                                            <h4>- Conquest</h4>
                                            <h4>- Battle Royale</h4>
                                            <h4>- Capture The Flag</h4>
                                            <h4>- Search & Destroy</h4>
                                            <h4>- Team Deathmatch</h4>
                                            <h4>- Survival</h4>
                                            <h4>And many many more...</h4>
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
                    <p>EarlyAccess Studios is an award-winning indie developer-studio located in Vienna, Austria.</p>
                    <h4 class="footer-title-h4">E-Mail</h4><p class="footer-p">admin@earlyaccess.htb</p><br>
                    <h4 class="footer-title-h4">Address</h4><p class="footer-p" style="padding-bottom: 2em">Schönbrunner Schloßstraße 47, 1130 Vienna</p>
                </div>
                <div class="col-md-4 amet-sed amet-medium">
                    <div class="footer-title">
                        <h3>Twitter Feed</h3>
                    </div>
                    <p>We are experiencing issues with the game-key verification API. Please be patient as our team fixes the issue.</p>
                    <p>We are excited to announce that we opened registration for early access today! <a href="/register">Register now!</a></p>
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