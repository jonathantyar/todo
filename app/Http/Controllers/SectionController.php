<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SectionWithTaskResource;

use Validator;

use Illuminate\Support\Facades\Cache;

class SectionController extends Controller
{
    public function index()
    {
        // Store cache for 1 minutes if not exits
        $section = Cache::remember('sections', 60, function () {
            return Section::orderBy('created_at','desc')->get();
        });

        return SectionResource::collection($section);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        $section = new Section;
        $section->name = $request->name;
        $section->save();

        Cache::pull('sections');

        return new SectionResource($section);
    }

    public function show($id)
    {
        if($section = Section::find($id)) {
            return new SectionResource($section);
        }

        return response()->json(['error'=>'Record not found!'],404);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 400);
        }

        if($section = Section::find($request->id)) {
            $section->name = $request->name;
            $section->save();

            return new SectionResource($section);
        }

        Cache::pull('sections');

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

        if($section = Section::find($request->id)) {
            $section->delete();

            return new SectionResource($section);
        }

        Cache::pull('sections');

        return response()->json(['error'=>'Record not found!'],404);
    }

    public function showWithTasks($id)
    {
        if($section = Section::with('tasks')->find($id)) {
            return new SectionWithTaskResource($section);
        }

        return response()->json(['error'=>'Record not found!'],404);
    }
}
