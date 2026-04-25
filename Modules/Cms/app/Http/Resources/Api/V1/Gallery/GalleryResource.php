<?php

namespace Modules\Cms\Http\Resources\Api\V1\Gallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'image_url' => $this->image_url,
            'thumbnail_url' => $this->thumbnail_url,
            'caption' => $this->caption,
            'sort_order' => (int) $this->sort_order,
            'is_featured' => (bool) $this->is_featured,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
