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

							<a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>

						</div>
					</div>
					<div class="grid-body no-border">
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif


						@include('partials.search')
					</div>


					<!-- /.box-body -->
				</div>
				<!-- /.box -->


				@foreach($events as $event)
					<?php
						if (isset($event->etype->color) and $event->etype->color != null ) {
							$color = $event->etype->color;
						} else {
							$color = "#808080";
						}
					?>

					<div class="grid simple vertical default grey" style="border-left-color: {{ $color }} !important">
						<div class="grid-title no-border"></div>
						<div class="grid-body no-border">

							@include('partials.event-box')
						</div>
					</div>
				@endforeach

				{{ $events->links() }}

			</div>
		</div>
	</div>

@endsection
