@extends('layouts.app')

@section('content')
<div class="container py-10">
    <div class="card p-6 rounded-2xl shadow">
        <h2 class="text-xl font-bold mb-4">Course Management</h2>

        {{-- Add Course Form --}}
        <form id="addCourseForm" class="mb-6">
            @csrf
            <div class="grid grid-cols-3 gap-4">
                <input type="text" name="title" class="form-control border p-2 rounded" placeholder="Course Title" required>
                <input type="text" name="description" class="form-control border p-2 rounded" placeholder="Description" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Course</button>
            </div>
        </form>

        {{-- Course List --}}
        <table class="min-w-full text-left border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">#</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody id="courseTable">
                @foreach($courses as $course)
                    <tr data-id="{{ $course->id }}">
                        <td class="p-3">{{ $course->id }}</td>
                        <td class="p-3 editable" contenteditable="true" data-field="title">{{ $course->title }}</td>
                        <td class="p-3 editable" contenteditable="true" data-field="description">{{ $course->description }}</td>
                        <td class="p-3">
                            <button class="deleteCourse bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelector('#addCourseForm').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch("{{ route('courses.store') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            location.reload();
        }
    });
});

document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('blur', function(){
        let id = this.closest('tr').dataset.id;
        let field = this.dataset.field;
        let value = this.innerText;

        fetch(`/courses/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ [field]: value })
        });
    });
});

document.querySelectorAll('.deleteCourse').forEach(btn => {
    btn.addEventListener('click', function(){
        let id = this.closest('tr').dataset.id;
        fetch(`/courses/${id}`, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                this.closest('tr').remove();
            }
        });
    });
});
</script>
@endsection
