<div class="event-box">
	<div class="row">
		<div class="col-md-3">
			<div class="date1"><span class="day">{{ Carbon\Carbon::parse($event->from_date)->format('D') }}</span><br/><span class="date">{{ Carbon\Carbon::parse($event->from_date)->format('d') }}</span><span class="month">{{ Carbon\Carbon::parse
			($event->from_date)
			->format('M')
			}}</span></div>
			<div class="date2">@if($event->from_date != $event->upto_date)- <span class="day">{{ Carbon\Carbon::parse($event->upto_date)->format('D') }}</span><br/><span class="date">{{ Carbon\Carbon::parse($event->upto_date)->format('d')
			}}</span><br/><span class="month">{{ Carbon\Carbon::parse($event->upto_date)->format('M')
			}}</span>@endif @if($event->tbc==1)<div>TBC</div>@endif</div>

		</div>
		<div class="col-md-8">
			<h2 class="title"><a href="{{ route('event-details', $event->id) }}" class="ls-modalx">{{ $event->title }}</a></h2>
			<div class="rating">
				@for ($i = 0; $i < $event->trending; $i++)
					<i class="fa fa-star"></i>
				@endfor
			</div>
			<div class="description"><?php $a = explode('<br>',$event->description); echo $a[0]; ?>
				{{--{!! str_limit(strip_tags($event->description), 250, '...') !!}--}}
			</div>

			<div class="locations">
				{{ $event->mycountries() }}
			</div>

			<div class="shared">
				Shared with Team(s): <strong>{{ $event->shared() }}</strong>
			</div>

		</div>
		<div class="col-md-1">
			<div class="icon-block">
				<?php $mypin = $event->mypin; ?>
				@if( count($mypin) > 0 )
					<a href="{{ route('event-remove', $event->id) }}" title="Remove Pin"><i class="fa fa-trash red-icon"></i></a>
				@else
					<a href="{{ route('event-select', $event->id) }}" title="Save Pin"><i class="fa fa-thumb-tack"></i></a>
				@endif
			</div>
			<div class="icon-block"><a href="{{ route('event-download', $event->id) }}" target="_blank" title="Export date as an ICS file for my calendar"><i class="fa fa-download"></i></a></div>
			<div class="icon-block"><a href="{{ route('event-email', $event->id) }}" title="Send an email"><i class="fa fa-envelope-o"></i></a></div>
			{{--<div class="icon-block"><a href="{{ route('event-bug', $event->id) }}" title="Report an error"><i class="fa fa-bug red-icon"></i></a></div>--}}
			{{--<div class="icon-block"><a href="{{ route('event-bug', $event->id) }}" title="Wanna partner"><i class="fa fa-handshake-o"></i></a></div>--}}
		</div>
	</div>
</div>