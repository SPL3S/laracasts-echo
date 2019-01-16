@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<task-list :data-project="{{ $project }}"></task-list>
		</div>
	</div>
@endsection