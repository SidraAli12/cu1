<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto py-10">
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Course Management</h2>

            <form id="addCourseForm" class="mb-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="number" name="subject_id" class="border p-2 rounded w-full" placeholder="Subject ID" required>
                    <input type="number" name="track_id" class="border p-2 rounded w-full" placeholder="Track ID" required>
                    <input type="text" name="course" class="border p-2 rounded w-full" placeholder="Course Name" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Add Course</button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 border">#</th>
                            <th class="p-3 border">Subject ID</th>
                            <th class="p-3 border">Track ID</th>
                            <th class="p-3 border">Course</th>
                            <th class="p-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="courseTable">
                        @foreach($courses as $course)
                            <tr class="hover:bg-gray-50" data-id="{{ $course->id }}">
                                <td class="p-3 border">{{ $course->id }}</td>
                                <td class="p-3 border editable" contenteditable="true" data-field="subject_id">{{ $course->subject_id }}</td>
                                <td class="p-3 border editable" contenteditable="true" data-field="track_id">{{ $course->track_id }}</td>
                                <td class="p-3 border editable" contenteditable="true" data-field="course">{{ $course->course }}</td>
                                <td class="p-3 border text-center">
                                    <button class="deleteCourse bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    // Add Course
    document.querySelector('#addCourseForm').addEventListener('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);
        fetch("{{ route('courses.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                location.reload();
            } else {
                alert('Error adding course');
            }
        });
    });

    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('blur', function(){
            let id = this.closest('tr').dataset.id;
            let field = this.dataset.field;
            let value = this.innerText.trim();

            if(value === '') {
                alert('Field cannot be empty');
                return;
            }

            fetch(`/courses/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ [field]: value })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status !== 'success'){
                    alert('Error updating course');
                }
            });
        });
    });

    document.querySelectorAll('.deleteCourse').forEach(btn => {
        btn.addEventListener('click', function(){
            let id = this.closest('tr').dataset.id;
            if(!confirm('Are you sure you want to delete this course?')) return;

            fetch(`/courses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success'){
                    this.closest('tr').remove();
                } else {
                    alert('Error deleting course');
                }
            });
        });
    });
    </script>
</body>
</html>
