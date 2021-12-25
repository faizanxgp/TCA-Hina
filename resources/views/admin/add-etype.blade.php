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
                            <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal"
                                                                            class="config"></a> <a href="javascript:;"
                                                                                                   class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                    </div>
                    <div class="grid-body no-border">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif


                        <h3>Type</h3>
                        <form method="post" action="{{ route('admin.post-etype') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $etype->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('etype') ? 'error' : '' }}"
                                                   type="text" name="etype" value="{{ $etype->etype or old('etype') }}">
                                        </div>
                                        @if ($errors->has('etype'))
                                            <label class="error" for="etype">{{ $errors->first('etype') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Color (hex code)</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('color') ? 'error' : '' }}"
                                                   type="text" name="color" value="{{ $etype->color or old('color') }}">
                                        </div>
                                        @if ($errors->has('color'))
                                            <label class="error" for="color">{{ $errors->first('color') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="controls">
                                            <input type="radio" name="status" value="0" {{ $etype->status == 0 ? 'checked' : '' }} /> Inactive
                                            <input type="radio" name="status" value="1" {{ $etype->status == 1 ? 'checked' : '' }} /> Active
                                        </div>
                                        @if ($errors->has('duration'))
                                            <label class="error" for="status">{{ $errors->first('status') }}</label>
                                        @endif
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
