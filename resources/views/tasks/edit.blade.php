<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Task</h1>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Task name input -->
            <div class="mb-3">
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $task->task_name }}" required>
            </div>

            <!-- Task status select -->
            <div class="mb-3">
                <label for="status" class="form-label">Task Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In-Progress" {{ $task->status == 'In-Progress' ? 'selected' : '' }}>In-Progress</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Update button -->
            <button type="submit" class="btn btn-success">Update Task</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
