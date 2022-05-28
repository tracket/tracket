<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Job;

class JobRepository
{
    private function query(): Builder
    {
        return Job::query();
    }

    public function all(): Collection
    {
        return $this->query()->orderBy('id', 'asc')->get();
    }

    public function getByExternalId(string $externalId): Job
    {
        $job = $this->query()
            ->where('external_id', $externalId)
            ->first();

        if (!$job) {
            throw new JobNotFoundException($externalId);
        }

        return $job;
    }

    public function create(array $attributes): Job
    {
        $job = new Job();
        $job->fill($attributes);
        $job->save();
        return $job;
    }

    public function update(Job $job, array $attributes): Job
    {
        $job->update($attributes);
        return $job;
    }

    public function softDelete(Job $job): bool
    {
        return $job->delete();
    }
}
