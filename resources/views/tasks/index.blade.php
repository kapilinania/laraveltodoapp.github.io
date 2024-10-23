<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .badge-pending {
            background-color: #ffc107; 
        }
        .badge-in-progress {
            background-color: #007bff; 
        }
        .badge-completed {
            background-color: #28a745; 
        }
        .list-group-item {
            transition: background-color 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #f8f9fa; 
        }
        .input-group input {
            transition: border-color 0.3s ease;
        }
        .input-group input:focus {
            border-color: #007bff; 
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25); 
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Task List</h1>

        <!-- Form to create a new task -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="task_name" placeholder="New Task" required>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

        <!-- List of tasks -->
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->task_name }}</strong> 
                        <span class="badge {{ 
                            $task->status == 'Pending' ? 'badge-pending' : 
                            ($task->status == 'In-Progress' ? 'badge-in-progress' : 'badge-completed')
                        }}">{{ $task->status }}</span>
                    </div>
                    <div>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $task->id }}">
                            Delete
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Bootstrap Modal  -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this task?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set the action of the delete form in the modal
        const deleteButtons = document.querySelectorAll('.btn-danger[data-bs-toggle="modal"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-id');
                const form = document.getElementById('deleteForm');
                form.action = `{{ url('tasks') }}/${taskId}`; // Set the action URL for the form
            });
        });
    </script>
</body>
</html>
