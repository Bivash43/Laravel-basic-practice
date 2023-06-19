<!-- resources/views/tasks/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Task Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
            <p class="card-text"><strong>Due Date:</strong> {{ $task->due_date }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $task->status }}</p>
        </div>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary mt-3">Back to Task List</a>
@endsection
