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
        <!--Email drop down start-->
        <a href="{{ URL::route('messages.index') }}">
            <span class="fa fa-envelope-o"></span>
            <span class="badge badge-red">3</span>
        </a>
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