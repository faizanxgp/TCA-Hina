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


						<h3>Types</h3>
						<table class="table no-more-tables table-stipped">
							<thead>
							<tr>
								<th style="width:1%">
									<div class="checkbox check-default">
										<input id="checkbox10" value="1" class="checkall" type="checkbox"> <label for="checkbox10"></label>
									</div>
								</th>
								<th style="">Type</th>
								<th style="">Color</th>
								<th style="">Status</th>
								<th style="">Created</th>
								<th style=""></th>
							</tr>
							</thead>
							<tbody>
							@foreach($etypes as $etype)
								<tr>
									<td class="v-align-middle">
										<div class="checkbox check-default">
											<input id="checkbox11" value="1" type="checkbox"> <label for="checkbox11"></label>
										</div>
									</td>
									<td class="v-align-middle">{{ $etype->etype }}</td>
									<td class="v-align-middle"><span class="muted">{{ $etype->color }}</span></td>
									<td class="v-align-middle">{{ $status[$etype->status] or '' }}</td>

									<td><span class="muted">{{ $etype->created_at }}</span></td>
									<td><a class="btn btn-primary btn-sm btn-small" href="{{ route('admin.get-etype', $etype->id) }}">Edit</a> <a class="btn btn-danger btn-sm btn-small" href="">Delete</a></td>



								</tr>
							@endforeach
							<tr>
								<td colspan="4">
									<a href="{{ route('admin.get-etype') }}" class="btn btn-primary btn-cons">Add Type</a>
								</td>
							</tr>
							</tbody>
						</table>
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
