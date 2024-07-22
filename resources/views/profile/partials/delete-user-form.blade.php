<section class="space-y-6">

    {{-- header --}}
    <header>
        {{-- delete account --}}
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Elimina Account') }}
        </h2>
        {{-- /delete account --}}


        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una volta eliminato il tuo account, tutte le sue risorse e i suoi dati verranno eliminati definitivamente. Prima di eliminare il tuo account, scarica tutti i dati o le informazioni che desideri conservare.') }}
        </p>
    </header>
    {{-- /header --}}

    {{-- btn delete account --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Elimina account') }}
    </x-danger-button>
    {{-- /btn delete account --}}

    {{-- modal confirm delete account --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            {{-- title modal question --}}
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Sei sicuro di voler eliminare l\'account?') }}
            </h2>
            {{-- /title modal question --}}

            {{-- modal question --}}
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una volta eliminato il tuo account, tutte le sue risorse e i suoi dati verranno eliminati definitivamente. Inserisci la tua password per confermare che desideri eliminare definitivamente il tuo account.') }}
            </p>
            {{-- /modal question --}}

            {{-- input e verify password --}}
            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            {{-- input e verify password --}}

            {{-- modal button --}}
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annulla') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Elimina account') }}
                </x-danger-button>
            </div>
            {{-- /modal button --}}

        </form>
    </x-modal>
    {{-- modal confirm delete account --}}

</section>
