<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Company;

class CompanyRepository
{
    private function query(): Builder
    {
        return Company::query();
    }

    public function all(): Collection
    {
        return $this->query()->orderBy('id', 'asc')->get();
    }

    public function getByExternalId(string $externalId): Company
    {
        $company = $this->query()
            ->where('external_id', $externalId)
            ->first();

        if (!$company) {
            throw new CompanyNotFoundException($externalId);
        }

        return $company;
    }

    public function create(array $attributes): Company
    {
        $company = new Company();
        $company->fill($attributes);
        $company->save();
        return $company;
    }

    public function update(Company $company, array $attributes): Company
    {
        $company->update($attributes);
        return $company;
    }

    public function softDelete(Company $company): bool
    {
        return $company->delete();
    }
}
