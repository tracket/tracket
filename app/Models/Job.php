<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tracket\Company\Models\Company;
use Tracket\Core\Traits\HasExternalId;
use Tracket\Job\Enums\JobType;

class Job extends Model
{
    use HasFactory;
    use HasExternalId;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'company_id',
        'type',
        'location',
        'remote_ok',
        'description',
        'application_url'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function getType(): JobType
    {
        return JobType::from($this->getAttribute('type'));
    }

    public function getLocation(): string
    {
        return $this->getAttribute('location');
    }

    public function getRemoteOk(): bool
    {
        return $this->getAttribute('remote_ok');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function getApplicationUrl(): string
    {
        return $this->getAttribute('application_url');
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
