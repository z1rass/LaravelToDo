<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('todo', ['tasks'=>$tasks]);
    }



    public function add(Request $request){

        $validated = $request->validate([
            'task' => 'required|max:255',
        ]);

        $task = new Task();
        $task->task = $validated['task'];
        $task->save();
        return redirect('/todo');

    }


    public function update(Request $request){
        $tasks = $request['completed_tasks'];
        foreach ($tasks as $task) {
            $task = Task::find($task);
            if ($task) {
                $task->delete();
            }
        }
        return redirect('/todo');
    }
}
