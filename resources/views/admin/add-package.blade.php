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


                        <h3>Package</h3>
                        <form method="post" action="{{ route('admin.post-package') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $package->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Package Title</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('package') ? 'error' : '' }}"
                                                   type="text" name="package"
                                                   value="{{ $package->package or old('package') }}">
                                        </div>
                                        @if ($errors->has('package'))
                                            <label class="error" for="package">{{ $errors->first('package') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Duration from members' start date (in days)</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('duration') ? 'error' : '' }}"
                                                   type="text" name="duration"
                                                   value="{{ $package->duration or old('duration') }}">
                                        </div>
                                        @if ($errors->has('duration'))
                                            <label class="error" for="duration">{{ $errors->first('duration') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pins per month</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('pins') ? 'error' : '' }}"
                                                   type="text" name="pins" value="{{ $package->pins or old('pins') }}">
                                        </div>
                                        @if ($errors->has('pins'))
                                            <label class="error" for="pins">{{ $errors->first('pins') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Downloads per month</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('downloads') ? 'error' : '' }}"
                                                   type="text" name="downloads"
                                                   value="{{ $package->downloads or old('downloads') }}">
                                        </div>
                                        @if ($errors->has('downloads'))
                                            <label class="error"
                                                   for="downloads">{{ $errors->first('downloads') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Events Visibility (in months)</label>
                                        <div class="controls">
                                            <input class="form-control {{ $errors->has('event_visibility') ? 'error' : '' }}"
                                                   type="text" name="event_visibility"
                                                   value="{{ $package->event_visibility or old('event_visibility') }}">
                                        </div>
                                        @if ($errors->has('event_visibility'))
                                            <label class="error"
                                                   for="event_visibility">{{ $errors->first('event_visibility') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Level of Events</label>
                                        <div class="controls">
                                            {{ Form::select('level', $levels, $package->level, []) }}
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Partner offer</label>
                                        <div class="controls">
                                            {{ Form::checkbox('partner', 1, $package->partner) }} (Please check to
                                            allow)
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Option to tell us what they are doing</label>
                                        <div class="controls">
                                            {{ Form::checkbox('activity', 1, $package->activity) }} (Please check to
                                            allow)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Community Notes</label>
                                        <div class="controls">
                                            {{ Form::checkbox('community', 1, $package->community) }} (Please check to
                                            allow)
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">New Event</label>
                                        <div class="controls">
                                            {{ Form::checkbox('new_event', 1, $package->new_event) }} (Please check to
                                            allow)
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Invite Team</label>
                                        <div class="controls">
                                            {{ Form::checkbox('invite_team', 1, $package->invite_team) }} (Please check to
                                            allow)
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label"><strong>Countries</strong></label>
                                </div>

                                @foreach($countries as $k=>$v)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {{ Form::checkbox('countries[]', $k, (in_array($k, $countrypackages) ? true : false)), ['class' => 'form-control'] }} {{ $v }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label"><strong>Sectors</strong></label>
                                </div>

                                @foreach($categories as $k=>$v)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::checkbox('categories[]', $k, (in_array($k, $categorypackages) ? true : false)), ['class' => 'form-control'] }} {{ $v }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label"><strong>Types</strong></label>
                                </div>

                                @foreach($etypes as $k=>$v)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::checkbox('etypes[]', $k, (in_array($k, $etypepackages) ? true : false)), ['class' => 'form-control'] }} {{ $v }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="controls">
                                            <input type="radio" name="status"
                                                   value="0" {{ $package->status == 0 ? 'checked' : '' }} /> Inactive
                                            <input type="radio" name="status"
                                                   value="1" {{ $package->status == 1 ? 'checked' : '' }} /> Active
                                        </div>
                                        @if ($errors->has('status'))
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
