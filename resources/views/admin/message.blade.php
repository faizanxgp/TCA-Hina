@extends('layouts.admin-modal')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">

				<div class="row">
					<div class="col-md-12">
						<form method="post" action="{{ route('admin.post-message') }}">
							{{ csrf_field() }}
							<input type="hidden" name="user_id" value="{{ $user_id }}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label">Subject</label>
										<div class="controls">
											<input class="form-control {{ $errors->has('subject') ? 'error' : '' }}" type="text" name="subject" value="{{ old('subject') }}">
										</div>
										@if ($errors->has('subject'))
											<label class="error" for="subject">{{ $errors->first('subject') }}</label>
										@endif
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label">Message</label>
										<div class="controls">
											<textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message"></textarea>
												
										</div>
										@if ($errors->has('message'))
											<label class="error" for="message">{{ $errors->first('message') }}</label>
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="controls">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</form>

					</div>


				</div>
			</div>

		</div>
	</div>

@endsection
