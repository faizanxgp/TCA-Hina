<div class="search-box">
    <form method="get" action="{{ route('search') }}">
        <div class="row search">
            <div class="col-md-6">
                <input type="text" class="form-control" name="search"
                                         placeholder="I am searching for ... (event title, description, tags)" value="{{ $search or '' }}"/>
            </div>
            <div class="col-md-3"><input type="text" class="form-control datepicker" id="fromdate" name="from_date"
                                         placeholder="From date" value="{{ $from or ''}}" /></div>
            <div class="col-md-3"><input type="text" class="form-control datepicker" id="uptodate" name="upto_date"
                                         placeholder="To date" value="{{ $upto or '' }}"/></div>
        </div>
        <div class="row search">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <input type="button" class="btn btn-primary btn-day7" value="7 Days"/>
                <input type="button" class="btn btn-primary btn-day30" value="This month"/>
                <input type="button" class="btn btn-primary btn-day90" value="Next 3 months"/>
            </div>

        </div>
        <div class="row search">
            <div class="col-md-6">
                {{--{{ Form::select('country', $countries, null, ['placeholder' => 'Country...']) }}--}}

                <?php $scountries = array(); ?>
                <label>Countries: <input type="checkbox" id="c1" > Select All</label>
                {{ Form::select('countries[]', $countries, null, array('multiple' => true, 'id' => 'a1', 'class' => 'js-example-basic-multiple', 'style' => 'width: 100%' ) ) }}

                {{--@foreach($countries as $k=>$v)--}}
                {{--<div class="col-md-6">--}}
                {{--<select class="js-example-basic-multiple" name="states[]" multiple="multiple" ></select>--}}
                {{--{{ Form::checkbox('countries[]', $k, (in_array($k, $scountries) ? true : false)) }} {{ $v }}--}}
                {{--</div>--}}
                {{--@endforeach--}}
            </div>

            <div class="col-md-6">

                <?php $scategories = array(); ?>
                <label>Sector:  <input type="checkbox" id="c2" > Select All</label>
                {{ Form::select('categories[]', $categories, null, array('multiple' => true, 'id' => 'a2', 'class' => 'js-example-basic-multiple', 'style' => 'width: 100%' ) ) }}


                {{--@foreach($categories as $k=>$v)--}}
                {{--<div class="col-md-6">--}}
                {{--{{ Form::checkbox('categories[]', $k, (in_array($k, $scategories) ? true : false)) }} {{ $v }}--}}
                {{--</div>--}}
                {{--@endforeach--}}

            </div>
        </div>
        <div class="row search">
            <div class="col-md-6">
                <?php $stypes = array(); ?>
                <label>Type: <input type="checkbox" id="c3" > Select All</label>
                {{ Form::select('etypes[]', $etypes, null, array('multiple' => true, 'id' => 'a3', 'class' => 'js-example-basic-multiple', 'style' => 'width: 100%' ) ) }}



                {{--@foreach($etypes as $k=>$v)--}}
                {{--<div class="col-md-6">--}}
                {{--{{ Form::checkbox('etypes[]', $k, (in_array($k, $stypes) ? true : false)) }} {{ $v }}--}}
                {{--</div>--}}
                {{--@endforeach--}}
                {{--</div>--}}
            </div>


            <div class="col-md-6">
                <input type="submit" class="btn btn-primary" value="Submit"/> <input type="button"
                                                                                     class="btn btn-danger"
                                                                                     value="Reset"/>
            </div>
        </div>

    </form>
</div>