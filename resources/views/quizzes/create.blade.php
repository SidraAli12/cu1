@extends('layouts.app')

@section('content')
<div class="card card-flush p-10">
    <div class="card-header">
        <h3 class="card-title">Create New Quiz</h3>
    </div>

    <div class="card-body py-5">

        <form action="{{ route('quizzes.store') }}" method="POST" class="w-75 mx-auto">
            @csrf

            <div class="mb-8">
                <label class="form-label fw-bold">Select Topic</label>
                <select name="topic_id" class="form-control form-control-solid">
                    <option value="">Select</option>
                    @foreach ($topics as $t)
                        <option value="{{ $t->id }}">{{ $t->topic }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-8">
                <label class="form-label fw-bold">Quiz Name</label>
                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter quiz name">
            </div>

            <div class="mb-8">
                <label class="form-label fw-bold">Duration (minutes)</label>
                <input type="number" name="duration_minutes" class="form-control form-control-solid" placeholder="e.g. 30">
            </div>

            <div class="mb-8">
                <label class="form-label fw-bold">Total Marks</label>
                <input type="number" name="total_marks" class="form-control form-control-solid" placeholder="e.g. 20">
            </div>

            <button class="btn btn-primary mt-5">Create Quiz</button>

        </form>

    </div>
</div>
@endsection
