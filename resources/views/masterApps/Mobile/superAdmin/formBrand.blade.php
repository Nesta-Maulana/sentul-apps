@extends('masterApps.mobile.superAdmin.templates.layout')
@section('title')
    Form Brand
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-brand')
    active
@endsection
@section('content')
@if ($message = Session::get('failed'))
    <div class="failed" data-flashdata="{{ $message }}"></div>
@endif
<script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
@endsection