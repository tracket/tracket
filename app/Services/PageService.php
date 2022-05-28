<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Page;
use App\Repositories\PageRepository;

class PageService
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getAll(): Collection
    {
        return $this->pageRepository->all();
    }

    public function getByExternalId(string $externalId): Page
    {
        return $this->pageRepository->getByExternalId($externalId);
    }

    public function getBySlug(string $slug): Page
    {
        return $this->pageRepository->getBySlug($slug);
    }

    public function create(array $attributes): Page
    {
        return $this->pageRepository->create($attributes);
    }

    public function update($externalId, array $attributes): Page
    {
        $page = $this->pageRepository->getByExternalId($externalId);
        return $this->pageRepository->update($page, $attributes);
    }

    public function delete($externalId): bool
    {
        $page = $this->pageRepository->getByExternalId($externalId);
        return $this->pageRepository->softDelete($page);
    }
}
