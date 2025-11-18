@extends('layouts.app')
@section('content')
<div class="card p-5">
    <h3>{{ $quiz->name }}</h3>
    <p>Time: {{ $quiz->duration_minutes }} minutes</p>

    <form action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
        @csrf
        @foreach($quiz->questions as $q)
            <div class="mb-4">
                <label class="form-label">Q{{ $loop->iteration }}. {!! $q->question !!}</label>
                @if($q->question_type == 'mcq')
                    @php
                        $options = json_decode($q->path, true) ?? [];
                    @endphp
                    @foreach($options as $optKey => $optLabel)
                        <div>
                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $optKey }}" />
                            <span>{{ $optLabel }}</span>
                        </div>
                    @endforeach
                @else
                    <textarea name="answers[{{ $q->id }}]" class="form-control"></textarea>
                @endif
            </div>
        @endforeach

        <button class="btn btn-primary">Submit Quiz</button>
    </form>
</div>
@endsection
