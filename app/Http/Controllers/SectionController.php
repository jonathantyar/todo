<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Http\Resources\SectionResource;

use Validator;

class SectionController extends Controller
{
    public function index()
    {
        $section     = Section::orderBy('created_at','desc')->get();

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

        return new SectionResource($section);
    }
}
