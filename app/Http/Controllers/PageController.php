<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    private PageService $pageService;

    public function __construct(PageService $pageService)
    {
        parent::__construct();
        $this->pageService = $pageService;
    }

    public function show(Request $request, $slug)
    {
        $page = $this->pageService->getBySlug($slug);

        return $this->themeService->view('pages.show', [
            'page' => (new PageResource($page))->toArray($request)
        ]);
    }
}
