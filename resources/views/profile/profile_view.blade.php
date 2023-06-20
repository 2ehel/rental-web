<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="p-10">
        <x-form-section submit="updateProfileInformation">
            <x-slot name="title">
                {{ __('Profile Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your account\'s profile information and email address.') }}
            </x-slot>
            <x-slot name="form">
                <!-- First name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                        autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" />
                    <x-input-error for="phone" class="mt-2" />
                </div>

                
            </x-slot>

            <x-slot name="actions">
                <x-action-message class="mr-2" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
    <div class="p-10">
        <x-form-section submit="updateProfileContactInformation">
            <x-slot name="title">
                {{ __('Profile Password Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your account\'s profile password information.') }}
            </x-slot>

            <x-slot name="form">

                <!-- Password -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" type="password" class="mt-1 block w-full"
                        wire:model.defer="state.password" />
                    <x-input-error for="password" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="confirm_password" value="{{ __('Confirm Password') }}" />
                    <x-input id="confirm_password" type="confirm_password" class="mt-1 block w-full"
                        wire:model.defer="state.confirm_password" />
                    <x-input-error for="confirm_password" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="actions">
                <x-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</x-app-layout>
