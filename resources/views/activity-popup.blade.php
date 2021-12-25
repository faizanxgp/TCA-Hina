@extends('layouts.modal')

@section('main-content')
    <div class="event-edit">
        <div class="row">
            <form method="post" action="{{ route('activity-update') }}">
                <input type="hidden" name="event_id" value="{{ $event_id }}">
                <input type="hidden" name="type" value="Activity">
                <input type="hidden" name="subject" value="">
                <input type="hidden" name="started" value="">
                {{ csrf_field() }}

                <div class="col-md-8 col-md-push-2">
                    <label>Doing something for this date?  Let us know, so we can keep an eye out for it.  Please include account handles where appropriate. </label>
                    {{ Form::textarea('comments', null, ['class' => 'form-control', 'rows' => 3, 'required']) }}
                    <br />
                </div>

                <div class="col-md-8 col-md-push-2">
                    <br/>
                    <input type="submit" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>