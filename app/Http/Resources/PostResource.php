<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
          'title' => $this->title,
          'description' => $this->description,
          'body' => $this->body,
          'tags' => $this->tags,
          'header_image' => $this->header_image,
          'user_id' => $this->user_id,
          'user_name' => $this->user->name,
          'category_id' => $this->category_id,
          'category_name' => $this->category->name,
          'slug' => Str::slug($this->title, '-'),
          'created_at'=> $this->created_at,
        ];
    }
}
