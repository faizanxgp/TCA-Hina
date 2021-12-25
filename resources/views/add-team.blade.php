@extends('layouts.app')

@section('page_title')
    User Panel
@endsection

@section('page_heading')
    User Dashboard
@endsection


@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <!-- Default box -->
                <div class="grid simple">
                    <div class="grid-title no-border">
                        <h3 class="box-title"></h3>

                        <div class="box-tools pull-right">

                            <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal"
                                                                            class="config"></a> <a href="javascript:;"
                                                                                                   class="reload"></a>
                            <a href="javascript:;" class="remove"></a>

                        </div>
                    </div>
                    <div class="grid-body no-border">
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif

						<h3>Team</h3>
						<form method="post" action="{{ route('post-team') }}">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $team->id }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Team</label>
										<div class="controls">
											<input class="form-control {{ $errors->has('title') ? 'error' : '' }}" type="text" name="title" value="{{ $team->title or old('title') }}">
										</div>
										@if ($errors->has('title'))
											<label class="error" for="title">{{ $errors->first('title') }}</label>
										@endif
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Description</label>
										<div class="controls">
											<input class="form-control {{ $errors->has('comments') ? 'error' : '' }}" type="text" name="comments" value="{{ $team->comments or old('comments') }}">
										</div>
										@if ($errors->has('comments'))
											<label class="error" for="comments">{{ $errors->first('comments') }}</label>
										@endif
									</div>
								</div>


							</div>
							
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
										<label class="form-label">Status</label>
										<div class="controls">
											<input type="radio" name="status" value="0" {{ $team->status == 0 ? 'checked' : '' }} /> Inactive
											<input type="radio" name="status" value="1" {{ $team->status == 1 ? 'checked' : '' }} /> Active
										</div>
										@if ($errors->has('duration'))
											<label class="error" for="status">{{ $errors->first('status') }}</label>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
										<label class="form-label">Invite Members to join</label>
										<div class="controls">
											<textarea class="form-control" name="members" value="" placeholder="Type email address, one in each line"></textarea>
										</div>

									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
										<label class="form-label">Existing Members</label>
										<div class="controls">

											@if(count($members) > 0)
												@foreach($members as $member)
													<input type="checkbox" name="remove[]" value="{{ $member->user->id }}" /> {{ $member->user->name }} - {{ $member->user->email }}<br />
												@endforeach
												<p>Select to remove member</p>
											@endif
										</div>

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


                    <!-- /.box-body -->
                </div>
                <!-- /.box -->






            </div>
        </div>
    </div>
    {{--<div id="myModal" class="modal fade">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                    {{--<h4 class="modal-title">TCA</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<p>Loading...</p>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
