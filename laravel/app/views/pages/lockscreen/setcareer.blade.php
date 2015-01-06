@extends('......layouts.lockscreen')

@section('content')
                <div class="login-box career-box">
                    <div class="login-content">
                        <h3><i class="fa fa-rocket"></i>&nbsp; Select your career</h3>
                    </div>

                    <div class="login-form clearfix">
                    <div class="row">
                        @foreach(Career::all() as $career)
                           <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>{{ $career->name }}</h3>
                                    </div>
                                    <div class="col-md-12 col-xs-5">

                                        <div class="career-image" style="background-image: url('/img/career_{{ $career->key  }}.jpg');" >

                                        </div>

                                    </div>
                                    <div class="col-md-12 col-xs-7">
                                    <p>
                                                                                {{ nl2br($career->description) }}
                                                                            </p>
                                        <ul>
                                            <li><b>Start Money:</b><br/>{{ Format::money($career->startmoney) }}</li>
                                            <li><b>Income:</b><br/>{{ Format::money($career->income) }}</li>
                                            <li><b>Level up speed:</b><br/>{{ $career->exp_speed }}%</li>
                                        </ul>
                                        {{ Form::open(['action' => 'PlayersController@doSetCareer', 'method' => 'POST']) }}
                                            {{ Form::hidden('career_id', $career->id) }}
                                            {{ Form::submit('Select', ['class' => 'btn btn-block btn-primary']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>


                           </div>
                        @endforeach

                        </div>
                    </div>

                </div>

@endsection

@section('beforeFooter')
{{-- HTML::script('fickle/js/pages/login.js') --}}
@endsection


