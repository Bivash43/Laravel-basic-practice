<?php

namespace App\Http\Controllers;
use App\Models\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::all();
        return view('tasks.index' , compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
        'title' => 'required',
        'description' => 'required',
        'due_date' => 'required',
        'status' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate the uploaded photo
    ]);

        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input ('description');
        $task->due_date = $request->input('due_date');
        $task->status = $request->input('status');
        if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('photos', 'public');
    } else {
        $photoPath = null;
    }
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.create', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->status = $request->input('status');
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
