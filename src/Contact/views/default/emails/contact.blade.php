@extends('layouts.email')

@section('content')

<h1>{{ Lang::get('contactform::contactform.email.header') }}</h1>

<p>{{ $comment }}</p>

@stop


