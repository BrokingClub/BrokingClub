@extends('.........layouts.lockscreen')

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
        <!--
        <form method="POST" action="http://broking.club/users" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="0dBTWyuIhHifyyx0uYYjH0V29PkV9zpzCUdB2Oms">
            <fieldset>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" placeholder="Username" type="text" name="username" id="username" value="">
                </div>
                <div class="form-group">
                    <label for="email">Email <small>Confirmation required</small></label>
                    <input class="form-control" placeholder="Email" type="text" name="email" id="email" value="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form-actions form-group">
                  <button type="submit" class="btn btn-primary">Create new account</button>
                </div>

            </fieldset>
        </form>
        -->

        {{ QForm::open(['url' => 'users']) }}
           {{ QForm::iconInput('username', 'user') }}
           {{ QForm::iconInput('email', 'envelope') }}
           {{ QForm::iconInput('password', 'lock', 'password') }}
           {{ QForm::iconInput('password_confirmation' , 'lock' , 'password') }}

           <div class="input-group ls-group-input login-btn-box">
               <button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
                   <span class="ladda-label">{{ trans('fields.submit_register') }}</span>
               <span class="ladda-spinner"></span></button>

               {{ link_to_route('login', trans('fields.login')) }}
           </div>

        {{ QForm::close() }}

        <!--
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

        -->
    </div>
</div>

@endsection

@section('beforeFooter')
    {{ HTML::script('fickle/js/pages/registration.js') }}
@endsection