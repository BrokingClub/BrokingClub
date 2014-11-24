@extends('layouts.lockscreen')

@section('content')
                <div class="login-box">
                    <div class="login-content">
                        <i class="fa fa-meh-o fa-5x"></i>
                        <h3>Do you want to leave the club of cool people forever?</h3>

                         <br/>

                        <div class="row">
                            <div class="col-md-12">
                        {{ QForm::open(['action' => array('UsersController@delete', $user->id) , 'method' => 'POST']) }}
                            {{ QForm::btn('danger', 'Delete my account permanently', 'remove', ['class' => 'col-md-12']) }}
                            <br/>
                            <br/>
                            <a href="http://broking.club" class="btn ls-dark-btn ladda-button col-md-12">
                                Go back
                            </a>
                        {{ QForm::close() }}
                        </div>
                        </div>
                    </div>
                </div>

@endsection

@section('beforeFooter')
{{-- HTML::script('fickle/js/pages/login.js') --}}
@endsection


