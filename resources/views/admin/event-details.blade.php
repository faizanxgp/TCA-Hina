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
			<div class="col-md-12" style="background-color: #fff;">

				<div class="row">
					<div class="col-md-2" style="padding-top: 10px;" >
						@if($event->organizer)
						<div class="organizer"><strong>Organizer:</strong><br /> {{ $event->organizer }}</div>
						@endif
						@if($event->organizer_url)
						<div class="organizer"><strong>Organizer URL:</strong><br /> <a href="{{ $event->organizer_url }}">Visit website</a></div>
						@endif
						@if($event->organizer_email)
							<div class="organizer"><strong>Organizer Email:</strong><br /> {{ $event->organizer_email }}</div>
						@endif

						@if($event->video_url)


							<div class="video_url"><strong>Video:</strong><br /> <a href="{{ $event->video_url }}"><img src="{{ URL::to('images/video-icon.png') }}" style="max-width: 100px;" /></a></div>
						@endif

					</div>
					<div class="col-md-8" style="background-color: #f0f0f0">

						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif


						<h2 class="title">{{ $event->title }}
							<div class="rating">
								@for ($i = 0; $i < $event->trending; $i++)
									<i class="fa fa-star"></i>
								@endfor
							</div></h2>
						<div class="date">
							<strong>From</strong> {{ $event->from_date }} <strong>to</strong> {{ $event->upto_date }}
						</div>

						<div class="img"><img /></div>

						<p class="description"><br /><strong>About</strong><br />{!! $event->description !!} </p>
						@if($event->past_campaign)
						<div class="past-campaigns"><strong>Past Campaign:</strong><br /> {!! $event->past_campaign !!}</div>
						@endif
						@if($event->tips)
						<div class="tips"><strong>Tips from TCA:</strong><br /> {!! $event->tips !!}</div>
						@endif





						<a href="{{ route('event-partner', $event->id) }}" id="btn1" class="btn btn-primary ls-modal">Explore partnership opportunities</a>
						<a href="{{ route('event-activity', $event->id) }}" id="btn2" class="btn btn-primary ls-modal">Tell us what you are doing for this date</a>
					</div>
					<div class="col-md-2" style="padding-top: 10px;" >
						@if($event->tags)
						<div class="tags"><strong>Tags:</strong><br /> {{ $event->tags }}</div>
						@endif
						@if($event->hashtags)
						<div class="hash-tags"><strong>Hash Tags:</strong><br /> {{ $event->hashtags }}</div>
						@endif
						@if($event->emoji)
						<div class="emoji"><strong>Emoji:</strong><br /> {!! $event->emoji !!}</div>
						@endif
						<div class="icon-block"><a href="{{ route('event-bug', $event->id) }}" title="Report an error" class="ls-modal"><i class="fa fa-bug red-icon"></i> Report a bug</a></div>
					</div>
				</div>
			</div>

		</div>
	</div>

@endsection
