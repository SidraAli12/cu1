@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h3>Questions for: {{ $quiz->name }}</h3>
    <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-primary">Add Question</a>
  </div>
  <div class="card-body">
    <table class="table">
      <thead><tr><th>ID</th><th>Question</th><th>Marks</th><th>Type</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($quiz->questions as $q)
          <tr>
            <td>{{ $q->id }}</td>
            <td>{{ Str::limit($q->question,80) }}</td>
            <td>{{ $q->marks }}</td>
            <td>{{ $q->question_type }}</td>
            <td>
              <a href="{{ route('questions.edit', [$quiz->id, $q->id]) }}" class="btn btn-sm btn-light">Edit</a>
              <form action="{{ route('questions.destroy', [$quiz->id, $q->id]) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
