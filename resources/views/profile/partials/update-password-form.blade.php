<section>

    {{-- header --}}
    <header>

        {{-- title --}}
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Aggiorna password') }}
        </h2>
        {{-- /title --}}

        {{-- subtitle --}}
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assicurati che il tuo account utilizzi una password lunga e casuale per rimanere sicuro.') }}
        </p>
        {{-- /subtitle --}}

    </header>
    {{-- header --}}

    {{-- form --}}
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- current password --}}
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        {{-- current password --}}


        {{-- new-password --}}
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        {{-- new-password --}}

        {{-- new-password confirm --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        {{-- new-password confirm --}}

        {{-- btn-save --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salva') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Salvata.') }}</p>
            @endif
        </div>
        {{-- btn-save --}}

    </form>
    {{-- /form --}}
</section>
