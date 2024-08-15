<?php

namespace App\Http\Controllers;

use App\Models\Task;
require "C:\\Projects\\LaravelCourc\\test-project\\functions\\Gpt.php";
use Illuminate\Http\Request;



class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
//        for ($i = 0; $i < count($tasks); $i++) {
//            $tasks[$i]['tip'] = Gpt::getRespones($tasks[$i]['task']);
//        }
        return view('todo', ['tasks'=>$tasks]);
    }



    public function add(Request $request){

        $validated = $request->validate([
            'task' => 'required|max:255',
        ]);

        $task = new Task();
        $task['tip'] = Gpt::getRespones($validated['task']);
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
