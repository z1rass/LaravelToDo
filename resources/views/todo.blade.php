<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
    <!-- Список задач -->
    <form action="/todo/update" method="POST"  class="mb-6">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Todo List</h2>
        <ul class="space-y-4">
            <!-- Пример задачи -->
            @foreach($tasks as $task)
                <li class="flex items-center justify-between">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="completed_tasks[]" value="{{ $task->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="text-gray-700">{{$task->task}}</span>
                    </label>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none">
            Done
        </button>
    </form>

    <!-- Добавление новой задачи -->
    <form action="/todo/add" method="POST">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add task</h2>
        <div class="mb-4">
            <input type="text" name="task" placeholder="Enter a new task" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600">
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none">
            Add
        </button>
    </form>
</div>
</body>
</html>
