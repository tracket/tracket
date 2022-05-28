<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyService
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAll(): Collection
    {
        return $this->companyRepository->all();
    }

    public function getComboboxOptions(): array
    {
        return $this->companyRepository->all()->mapWithKeys(function (Company $company, $key) {
            return [$company->getExternalId() => $company->getName()];
        })->toArray();
    }

    public function getByExternalId(string $externalId): Company
    {
        return $this->companyRepository->getByExternalId($externalId);
    }

    public function create(array $attributes): Company
    {
        $company = $this->companyRepository->create($attributes);

        if (Arr::has($attributes, 'logo')) {
            Storage::disk('public')->putFileAs('logos', $attributes['logo'], $company->getExternalId() . '.jpg');
        }

        return $company;
    }

    public function update($externalId, array $attributes): Company
    {
        $company = $this->companyRepository->getByExternalId($externalId);

        if (Arr::has($attributes, 'logo')) {
            Storage::disk('public')->putFileAs('logos', $attributes['logo'], $externalId . '.jpg');
        }

        return $this->companyRepository->update($company, $attributes);
    }

    public function delete($externalId): bool
    {
        $company = $this->companyRepository->getByExternalId($externalId);
        return $this->companyRepository->softDelete($company);
    }
}
