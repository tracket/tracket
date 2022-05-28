<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Job;
use App\Repositories\CompanyRepository;
use App\Repositories\JobRepository;

class JobService
{
    private JobRepository $jobRepository;
    private CompanyRepository $companyRepository;

    public function __construct(JobRepository $jobRepository, CompanyRepository $companyRepository)
    {
        $this->jobRepository     = $jobRepository;
        $this->companyRepository = $companyRepository;
    }

    public function getAll(): Collection
    {
        return $this->jobRepository->all();
    }

    public function getByExternalId(string $externalId): Job
    {
        return $this->jobRepository->getByExternalId($externalId);
    }

    public function getByExternalIds(string $companyExternalId, string $jobExternalId): Job
    {
        $job = $this->jobRepository->getByExternalId($jobExternalId);

        if ($job->company->getExternalId() !== $companyExternalId) {
            throw new JobNotFoundException($jobExternalId);
        }

        return $job;
    }

    public function create(array $attributes): Job
    {
        $this->resolveCompanyId($attributes);
        return $this->jobRepository->create($attributes);
    }

    public function update($externalId, array $attributes): Job
    {
        $this->resolveCompanyId($attributes);
        $this->resolveRemoteOk($attributes);
        $job = $this->jobRepository->getByExternalId($externalId);
        return $this->jobRepository->update($job, $attributes);
    }

    public function delete($externalId): bool
    {
        $job = $this->jobRepository->getByExternalId($externalId);
        return $this->jobRepository->softDelete($job);
    }

    private function resolveCompanyId(array &$attributes): void
    {
        $company = $this->companyRepository->getByExternalId($attributes['company']);
        $attributes['company_id'] = $company->getId();
        unset($attributes['company']);
    }

    private function resolveRemoteOk(array &$attributes): void
    {
        $attributes['remote_ok'] = $attributes['remote_ok'] ?? false;
    }
}
