<section id="left-navigation">
    <a href="{{ URL::route('dashboard') }}">
    <div class="user-image">
        <img src="/img/testavatar-80.png" />

        <div class="user-online-status"><span class="user-status is-online  "></span> </div>
    </div>
    </a>

    <ul class="social-icon">
        <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-github"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-bitbucket"></i></a></li>
    </ul>

    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="index.html" title="">
            <h1>Broking Club</h1>
        </a>
        <a class="phone-nav-control" href="javascript:void(0)">
            <span class="fa fa-bars"></span>
        </a>
        <div class="clearfix"></div>
    </div>

    @include('layouts.parts.game.mainNav')

</section>