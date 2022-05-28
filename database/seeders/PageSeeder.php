<?php

namespace Database\Seeders;

use App\Services\PageService;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    private PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $aboutPage = $this->pageService->create([
            'title' => 'About',
            'slug' => 'about',
            'content' => '<p>This is an example about page. </p>'
        ]);
    }
}
