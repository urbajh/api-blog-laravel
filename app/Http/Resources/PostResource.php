<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //datos que se van a enviar cuando hagamos la solicitud al metodo index
        return [
            'user'=> new UserResource($this->user),
            'category'=> new CategoryResource($this->category),
            'id'=> $this->id,
            'title'=> $this->title,
            'slug'=> $this->slug,
            'content'=> $this->content,
            'description'=> $this->description,
            'published'=> $this->published == 1? true : false,
            'tags'=> TagResource::collection($this->tags),
            'created_at'=> Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y')
        ];
    }
}
