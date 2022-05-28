<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Company;
use App\Models\Job;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $this Job */
        /* @var $company Company */
        $company = $this->company;

        return [
            'external_id'     => $this->getExternalId(),
            'title'           => $this->getTitle(),
            'location'        => $this->getLocation(),
            'remote_ok'       => $this->getRemoteOk(),
            'type'            => $this->getType(),
            'description'     => $this->getDescription(),
            'application_url' => $this->getApplicationUrl(),
            'created_at'      => $this->getCreatedAt(),
            'updated_at'      => $this->getUpdatedAt(),
            'company'         => [
                'external_id' => $company->getExternalId(),
                'name'        => $company->getName(),
                'tagline'     => $company->getTagline(),
                'logo_url'    => $company->getLogoUrl()
            ]
        ];
    }
}
