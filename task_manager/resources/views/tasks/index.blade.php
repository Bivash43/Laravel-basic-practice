
@extends('layouts.app')

@section('content')
    <h1>Task List</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($task as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" style="background: red; color: white; width: fit-content; border-radius: 4px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection





