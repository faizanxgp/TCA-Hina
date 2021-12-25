@extends('layouts.auth')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">ADMIN Login</div>
					<div class="panel-body">
						<form class="form horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
							{{ csrf_field() }}
							<div class="row">
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email" class="control-label">E-Mail Address</label>

									<div class="">
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
									<div class="">
										<div class="checkbox">
											<label> <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me </label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="">
										<button type="submit" class="btn btn-primary">
											Login
										</button>


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