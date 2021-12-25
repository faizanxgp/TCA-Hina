@extends('layouts.modal')

@section('main-content')
    <div class="event-edit">
        <div class="row">
            <form method="post" action="{{ route('partner-update') }}">
                <input type="hidden" name="event_id" value="{{ $event_id }}">
                <input type="hidden" name="type" value="Partner">
                {{ csrf_field() }}


				<div class="col-md-8 col-md-push-2">
					<label>I am a</label>
					{{ Form::select('iam', $iam, null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required']) }}
					<br />
				</div>
				<div class="col-md-8 col-md-push-2">
					<label>Looking to partner with</label>
					{{ Form::select('subject', $subjects, null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required']) }}
					<br />
				</div>

                <div class="col-md-8 col-md-push-2">
                    <label>For </label>
                    {{ Form::select('forservices', $forservices, null, ['placeholder' => 'Please select...', 'class' => 'form-control', 'required']) }}
                    <br />
                </div>
                <div class="col-md-8 col-md-push-2">
                    <label>Please share briefly your initial thoughts.  Our team will be in touch by email or phone to ask for more details.</label>
                    {{ Form::textarea('comments', null, ['class' => 'form-control', 'rows' => 3, 'required']) }}
                    <br />
                </div>
                <div class="col-md-8 col-md-push-2">
                    <label>Have you already started on this activity?</label>
                    <input type="radio" name="started" value="No" checked /> Inactive
                    <input type="radio" name="started" value="Yes" }} /> Active
                </div>
                <div class="col-md-8 col-md-push-2">
                    <br/>
                    <input type="submit" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>