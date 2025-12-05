<section>
    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Excluir Conta
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 style="font-size: 1rem; font-weight: 700; color:#111827; margin:0;">
                Tem certeza que deseja excluir sua conta?
            </h2>

            <p style="margin-top: 0.25rem; font-size: 0.875rem; color:#6b7280;">
                Esta ação é permanente. Digite sua senha para confirmar a exclusão.
            </p>

            <div style="margin-top: 0.75rem;">
                <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="input-field" placeholder="Senha" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="button-group" style="margin-top: 0.75rem; justify-content: flex-end;">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>
                <x-danger-button class="ms-3">
                    Excluir Conta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
