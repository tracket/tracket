<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobService;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;

class JobController extends Controller
{
    private JobService $jobService;

    public function __construct(JobService $jobService)
    {
        parent::__construct();
        $this->jobService = $jobService;
    }

    public function index(Request $request)
    {
        $jobs = $this->jobService->getAll();

        return $this->themeService->view('jobs.index', [
            'jobs' => (new JobCollection($jobs))->toArray($request)
        ]);
    }

    public function show(Request $request, $companyExternalId, $jobExternalId)
    {
        $job = $this->jobService->getByExternalIds($companyExternalId, $jobExternalId);

        return $this->themeService->view('jobs.show', [
            'job' => (new JobResource($job))->toArray($request)
        ]);
    }
}
