@extends('layouts.admin')

@section('page_title')
	Admin Panel
@endsection

@section('page_heading')
	Admin Dashboard
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="grid simple">
					<div class="grid-title no-border">ADMIN Dashboard</div>

					<div class="grid-body no-border">
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif


						<h3>Partner Request</h3>
						<table class="table no-more-tables table-stipped">
							<thead>
							<tr>
								<th style="width:1%">
									<div class="checkbox check-default">
										<input id="checkbox10" value="1" class="checkall" type="checkbox"> <label for="checkbox10"></label>
									</div>
								</th>
								<th style="">Event</th>

								<th style="">User</th>
								<th style="">Interest</th>
								<th style="">Comments</th>
								<th style="">Started?</th>
								<th style="">Status</th>
								<th style="">Created</th>
								<th style=""></th>
							</tr>
							</thead>
							<tbody>
							@foreach($partners as $partner)
								<tr>
									<td class="v-align-middle">
										<div class="checkbox check-default">
											<input id="checkbox11" value="1" type="checkbox"> <label for="checkbox11"></label>
										</div>
									</td>
									<td class="v-align-middle"><a href="{{ route('admin.event-details', $partner->event_id) }}" target="_blank">{{ $partner->event->title or ''}}</a></td>
									<td class="v-align-middle">
										<a class="ls-modal" href="{{ route('admin.view-user', $partner->user_id) }}"> <span class="muted">{{ $partner->user->name or ''}} {{ $partner->user->email or '' }}</span> </a>
									</td>
									<td>{{ $partner->subject }}</td>
									<td>{{ $partner->comments }}</td>
									<td>{{ $partner->started }}</td>
									<td>
										<?php $status = (isset($pstatus[$partner->status]) ? $pstatus[$partner->status] : 'NA'); ?>

										@if( $status == 'Contacted')
											<label class="label label-success"> {{ $status }} </label>
										@else
											<label class="label label-danger"> {{ $status }} </label>
										@endif

									</td>
									<td><span class="muted">{{ $partner->created_at }}</span></td>
									<td><a class="btn btn-primary" href="{{ route('admin.partner-status', $partner->id) }}">Update</a></td>
								</tr>
							@endforeach
							<tr>
								<td colspan="4">
									{{ $partners->links() }}

								</td>
							</tr>
							</tbody>
						</table>


						<h3>Activity Request</h3>
						<table class="table no-more-tables table-stipped">
							<thead>
							<tr>
								<th style="width:1%">
									<div class="checkbox check-default">
										<input id="checkbox10" value="1" class="checkall" type="checkbox"> <label for="checkbox10"></label>
									</div>
								</th>
								<th style="">Event</th>

								<th style="">User</th>
								<th style="">Comments</th>
								<th style="">Status</th>
								<th style="">Created</th>
								<th style=""></th>
							</tr>
							</thead>
							<tbody>
							@foreach($activities as $partner)
								<tr>
									<td class="v-align-middle">
										<div class="checkbox check-default">
											<input id="checkbox11" value="1" type="checkbox"> <label for="checkbox11"></label>
										</div>
									</td>
									<td class="v-align-middle">
										<a href="{{ route('admin.event-details', $partner->event_id) }}" target="_blank">{{ $partner->event->title or ''}}</a>
									</td>
									<td class="v-align-middle">
										<a class="ls-modal" href="{{ route('admin.view-user', $partner->user_id) }}"> <span class="muted">{{ $partner->user->name or ''}} {{ $partner->user->email or '' }}</span> </a>
									</td>
									<td>{{ $partner->comments }}</td>
									<td>

										<?php $status = (isset($pstatus[$partner->status]) ? $pstatus[$partner->status] : 'NA'); ?>

										@if( $status == 'Contacted')
											<label class="label label-success"> {{ $status }} </label>
										@else
											<label class="label label-danger"> {{ $status }} </label>
										@endif


									</td>
									<td><span class="muted">{{ $partner->created_at }}</span></td>
									<td><a class="btn btn-primary" href="{{ route('admin.partner-status', $partner->id) }}">Updated</a></td>
								</tr>
							@endforeach
							<tr>
								<td colspan="4">
									{{ $partners->links() }}

								</td>
							</tr>
							</tbody>
						</table>

						<h3>Issues</h3>
						<table class="table no-more-tables table-stipped">
							<thead>
							<tr>
								<th style="width:1%">
									<div class="checkbox check-default">
										<input id="checkbox10" value="1" class="checkall" type="checkbox"> <label for="checkbox10"></label>
									</div>
								</th>
								<th style="">Event</th>

								<th style="">User</th>
								<th style="">Email</th>
								<th style="">Comments</th>
								<th style="">Status</th>
								<th style="">Created</th>
								<th style=""></th>
							</tr>
							</thead>
							<tbody>
							@foreach($complains as $complain)
								<tr>
									<td class="v-align-middle">
										<div class="checkbox check-default">
											<input id="checkbox11" value="1" type="checkbox"> <label for="checkbox11"></label>
										</div>
									</td>
									<td class="v-align-middle"><a href="{{ route('admin.event-details', $complain->event_id) }}" target="_blank">{{ $complain->event->title or ''}}</a></td>

									<td class="v-align-middle">
										<a class="ls-modal" href="{{ route('admin.view-user', $complain->user_id) }}"> <span class="muted">{{ $complain->user->name or ''}}</span> </a>
									</td>
									<td class="v-align-middle"><span class="muted">{{ $complain->user->email or ''}}</span></td>
									<td class="v-align-middle">{{ $complain->comments or ''}}</td>
									<td>

										<?php $status = (isset($status[$complain->status]) ? $status[$complain->status] : 'NA'); ?>

										@if( $status == '1')
											<label class="label label-success"> Resolved </label>
										@else
											<label class="label label-danger"> Not-Resolved </label>
										@endif
									</td>
									<td><span class="muted">{{ $complain->created_at }}</span></td>
									<td><a class="btn btn-primary" href="{{ route('admin.complain-status', $complain->id) }}">Updated</a></td>
								</tr>
							@endforeach
							<tr>
								<td colspan="4">
									{{ $complains->links() }}

								</td>
							</tr>
							</tbody>
						</table>
					</div>


				</div>
			</div>
		</div>
	</div>

@endsection
