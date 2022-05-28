<?php

namespace Database\Seeders;

use App\Services\PageService;
use Illuminate\Database\Seeder;
use Tracket\Core\Services\SettingsService;

class SettingsSeeder extends Seeder
{
    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->settingsService->create([
            'name'        => 'allow_developer_accounts',
            'value'       => true,
            'type'        => 'checkbox',
            'description' => 'Allow developers to create accounts'
        ]);

        $this->settingsService->create([
            'name'        => 'allow_hiring_manager_accounts',
            'value'       => true,
            'type'        => 'checkbox',
            'description' => 'Allow hiring managers to create accounts'
        ]);
    }
}
