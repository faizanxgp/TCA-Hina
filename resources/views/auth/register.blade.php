@extends('layouts.auth')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>

					<div class="panel-body">
						<form class="form horizontal" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="row">
								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="name" class="control-label">Name</label>

									<div class="">
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

										@if ($errors->has('name'))
											<span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email" class="control-label">E-Mail Address</label>

									<div class="">
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

										@if ($errors->has('email'))
											<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password" class="control-label">Password</label>

									<div class="">
										<input id="password" type="password" class="form-control" name="password" required>

										@if ($errors->has('password'))
											<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label for="password-confirm" class="control-label">Confirm Password</label>

									<div class="">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="">
										<button type="submit" class="btn btn-primary">
											Register
										</button>
									</div>
									<div class="">
										<p><br />
										Already registerd? <a href="{{ route('login') }}">Signin</a>
										</p>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
