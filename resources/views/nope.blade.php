@extends('layout')

@section('main')
	<h1>Hi {{ $user->name }},</h1>
	<p>Voor jou is helaas geen rooster gevonden.</p>
	<p>Dat betekent niet dat je vrij bent! Neem even contact op met je SLB.</p>
@endsection