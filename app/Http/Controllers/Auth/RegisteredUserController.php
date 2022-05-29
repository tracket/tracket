<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Tracket\Core\Services\SettingsService;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class RegisteredUserController extends Controller
{
    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();
        $this->settingsService = $settingsService;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!$this->settingsService->get('allow_developer_accounts')
            && !$this->settingsService->get('allow_hiring_manager_accounts')) {
            abort(404);
        }

        return $this->themeService->view('auth.register', [
            'settingsService' => $this->settingsService
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'string', Rule::in([Role::ROLE_DEVELOPER, Role::ROLE_HIRING_MANAGER])],
        ]);

        $userRepository  = app(UserRepository::class);
        $roleRepository  = app(RoleRepository::class);

        if (!$this->settingsService->get('allow_developer_accounts') && $validated['role'] === Role::ROLE_DEVELOPER) {
            throw new \Exception('Cannot create a developer account');
        }

        if (!$this->settingsService->get('allow_hiring_manager_accounts') && $validated['role'] === Role::ROLE_HIRING_MANAGER) {
            throw new \Exception('Cannot create a hiring manager account');
        }

        $user = $userRepository->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = $roleRepository->getByName($validated['role']);
        $user->attachRole($role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
