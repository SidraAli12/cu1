@extends('layouts.app')

@section('content')

<div class="card card-flush">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <h3 class="card-title fw-bold">Quizzes</h3>

        <div class="card-toolbar">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
                Add Quiz
            </a>
        </div>
    </div>

    <div class="card-body pt-0">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Total Marks</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody class="fw-semibold text-gray-600">
                @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->topic->topic }}</td>
                    <td>{{ $quiz->name }}</td>
                    <td>{{ $quiz->duration_minutes }} mins</td>
                    <td>{{ $quiz->total_marks }}</td>

                    <td class="text-end">
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" 
                           class="btn btn-light btn-sm">
                           Edit
                        </a>

                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" 
                              method="POST" 
                              style="display: inline">
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
</div>

@endsection
