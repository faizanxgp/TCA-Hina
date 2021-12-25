@extends('layouts.auth')

@section('content')
	<div class="container">
		<div class="row login-container column-seperation">
			<div class="col-md-5 col-md-offset-1">
				<h2>
					Sign in to TCA
				</h2>
				<p>
					Use Facebook, Twitter or your email to sign in.
					<br>
					<a href="#">Sign up Now!</a> for a webarch account,It's free and always will be..
				</p>
				<br>
				<button class="btn btn-block btn-info col-md-8" type="button"><span class="pull-left icon-facebook" style="font-style: italic"></span> <span class="bold">Login with Facebook</span></button>
				<button class="btn btn-block btn-success col-md-8" type="button"><span class="pull-left icon-twitter" style="font-style: italic"></span>
					<span class="bold">Login with Twitter</span></button>
			</div>
			<div class="col-md-5">
				<br>
				<form class="login-form validate" method="post" action="{{ route('login') }}" name="login-form">
					{{ csrf_field() }}
					<div class="row">
						<div class="form-group col-md-10">
							<label class="form-label">Email</label>
							<input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required>
							@if ($errors->has('email'))
								<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-10">
							<label class="form-label">Password</label> <span class="help"></span>
							<input class="form-control" id="password" name="password" type="password" required>
							@if ($errors->has('password'))
								<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
							@endif
						</div>
					</div>
					<div class="row">
					<div class="form-group col-md-10">

							<div class="checkbox-new">
								<label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
								</label>
							</div>

					</div>
					</div>

					<div class="row">
						<div class="col-md-10">
							<button class="btn btn-primary btn-cons" type="submit">Login</button>
							<a class="btn btn-link" href="{{ route('password.request') }}">
								Forgot Your Password?
							</a>

							<div class="">
								<p><br />
									Not a member? <a href="{{ route('register') }}">Register</a>
								</p>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
