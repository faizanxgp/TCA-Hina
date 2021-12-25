@extends('layouts.admin-modal')

@section('page_title')
	Admin Panel
@endsection

@section('page_heading')
	Admin Dashboard
@endsection


@section('main-content')
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

						<h3>Member</h3>

						<div class="row">
							<div class="col-md-6">

								<label class="form-label">Name</label>
								<div class="controls">
									{{ $user->name }}
								</div>

							</div>

							<div class="col-md-6">

								<label class="form-label">Email</label>
								<div class="controls">
									{{ $user->email }}
								</div>

							</div>
						</div>

						<h3>Package</h3>

						<div class="row">
							<div class="col-md-6">

									<label class="form-label">{{ $user->memberInfo() }}</label>


							</div>


						</div>


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
