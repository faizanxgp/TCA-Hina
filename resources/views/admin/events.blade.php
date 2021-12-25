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


                        <div class="search-box">
                            <form method="get" action="{{ route('admin.events') }}">
                                <div class="row search">
                                    <div class="col-md-4"><input type="text" class="form-control" name="search"
                                                                 placeholder="Search keyword"/></div>
                                    <div class="col-md-2"><input type="text" class="form-control datepicker" name="from"
                                                                 placeholder="From date"/></div>
                                    <div class="col-md-2"><input type="text" class="form-control datepicker" name="upto"
                                                                 placeholder="To date"/></div>
                                    <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Submit"/>
                                        <input type="button" class="btn btn-danger" value="Reset"/></div>
                                </div>
                                <div class="row search">
                                    <div class="col-md-4">
                                        {{ Form::select('country', $countries, null, ['placeholder' => 'Country...', 'class' => 'form-control']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('category', $categories, null, ['placeholder' => 'Sector...', 'class' => 'form-control']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('type', $etypes, null, ['placeholder' => 'Type...', 'class' => 'form-control']) }}
                                    </div>
                                </div>
                            </form>

                        </div>

                        <h3>Events</h3>

                            <div>
                                <a href="{{ route('admin.get-event', 0) }}" class="btn btn-primary btn-cons"><i class="fa fa-plus"></i>  Add Event</a>

                            </div>
                        <table id="myTable" class=display table no-more-tables table-stipped">
                            <thead>
                            <tr>
                                <th style="width:1%">
                                    <div class="checkbox check-default">
                                        <input id="checkbox10" value="1" class="checkall" type="checkbox"> <label
                                                for="checkbox10"></label>
                                    </div>
                                </th>
                                <th style="width:9%">Name</th>
                                {{--<th style="width:22%">Description</th>--}}
                                <th style="">From</th>
                                <th style="">Upto</th>
                                <th style="">TBC</th>
                                <th style="">Type</th>

                                <th style="">Status</th>
                                <th style="">TCA Notes</th>
                                <th style="">Last updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class="@if($event->status==0) light-red @elseif($event->status==1) light-green @else light-orange @endif">
                                    <td class="v-align-middle">
                                        <div class="checkbox check-default">
                                            <input id="checkbox11" value="1" type="checkbox"> <label
                                                    for="checkbox11"></label>
                                        </div>
                                    </td>
                                    <td class="v-align-middle">{{ $event->title }}</td>
                                    {{--<td class="v-align-middle"><span class="muted">{!! str_limit($event->description, 250, '...') !!}</span></td>--}}
                                    <td>
                                        <span class="muted">{{ Carbon\Carbon::parse($event->from_date)->format('D d-m-Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="muted">{{ Carbon\Carbon::parse($event->upto_date)->format('D d-m-Y') }}</span>
                                    </td>
									<td>
										<span class="muted">@if($event->tbc==1) Yes @endif</span>
									</td>
                                    <td><span class="muted">{{ $event->etype->etype or '' }}</span></td>
                                    <td><label class="label label-primary">{{ $estatus[$event->status] or '' }}</label></td>
                                    <td class="v-align-middle"><span class="muted">{!! $event->notes !!}</span></td>
                                    <td><span class="muted">{{ $event->updated_at }}</span></td>
                                    <td><a class="btn btn-sm btn-small  btn-primary" href="{{ route('admin.get-event', $event->id) }}"><i class="fa fa-pencil"></i> </a> | <a class="btn btn-sm btn-small btn-danger" href=""><i class="fa fa-trash"></i> </a>
                                        | <a class="btn btn-sm btn-small btn-info" href="{{ route('admin.get-event-copy', $event->id) }}"><i class="fa fa-copy"></i> </a></td>
                                </tr>
                            @endforeach

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
