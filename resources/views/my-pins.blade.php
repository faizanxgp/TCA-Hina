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

                        @include('partials.search')
                    </div>


                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

				<h3>My Pins</h3>

                @foreach($events as $event)
                    <div class="grid simple vertical green">
                        <div class="grid-title no-border"></div>
                        <div class="grid-body no-border">
                            @include('partials.event-box')
                            @include('partials.pin-edit')
                        </div>
                    </div>
                @endforeach

                <p><a class="btn btn-warning" href="{{ route('download-ics') }}">Download ICS file</a></p>

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
