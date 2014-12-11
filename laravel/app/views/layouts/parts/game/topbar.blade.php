<nav class="navigation">
<div class="container-fluid">
<!--Logo text start-->
<div class="header-logo">
    <a href="{{ URL::route('dashboard') }}" title="">
        <h1>Broking&middot;Club</h1>
    </a>
</div>
<!--Logo text End-->
<div class="top-navigation">
<!--Collapse navigation menu icon start -->
<div class="menu-control hidden-xs">
    <a href="javascript:void(0)">
        <i class="fa fa-bars"></i>
    </a>
</div>
<div class="search-box">
    <ul>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                <span class="fa fa-search"></span>
            </a>
            <div class="dropdown-menu  top-dropDown-1">
                <h4>Search</h4>
                <form>
                    <input type="search" placeholder="what you want to see ?">
                </form>
            </div>

        </li>
    </ul>
</div>

<!--Collapse navigation menu icon end -->
<!--Top Navigation Start-->

<ul>
    <li>
        <a href="{{ URL::route('dashboard') }}">
            <i class="fa fa-money"></i>
            <small>
            {{ Format::money($theplayer->balance) }}
            </small>
        </a>
    </li>
    <li class="dropdown">
        <!--All task drop down start-->
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
            <span class="fa fa-tasks"></span>
            <span class="badge badge-lightBlue">3</span>
        </a>
        <div class="dropdown-menu right top-dropDown-1">
            <h4>All Task</h4>
            <ul class="goal-item">
                <li>
                    <a href="javascript:void(0)">
                        <div class="goal-user-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="goal-content">
                            Wordpress Theme
                            <div class="progress progress-striped active">
                                <div class="progress-bar ls-light-blue-progress six-sec-ease-in-out" aria-valuetransitiongoal="100" aria-valuenow="100" style="width: 100%;">100%</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <div class="goal-user-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="goal-content">
                            PSD Designe
                            <div class="progress progress-striped active">
                                <div class="progress-bar ls-red-progress six-sec-ease-in-out" aria-valuetransitiongoal="40" aria-valuenow="40" style="width: 40%;">40%</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <div class="goal-user-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="goal-content">
                            Wordpress PLugin
                            <div class="progress progress-striped active">
                                <div class="progress-bar ls-light-green-progress six-sec-ease-in-out" aria-valuetransitiongoal="60" aria-valuenow="60" style="width: 60%;">60%</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="only-link">
                    <a href="javascript:void(0)">View All</a>
                </li>
            </ul>
        </div>
        <!--All task drop down end-->
    </li>
    <li class="dropdown">
        <!--Notification drop down start-->
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
            <span class="fa fa-bell-o"></span>
            <span class="badge badge-red">6</span>
        </a>

        <div class="dropdown-menu right top-notification">
            <h4>Notification</h4>
            <ul class="ls-feed">
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-red">
                                            <i class="fa fa-check white"></i>
                                        </span>
                        You have 4 pending tasks.
                        <span class="date">Just now</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-light-green">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </span>
                        Finance Report for year 2013
                        <span class="date">30 min</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-lightBlue">
                                            <i class="fa fa-shopping-cart"></i>
                                        </span>
                        New order received with
                        <span class="date">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-lightBlue">
                                            <i class="fa fa-user"></i>
                                        </span>
                        5 pending membership
                        <span class="date">50 min</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-red">
                                            <i class="fa fa-bell"></i>
                                        </span>
                        Server hardware upgraded
                        <span class="date">1 hr</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                                        <span class="label label-blue">
                                            <i class="fa fa-briefcase"></i>
                                        </span>
                        IPO Report for
                        <span class="lightGreen">2014</span>
                        <span class="date">5 hrs</span>
                    </a>
                </li>
                <li class="only-link">
                    <a href="javascript:void(0)">View All</a>
                </li>
            </ul>
        </div>
        <!--Notification drop down end-->
    </li>
    <li class="dropdown">
        <!--Email drop down start-->
        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
            <span class="fa fa-envelope-o"></span>
            <span class="badge badge-red">3</span>
        </a>

        <div class="dropdown-menu right email-notification">
            <h4>Email</h4>
            <ul class="email-top">
                <li>
                    <a href="javascript:void(0)">
                        <div class="email-top-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="email-top-content">
                            John Doe <div>Sample Mail 1</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <div class="email-top-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="email-top-content">
                            John Doe <div>Sample Mail 2</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <div class="email-top-image">
                            <img class="rounded" src="/img/testavatar.png" alt="user image">
                        </div>
                        <div class="email-top-content">
                            John Doe <div> Sample Mail 4</div>
                        </div>
                    </a>
                </li>
                <li class="only-link">
                    <a href="mail.html">View All</a>
                </li>
            </ul>
        </div>
        <!--Email drop down end-->
    </li>
    {{--
    <li class="hidden-xs">
        <a class="right-sidebar" href="javascript:void(0)">
            <i class="fa fa-comment-o"></i>
        </a>
    </li>
    <li class="hidden-xs">
        <a class="right-sidebar-setting" href="javascript:void(0)">
            <i class="fa fa-cogs"></i>
        </a>
    </li>
    --}}
    <li>
        <a href="/logout">
            <i class="fa fa-power-off"></i>
        </a>
    </li>

</ul>
<!--Top Navigation End-->
</div>
</div>
</nav>