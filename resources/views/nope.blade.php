@extends('layout')

@section('main')
	<h1>Hi {{ $user->name }},</h1>
	<p>Voor jou is helaas geen rooster gevonden.</p>
@endsection