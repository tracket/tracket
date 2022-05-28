<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        parent::__construct();
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        $companies = $this->companyService->getAll();

        return $this->themeService->view('companies.index', [
            'companies' => (new CompanyCollection($companies))->toArray($request)
        ]);
    }

    public function show(Request $request, $externalId)
    {
        $company = $this->companyService->getByExternalId($externalId);

        return $this->themeService->view('companies.show', [
            'company' => (new CompanyResource($company))->toArray($request)
        ]);
    }
}
