@if($event->mypin->first())
	<div class="event-edit">
		<div class="row">
			<form method="post" action="{{ route('pin-update') }}">
				{{--<div class="col-md-6">--}}
				{{--{{ Form::checkbox('planning_activity', 1, false) }} Planning activity--}}
				{{--</div>--}}
				{{--<div class="col-md-6">--}}
				{{--{{ Form::checkbox('looking_partner', 1, false) }} Looking for partner--}}
				{{--</div>--}}

				<div class="col-md-6">
					{{ csrf_field() }}
					<input type="hidden" name="pin_id" value="{{ $event->id }}"> <br/> <label>My Comments: (private) <span class="required">*</span> </label>
					{{ Form::textarea('comments', $event->mypin->first()->comments, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter notes']) }}
				</div>
				<div class="col-md-6">
					<br/> <label>For Community: (other users can see it) <span class="required">*</span></label>
					{{ Form::textarea('community', $event->mypin->first()->community, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter notes']) }}
				</div>
				<div class="col-md-6">
					<label>Share with Teams</label>
					{{ Form::select('team_id', $teams, null, ['placeholder' => '']) }}
				</div>
				<div class="col-md-6">
					<br/> <input type="submit" class="btn btn-primary" value="Update"/>
				</div>
			</form>
		</div>
	</div>
@endif