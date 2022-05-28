<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name'         => $this->getName(),
            'external_id'  => $this->getExternalId(),
            'tagline'      => $this->getTagline(),
            'description'  => $this->getDescription(),
            'website_url'  => $this->getWebsiteUrl(),
            'linkedin_url' => $this->getLinkedinUrl(),
            'twitter_url'  => $this->getTwitterUrl(),
            'blog_url'     => $this->getBlogUrl(),
            'logo_url'     => $this->getLogoUrl(),
            'created_at'   => $this->getCreatedAt(),
            'updated_at'   => $this->getUpdatedAt(),
            'jobs'         => new JobCollection($this->jobs),
            'locations'    => $this->getLocations(),
            'remoteOk'     => $this->isRemoteOk()
        ];
    }

    private function getLocations(): array
    {
        if ($this->jobs->count() === 0) {
            return [];
        }

        return $this->jobs
            ->pluck('location')
            ->reject(function ($value, $key) {
                return $value === null;
            })
            ->unique()
            ->toArray();
    }

    private function isRemoteOk(): bool
    {
        if ($this->jobs->count() > 0) {
            foreach ($this->jobs as $job) {
                if ($job->getRemoteOk()) {
                    return true;
                }
            }
        }

        return false;
    }
}
