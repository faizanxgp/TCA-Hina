<div class="event-notes">
	<div class="row">
			{{--Only community notes by members in my team--}}
			<h4><strong>Community Notes: </strong></h4>
			@foreach($event->pin as $pin)
				@if(array_key_exists($pin->user_id, $members))
					<div class="col-md-4">
						<strong>{{ $pin->community }}</strong>
					</div>
				@endif
			@endforeach
	</div>
</div>