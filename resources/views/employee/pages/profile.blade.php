@extends('employee.connected-base')

@section('title', 'PROFILE')

@section('content')

    <div x-data="{ openEmailReset: false, openPasswordReset: false }">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Mon Profil</h1>

        {{-- Display Admin's Personal Information (Read-Only) --}}
        <div class="mb-8">
            <livewire:employee.profile-display />
        </div>

        @if (!is_null($employee->email))
            {{-- Email Reset Section --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8 transition-colors duration-300 ease-in-out">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">Changer l'Email Associé</h2>
                <button type="button" @click="openEmailReset = !openEmailReset" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <span x-text="openEmailReset ? 'Fermer' : 'Changer l\'Email'"></span>
                </button>
                <div x-show="openEmailReset" x-transition class="mt-6">
                    <livewire:auth.email-reset-form :guard="'employee'" />
                </div>
            </div>

            {{-- Password Reset Section --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300 ease-in-out">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">Changer le Mot de Passe</h2>
                <button type="button" @click="openPasswordReset = !openPasswordReset" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <span x-text="openPasswordReset ? 'Fermer' : 'Changer le Mot de Passe'"></span>
                </button>
                <div x-show="openPasswordReset" x-transition class="mt-6">
                    <livewire:auth.password-reset-form :guard="'employee'" />
                </div>
            </div>
        @endif
    </div>
@endsection
