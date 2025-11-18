@extends('layouts.app')

@section('content')
<div class="card p-5">
    <h3 class="mb-4">Create New Quiz</h3>

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Select Topic</label>
            <select name="topic_id" class="form-control">
                <option value="">Select</option>
                @foreach ($topics as $t)
<option value="{{ $t->id }}">{{ $t->topic }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Quiz Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Duration (minutes)</label>
            <input type="number" name="duration_minutes" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Total Marks</label>
            <input type="number" name="total_marks" class="form-control">
        </div>

        <button class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection
