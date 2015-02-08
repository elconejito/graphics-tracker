@extends('app')

@section('content')
	<div class="container">
		<div class="content text-center">
			<h1 class="title">Graphics Tracker</h1>
			<div class="quote">{{ Inspiring::quote() }}</div>
		</div>
	</div>
@endsection
