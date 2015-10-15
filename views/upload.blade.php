@extends('themes::layouts.default')

@section('content')
    <form enctype="multipart/form-data" method="post" action="{{route('theme-upload')}}">
    <input type="file" name="theme">

    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="submit" value="Upload">
</form>
@endsection