<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Tracket\Core\Traits\HasExternalId;

class Company extends Model
{
    use HasFactory;
    use HasExternalId;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'tagline',
        'description',
        'website_url',
        'linkedin_url',
        'twitter_url',
        'blog_url'
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getTagline(): string
    {
        return $this->getAttribute('tagline');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function getWebsiteUrl(): string
    {
        return $this->getAttribute('website_url');
    }

    public function getLinkedinUrl(): ?string
    {
        return $this->getAttribute('linkedin_url');
    }

    public function getTwitterUrl(): ?string
    {
        return $this->getAttribute('twitter_url');
    }

    public function getBlogUrl(): ?string
    {
        return $this->getAttribute('blog_url');
    }

    public function hasLogo(): bool
    {
        return Storage::disk('public')->exists("logos/{$this->getExternalId()}.jpg");
    }

    public function getLogoPath(): ?string
    {
        return "logos/{$this->getExternalId()}.jpg";
    }

    public function getLogoUrl(): ?string
    {
        return $this->hasLogo() ? asset($this->getLogoPath()) : null;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute('updated_at');
    }
}
