<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Page;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $this Page */

        return [
            'external_id' => $this->getExternalId(),
            'title'       => $this->getTitle(),
            'content'     => $this->getContent(),
        ];
    }
}
