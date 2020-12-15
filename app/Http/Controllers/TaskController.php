<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\SectionWithTaskResource;

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

    public function filterByState($state)
    {
        $availableState  = array('todo','done');
        if(in_array($state, $availableState)){
            $section = Section::whereHas('tasks',function($query) use($state){
                $query->where('state',$state);
                $query->orderBy('created_at','desc');
            })->orderBy('created_at')->get();
            // Supporting new feature The tasks must be chronologically displayed within a section, order by desc
            // $task   = Task::where('state',$state)->orderBy('created_at','desc')->get();

            // return TaskResource::collection($task);
            return SectionWithTaskResource::collection($section);
        }

        return response()->json(['error'=>'Not expected that kind of state! (todo or done)'],400);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'         => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        $section = Section::whereHas('tasks',function($query) use($request){
            $query->where('name','LIKE','%'.$request->search.'%');
            $query->orderBy('created_at','desc');
        })->orderBy('created_at')->get();
        // Supporting new feature The tasks must be chronologically displayed within a section, order by desc
        // $task   = Task::where('name','LIKE','%'.$request->search.'%')->orderBy('created_at','desc')->get();

        // return TaskResource::collection($task);
        return SectionWithTaskResource::collection($section);
    }
}
