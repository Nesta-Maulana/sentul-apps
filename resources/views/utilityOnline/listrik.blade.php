@extends('utilityOnline.templates.layout')
@section('title')
    Utility Online | Water
@endsection
@section('content')

    <div id="particles-js"></div>
    <div class="container">
        <div class="row teks mt-5">
            <div class="col teks">
            <h1 class="font-weight-bold d-flex justify-content-center text-white mt-2" style="font-size: 40px"><i class="fa fa-lightbulb-o"></i>&ensp;LISTRIK&ensp;<i class="fa fa-lightbulb-o"></i></h1>
                <div class="row">
                    <div class="col-lg-4 p-3 teks text-white">
                        <label for="workcenter">Workcenter :</label>
                        <select name="workcenter" id="workcenter" class="form-control select2">
                            @foreach($workcenter as $w)
                                <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8 teks text-white">

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection