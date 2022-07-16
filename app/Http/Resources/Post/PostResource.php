<?php

namespace App\Http\Resources\Post;

use App\Models\Post;
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
        /**
         * @var Post $this
         */
        return [
            'id' => $this->id,
            'description' => $this->description,
            'content' => $this->content,
            'website' => $this->website->name,
        ];
    }
}
