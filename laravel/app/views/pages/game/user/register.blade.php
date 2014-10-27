@extends('layouts.lockscreen')

@section('content')

<div class="login-box">
    <div class="login-content">
        <div class="login-user-icon">
            <i class="glyphicon glyphicon-user"></i>
            <!--<img src="images/login.png" alt="Logo"/>-->
        </div>
        <h3>{{ $title }}</h3>
    </div>

    <div class="login-form">
        @include('partials.confide-flashmessages')
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
    </div>
</div>

@endsection

@section('beforeFooter')
    {{ HTML::script('js/pages/registration.js') }}
@endsection