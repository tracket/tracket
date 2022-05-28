@extends('theme::default.layouts.guest')

@section('content')
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('web.register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Account type')" />

                <fieldset class="mt-2">
                    <legend class="sr-only">Plan</legend>
                    <div class="flex flex-col space-y-2">
                        @if ($settingsService->get('allow_developer_accounts'))
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="developer" aria-describedby="developer" name="role" value="developer" type="radio" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="small" class="font-medium text-gray-700 font-bold">A Developer</label>
                                    <p id="small-description" class="text-gray-500">Looking to find open roles</p>
                                </div>
                            </div>
                        @endif

                        @if ($settingsService->get('allow_hiring_manager_accounts'))
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="hiring-manager" aria-describedby="hiring-manager" name="role" value="hiring_manager" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="medium" class="font-medium text-gray-700 font-bold">A Hiring Manager</label>
                                    <p id="medium-description" class="text-gray-500">Looking to hire developers</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <div class="flex items-center justify-end mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('web.login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
@endsection
