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
}
