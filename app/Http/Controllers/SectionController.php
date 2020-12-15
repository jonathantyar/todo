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
}
