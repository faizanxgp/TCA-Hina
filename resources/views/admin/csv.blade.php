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
							<a href="javascript:;" class="collapse"></a>
							<a href="#grid-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>
					</div>
					<div class="grid-body no-border">
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif




						<h3>CSV</h3>
						<form method="post" action="{{ route('admin.csv2') }}" enctype="multipart/form-data">
							{{ csrf_field() }}

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">File</label>
										<div class="controls">
											<input class="form-control" type="file" name="file" value="">
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
