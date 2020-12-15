<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\TaskResource;

use Carbon\Carbon;

class SectionWithTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
            'taks' => TaskResource::collection($this->tasks),
        ];
    }
}
