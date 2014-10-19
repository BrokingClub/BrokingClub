@extends('layouts.lockscreen')

@section('content')

<div class="login-box">
    <div class="login-content">
        <div class="login-user-icon">
            <i class="glyphicon glyphicon-user"></i>
            <!--<img src="images/login.png" alt="Logo"/>-->
        </div>
        <h3>Admit Yourself</h3>
    </div>

    <div class="login-form">

        <form id="form-register" action="#" class="form-horizontal ls_form">
            <div class="input-group ls-group-input">
                <input class="form-control" type="text" placeholder="Name">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>

            <div class="input-group ls-group-input">
                <input class="form-control" type="text" placeholder="someone@mail.com">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            </div>


            <div class="input-group ls-group-input">
                <input type="password" placeholder="Password" name="password" class="form-control" value="">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            </div>
            <div class="input-group ls-group-input">
                <input type="password" placeholder="Repeat password" name="repeat-password" class="form-control" value="">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            </div>
            <div class="input-group ls-group-input login-btn-box">
                <button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
                    <span class="ladda-label">Register</span>
                <span class="ladda-spinner"></span></button>

                <a class="" href="login.html">Login</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('beforeFooter')
    {{ HTML::script('fickle/js/pages/registration.js') }}
@endsection