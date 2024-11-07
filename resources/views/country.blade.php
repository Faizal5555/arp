@extends('layouts.master')
@section('page_title', 'Vendor List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-6">
                        <label for="password" class="form-label">Select Country:</label>
                        <select class="form-select col-lg-6">
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}} - {{$country->code}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection