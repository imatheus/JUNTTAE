<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Perfil</h2>
    </x-slot>

    <div class="container">
        <div class="cards-list" style="display:flex; flex-direction:column; gap: 1rem; max-width: 56rem; margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="section-divider"><strong>Meu Perfil</strong></div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="section-divider"><strong>Atualizar Senha</strong></div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="section-divider"><strong>Excluir Conta</strong></div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
