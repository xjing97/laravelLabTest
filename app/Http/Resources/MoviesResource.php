<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MoviesResource extends Resource
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
             'year' => $this->year,
             'category' => new CategoriesResource($this->category),
             'description' => $this->description
         ];
     }
}
