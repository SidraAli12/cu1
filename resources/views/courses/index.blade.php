@extends('layouts.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">

        <main class="app-content flex-column-fluid" id="kt_app_content">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!-- Course Card -->
                <div class="card card-flush shadow-sm">
                    <div class="card-header py-5 d-flex justify-content-between align-items-center">
                        <h3 class="card-title fw-bold">Course Management</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                            Add New Course
                        </button>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table table-row-dashed table-striped align-middle fs-6 gy-5" id="coursesTable">
                            <thead>
                                <tr class="text-gray-500 fw-bold text-uppercase gs-0">
                                    <th>ID</th>
                                    <th>Subject ID</th>
                                    <th>Track ID</th>
                                    <th>Course Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr data-id="{{ $course->id }}">
                                        <td>{{ $course->id }}</td>
                                        <td contenteditable="true" class="editable" data-field="subject_id">{{ $course->subject_id }}</td>
                                        <td contenteditable="true" class="editable" data-field="track_id">{{ $course->track_id }}</td>
                                        <td contenteditable="true" class="editable" data-field="course">{{ $course->course }}</td>
                                        <td>{{ $course->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger deleteCourse" data-id="{{ $course->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Card -->

            </div>
        </main>

    </div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="addCourseForm" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject ID</label>
                    <input type="number" name="subject_id" class="form-control form-control-solid" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Track ID</label>
                    <input type="number" name="track_id" class="form-control form-control-solid" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Course Name</label>
                    <input type="text" name="course" class="form-control form-control-solid" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary fw-bold">Add Course</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    document.querySelector('#addCourseForm').addEventListener('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);

        fetch("{{ route('courses.store') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                bootstrap.Modal.getInstance(document.getElementById('addCourseModal')).hide();
                location.reload();
            } else alert('Error adding course');
        });
    });

    document.querySelectorAll('.deleteCourse').forEach(btn => {
        btn.addEventListener('click', function(){
            let id = this.dataset.id;
            if(!confirm('Are you sure you want to delete this course?')) return;

            fetch(`/courses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') this.closest('tr').remove();
                else alert('Error deleting course');
            });
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
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ [field]: value })
            }).then(res => res.json()).then(data => {
                if(data.status !== 'success') alert('Error updating course');
            });
        });
    });

});
</script>
@endsection
