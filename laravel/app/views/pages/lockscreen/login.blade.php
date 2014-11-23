@extends('......layouts.lockscreen')

@section('content')
                <div class="login-box">
                    <div class="login-content">
                        <div class="login-user-icon">
                            <i class="glyphicon glyphicon-user"></i>

                        </div>
                        <h3>login &middot get rich</h3>
                        {{--
                        <div class="social-btn-login">
                            <ul>
                                <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-github"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-bitbucket"></i></a></li>
                            </ul>
                        </div>
                        --}}
                    </div>

                    <div class="login-form clearfix">

                            @include('partials.confide-flashmessages')
                            {{ QForm::open(['url' => 'login', 'method' => 'POST']) }}
                                {{ QForm::iconInput('email', 'envelope') }}
                                {{ QForm::iconInput('password', 'lock', 'password') }}
                                <div class="remember-me">
                                    <input class="switchCheckBox" name="remember" type="checkbox" checked data-size="mini"
                                           data-on-text="<i class='fa fa-check'><i>"
                                           data-off-text="<i class='fa fa-times'><i>">
                                    <span>Remember me</span>
                                </div>
                                <div class="input-group ls-group-input login-btn-box">
                                    <button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
                                        <span class="ladda-label"><i class="fa fa-key"></i></span>
                                    </button>
                                    {{ HTML::link('users/forgot_password', 'Forget password', ['class' => 'forgot-password']) }}
                                 </div>

                            {{ QForm::close() }}

                    </div>
                    <div class="forgot-pass-box">
                        <form action="#" class="form-horizontal ls_form">
                            <div class="input-group ls-group-input">
                                <input class="form-control" type="text" placeholder="someone@mail.com">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                            <div class="input-group ls-group-input login-btn-box">
                                <button class="btn ls-dark-btn col-md-12 col-sm-12 col-xs-12">
                                    <i class="fa fa-rocket"></i> Send
                                </button>

                                <a class="login-view" href="javascript:void(0)">Login</a> & <a class="" href="registration.html">Registration</a>

                            </div>
                        </form>
                    </div>

                </div>

@endsection

@section('beforeFooter')
{{-- HTML::script('fickle/js/pages/login.js') --}}
@endsection


