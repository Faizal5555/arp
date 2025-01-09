<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/forgot-password">
                <img class="btMainLogo" style="width: 200px;" data-hw="1.7966666666667" src="https://www.asiaresearchpartners.com/adminapp/assets/images/logo-3.png" alt="Asia Research Partners LLP">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Contact your Manager to reset the password') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

    </x-auth-card>
</x-guest-layout>
