@extends('layout')

@section('main')
	<h1>Hi {{ $user->name }},</h1>
	<p>Jouw rooster voor {{ $date_string }} is:</p>
	<div class="schedule">
		@foreach($schedule as $row)
			<div>
				<span>{{ $row['time'] }}</span>
				<span>{{ $row['title'] }}, {{ $row['room'] }}</span>
			</div>
		@endforeach
	</div>
@endsection