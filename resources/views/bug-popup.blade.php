@extends('layouts.modal')

@section('main-content')
    <div class="event-edit">
        <div class="row">
            <form method="post" action="{{ route('bug-update') }}">
                <input type="hidden" name="event_id" value="{{ $event_id }}">

                {{ csrf_field() }}

                <div class="col-md-8 col-md-push-2">
                    <label>Tell us about it. Please include account handles where appropriate. </label>
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