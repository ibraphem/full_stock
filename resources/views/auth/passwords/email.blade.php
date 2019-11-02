@extends('layouts.front')

@section('content')
    <div class="login-background"></div>
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                @if(!empty(DB::table('flexible_pos_settings')->first()->logo_path))
                    <img src="{{asset(DB::table('flexible_pos_settings')->first()->logo_path)}}" alt="" height="70px">
                @else
                    <img src="{{asset('images/fpos.png')}}" alt="" height="70px">
                @endif

            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
                {{--<div class="panel-heading">Reset Password</div>--}}
            <p class="login-box-msg">Reset Password</p>
                {{--<div class="panel-body">--}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                {{--</div>--}}
            </div>
        </div>
    {{--</div>--}}
{{--</div>--}}
{{--</main>--}}
@endsection
