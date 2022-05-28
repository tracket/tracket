<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Page;

class PageRepository
{
    private function query(): Builder
    {
        return Page::query();
    }

    public function all(): Collection
    {
        return $this->query()->orderBy('id', 'asc')->get();
    }

    public function getByExternalId(string $externalId): Page
    {
        $page = $this->query()
            ->where('external_id', $externalId)
            ->first();

        if (!$page) {
            throw new PageNotFoundException($externalId);
        }

        return $page;
    }

    public function getBySlug(string $slug): Page
    {
        $page = $this->query()
            ->where('slug', $slug)
            ->first();

        if (!$page) {
            throw new PageNotFoundException($slug, 'slug');
        }

        return $page;
    }

    public function create(array $attributes): Page
    {
        $page = new Page();
        $page->fill($attributes);
        $page->save();
        return $page;
    }

    public function update(Page $page, array $attributes): Page
    {
        $page->update($attributes);
        return $page;
    }

    public function softDelete(Page $page): bool
    {
        return $page->delete();
    }
}
