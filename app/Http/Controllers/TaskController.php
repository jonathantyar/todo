<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\Task;
use App\Http\Resources\TaskResource;

use Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id'   => 'required',
            'name'         => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        $section             = new Task;
        $section->section_id = $request->section_id;
        $section->name       = $request->name;
        $section->state      = 'todo';
        $section->save();

        return new TaskResource($section);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'           => 'required',
            'name'         => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        if($task = Task::find($request->id)) {
            $task->name       = $request->name;
            $task->save();

            return new TaskResource($task);
        }

        return response()->json(['error'=>'Record not found!'],404);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        if($task = Task::find($request->id)) {
            $task->delete();

            return new TaskResource($task);
        }

        return response()->json(['error'=>'Record not found!'],404);
    }

    public function updateState(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'           => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        if($task = Task::find($request->id)) {
            if($task->state == "done"){
                $task->state  = "todo";
            }else{
                $task->state  = "done";
            }
            $task->save();

            return new TaskResource($task);
        }

        return response()->json(['error'=>'Record not found!'],404);
    }
}
