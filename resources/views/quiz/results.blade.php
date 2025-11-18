@extends('layouts.app')
@section('content')
<div class="card p-5">
    <h3>Results for: {{ $attempt->quiz->name }}</h3>
    <p>Score: {{ $attempt->total_score }} / {{ $attempt->quiz->total_marks }}</p>
    <p>Started: {{ $attempt->started_at }} | Finished: {{ $attempt->finished_at }}</p>
</div>
@endsection
