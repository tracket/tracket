<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tracket\Core\Traits\HasExternalId;

class Page extends Model
{
    use HasFactory;
    use HasExternalId;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function getSlug(): string
    {
        return $this->getAttribute('slug');
    }

    public function getContent(): string
    {
        return $this->getAttribute('content');
    }
}
