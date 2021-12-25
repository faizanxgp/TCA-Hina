@extends('layouts.admin')

@section('page_title')
	Admin Panel
@endsection

@section('page_heading')
	Admin Dashboard
@endsection


@section('content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12 ">

				<!-- Default box -->
				<div class="grid simple">
					<div class="grid-title no-border">
						<h3 class="box-title"></h3>

						<div class="box-tools pull-right">
							<a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
						</div>
					</div>
					<div class="grid-body no-border">
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif


						<h3>Events</h3>
						<form method="post" action="{{ route('admin.post-event') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $event->id }}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label">Event Title <span class="required">*</span> </label>
										<div class="controls">
											<input class="form-control {{ $errors->has('title') ? 'error' : '' }}" type="text" name="title" value="{{ $event->title or old('title') }}">
										</div>
										@if ($errors->has('title'))
											<label class="error" for="title">{{ $errors->first('title') }}</label>
										@endif
									</div>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-6">
									<div class="form-group">
										<label class="">From Date <span class="required">*</span></label>
										<div class="input-append success date col-md-10 col-lg-6 no-padding">
											<input class="form-control datepicker {{ $errors->has('from_date') ? 'error' : '' }}" type="text" name="from_date" value="{{ $event->from_date or old('from_date') }}"> <span class="add-on"><span
														class="arrow"></span><i class="fa fa-th"></i></span>
										</div>
										@if ($errors->has('from_date'))
											<label class="error" for="from_date">{{ $errors->first('from_date') }}</label>
										@endif
										<p>&nbsp;</p>



									</div>
									<div>
										<label class="form-label">&nbsp;</label>
										<div class="controls">
											{{ Form::checkbox('tbc', 1, ($event->ybc==1 ? true : false)) }} Date to be confirmed<br/>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Upto Date <span class="required">*</span></label>
										<div class="input-append success date col-md-10 col-lg-6 no-padding">
											<input class="form-control datepicker {{ $errors->has('upto_date') ? 'error' : '' }}" type="text" name="upto_date" value="{{ $event->upto_date or old('upto_date') }}"> <span class="add-on"><span
														class="arrow"></span><i class="fa fa-th"></i></span>
										</div>
										@if ($errors->has('upto_date'))
											<label class="error" for="upto_date">{{ $errors->first('upto_date') }}</label>
										@endif
										<p>&nbsp;</p>
									</div>
								</div>
							</div>

							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									<div class="form-group">
										<label class="">Repeat After </label>
										<div class="controls">
											{{ Form::select('repeat_year', $repeat_year, null, []) }}

										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="">Repeat Week </label>
										<div class="controls">
											{{ Form::select('repeat_week', $repeat_week, null, []) }}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="">Days </label>
										<div class="controls">
											<input type="checkbox" name="days[]" value="1"> Mon
											<input type="checkbox" name="days[]" value="2"> Tue
											<input type="checkbox" name="days[]" value="3"> Wed
											<input type="checkbox" name="days[]" value="4"> Thu
											<input type="checkbox" name="days[]" value="5"> Fri
											<input type="checkbox" name="days[]" value="6"> Sat
											<input type="checkbox" name="days[]" value="7"> Sun

										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="">Repeat Month </label>
										<div class="controls">
											{{ Form::select('repeat_month', $repeat_month, null, []) }}
										</div>
									</div>
								</div>


							</div>





							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-6">
									<label class="form-label">Country</label>
									<div class="controls">
										{{--{{ Form::select('country', $countries, null, ['placeholder' => 'Country...']) }}--}}
										{{--</div>--}}
										<div class="checkbox-multi check-default">
											{{--<input id="checkbox1" value="1" type="checkbox">--}}
											{{--<label for="checkbox1">Keep Me Signed in</label>--}}
											@foreach($countries as $k=>$v)
												{{ Form::checkbox('countries[]', $k, (in_array($k,$scountries) ? true : false)) }} {{ $v }}<br/>
											@endforeach
										</div>
									</div>

								</div>
								<div class="col-md-6">
									<label class="form-label">Sector</label>
									<div class="controls">
										{{--{{ Form::select('category', $categories, null, ['placeholder' => 'Category...']) }}--}}
										{{--</div>--}}
										<div class="checkbox-multi check-default">
											{{--<input id="checkbox1" value="1" type="checkbox">--}}
											{{--<label for="checkbox1">Keep Me Signed in</label>--}}
											@foreach($categories as $k=>$v)
												{{ Form::checkbox('categories[]', $k, (in_array($k,$scategories) ? true : false)) }} {{ $v }}<br/>
											@endforeach

										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('description') ? 'error' : '' }}">
										<label class="form-label">Event Description <span class="required">*</span></label>
										<div class="controls">
											<textarea id="htmltextarea1" class="form-control" name="description">{{ $event->description or old('description') }}</textarea>
										</div>
										@if ($errors->has('description'))
											<label class="error" for="description">{{ $errors->first('description') }}</label>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Event Images</label>
										<div class="controls">
											<input type="file" class="form-control" name="images[]" multiple>
										</div>

										@foreach($simages as $k=>$v)
											@if($v != "")
												<div class="image-thumb">
													<img src="{{ URL::to('uploads/images/' . $v) }}" style="max-width: 140px; padding: 10px;"/>
												</div>
											@endif
										@endforeach
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Event Type</label>
										<div class="controls">
											{{ Form::select('etype_id', $etypes, $event->etype_id, []) }}
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Social Networks</label>
										<div class="controls">

											@foreach($social as $k=>$v)
												{{ Form::checkbox('social[]', $k, (in_array($k,$ssocial) ? true : false)) }} {{ $v }}<br/>
											@endforeach
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Video URL</label>
										<div class="controls">
											<input type="text" class="form-control" name="video_url" value="{{ $event->video_url or old('video_url') }}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Tags (comma seperated)</label>
										<div class="controls">
											<input type="text" class="form-control" name="tags" value="{{ $event->tags or old('tags') }}">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">HashTags</label>
										<div class="controls">
											<input type="text" class="form-control" name="hashtags" value="{{ $event->hashtags or old('hashtags') }}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Emojis </label>
										<div class="controls">
											<textarea id="htmltextarea2" class="form-control" name="emoji">{{ $event->emoji or old('emoji') }}</textarea>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Trending</label>
										<div class="controls">
											{{ Form::select('trending', $trending, $event->trending, []) }}
										</div>
									</div>
								</div>


							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Past Campaigns </label>
										<div class="controls">
											<textarea id="htmltextarea3" class="form-control" name="past_campaigns">{{ $event->past_campaigns or old('past_campaigns') }}</textarea>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Tips from TCA </label>
										<div class="controls">
											<textarea id="htmltextarea4" class="form-control" name="tips">{{ $event->tips or old('tips') }}</textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Organizer</label>
										<div class="controls">
											<input type="text" class="form-control" name="organizer" value="{{ $event->organizer or old('organizer') }}">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Organizer URL</label>
										<div class="controls">
											<input type="text" class="form-control" name="organizer_url" value="{{ $event->organizer_url or old('organizer_url') }}">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Organizer Contact (Email)</label>
										<div class="controls">
											<input type="email" class="form-control" name="organizer_email" value="{{ $event->organizer_email or old('organizer_email') }}">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Level (for Packages)</label>
										<div class="controls">
											{{ Form::select('level', $levels, $event->level, []) }}
										</div>
									</div>
								</div>
							</div>

							{{--<div class="row">--}}
							{{--<div class="col-md-6">--}}
							{{--<div class="form-group">--}}
							{{--<label class="form-label">Planning for an activity</label>--}}
							{{--<div class="controls">--}}
							{{--{{ Form::checkbox('planning_activity', 1, ($event->planning_activity==1 ? true : false)) }} Planning for an activity<br/>--}}
							{{--</div>--}}
							{{--</div>--}}
							{{--</div>--}}

							{{--<div class="col-md-6">--}}
							{{--<label class="form-label">Looking for a partner</label>--}}
							{{--<div class="controls">--}}
							{{--{{ Form::checkbox('looking_partner', 1, ($event->looking_partner==1 ? true : false)) }} Looking for a partner<br/>--}}
							{{--</div>--}}
							{{--</div>--}}
							{{--</div>--}}

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Notes</label>
										<div class="controls">
											<textarea id="htmltextarea5" class="form-control" name="notes">{{ $event->notes or old('notes') }}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Status</label>
										<div class="controls">
											{{ Form::select('status', $estatus, $event->status, []) }}
										</div>
									</div>
								</div>


								{{----}}

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
