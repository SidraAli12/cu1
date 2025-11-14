@extends('layouts.noauth')
@section('title', 'Courses')

@section('form')
<div class="container py-5">
    <!-- Toggle Button -->
    <div class="d-flex justify-content-end mb-4">
        <button id="toggleViewBtn" class="btn btn-outline-primary shadow-sm">
            📖 View All Courses
        </button>
    </div>

    <!-- Add Course Form -->
    <div id="addCourseForm" class="card shadow border-0 mb-4">
        <div class="card-header bg-info text-white rounded-top">
            <h4 class="mb-0 fw-bold">➕ Create a New Course</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Subject ID</label>
                        <input type="text" name="subject_id" class="form-control" placeholder="Enter subject ID" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Track ID</label>
                        <input type="text" name="track_id" class="form-control" placeholder="Enter track ID" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Course Name</label>
                        <input type="text" name="course" class="form-control" placeholder="Enter course name" required>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label fw-semibold">Summary</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Short course description"></textarea>
                </div>
                <button type="submit" class="btn btn-info mt-3 px-4 shadow-sm">
                    💾 Save Course
                </button>
            </form>
        </div>
    </div>

    <!-- Courses Table -->
    <div id="coursesTable" class="card shadow border-0">
        <div class="card-header bg-success text-white rounded-top">
            <h4 class="mb-0 fw-bold">📚 Courses Overview</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-uppercase text-muted fw-semibold">
                            <th class="ps-4">ID</th>
                            <th>Subject ID</th>
                            <th>Track ID</th>
                            <th>Course Name</th>
                            <th>Summary</th>
                            <th class="text-end pe-4">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $course->id }}</td>
                            <td class="fw-semibold text-primary">{{ $course->subject_id }}</td>
                            <td class="fw-semibold text-primary">{{ $course->track_id }}</td>
                            <td class="fw-semibold text-primary">{{ $course->course }}</td>
                            <td class="text-muted">{{ Str::limit($course->description, 50) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-warning me-1 shadow-sm">✏️ Modify</a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirm deletion of this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">🗑️ Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No courses yet. Add your first course!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleViewBtn');
    const formDiv = document.getElementById('addCourseForm');
    const tableDiv = document.getElementById('coursesTable');

    tableDiv.style.display = 'none';
    formDiv.style.display = 'block';

    if(window.location.hash === '#courses') {
        showTableView();
    }

    toggleBtn.addEventListener('click', function () {
        if(formDiv.style.display !== 'none') {
            showTableView();
        } else {
            showFormView();
        }
    });

    function showTableView() {
        formDiv.style.display = 'none';
        tableDiv.style.display = 'block';
        toggleBtn.innerHTML = '➕ Add a Course';
        toggleBtn.classList.remove('btn-outline-primary');
        toggleBtn.classList.add('btn-outline-success');
        window.history.replaceState(null, null, '#courses');
    }

    function showFormView() {
        formDiv.style.display = 'block';
        tableDiv.style.display = 'none';
        toggleBtn.innerHTML = '📖 View All Courses';
        toggleBtn.classList.remove('btn-outline-success');
        toggleBtn.classList.add('btn-outline-primary');
        window.history.replaceState(null, null, ' ');
    }
});
</script>

<style>
.card {
    border-radius: 15px;
}
.form-control:focus {
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.2);
}
.table tbody tr:hover {
    background-color: rgba(23, 162, 184, 0.05);
}
.btn {
    border-radius: 10px;
    font-weight: 500;
}
.btn-outline-warning:hover {
    color: #fff !important;
    background-color: #ffc107;
    border-color: #ffc107;
}
.btn-outline-danger:hover {
    color: #fff !important;
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
@endsection
