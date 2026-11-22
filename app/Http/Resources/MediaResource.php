<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'genre' => $this->genre,
            'description' => $this->description,
            'rating' => $this->rating,
            'type' => $this->type,
            'episode' => $this->episode,
            'chapter' => $this->chapter,
            'members' => MemberResource::collection(
                $this->whenLoaded('members')
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
