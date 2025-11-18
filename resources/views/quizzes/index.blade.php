@extends('layouts.app')

@section('content')

<div class="card card-flush p-10">

    <div class="d-flex justify-content-between align-items-center mb-8">
        <h2 class="fw-bold">Quizzes</h2>

        <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
            Add Quiz
        </a>
    </div>

    <table class="table table-row-dashed align-middle gy-5">
        <thead>
            <tr class="text-start fw-bold text-gray-600 text-uppercase fs-7">
                <th>ID</th>
                <th>Topic</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Total Marks</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody class="fw-semibold text-gray-700">
            @foreach ($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->id }}</td>
                <td>{{ $quiz->topic->topic }}</td>
                <td>{{ $quiz->name }}</td>
                <td>{{ $quiz->duration_minutes }} mins</td>
                <td>{{ $quiz->total_marks }}</td>

                <td class="text-end">
                    <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-light btn-sm me-2">
                        Edit
                    </a>

                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
