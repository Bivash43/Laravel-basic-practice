@extends('layouts.app')

@section('content')
    <h1 style="font-size: 30px">{{ isset($task) ? 'Update The Task' : 'Create New Task'}}</h1>
    <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ isset($task) ? $task->title : old('title') }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ isset($task) ? $task->description : old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" id="due_date" class="form-control" value="{{ isset($task) ? $task->due_date : old('due_date') }}">
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ isset($task) && $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in progress" {{ isset($task) && $task->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ isset($task) && $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="background: #007bff">
            {{ isset($task) ? 'Update Task' : 'Create Task' }}
        </button>
    </div>
</form>

@endsection
