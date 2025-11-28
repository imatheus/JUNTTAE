<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-700 leading-tight">
            {{ __('Meu Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/70">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Seção 1: Atualizar Informações do Perfil --}}
            <div class="p-6 sm:p-10 bg-white shadow-xl rounded-2xl border-t-8" 
                 style="border-color: #f3e5f5; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);">
                <div class="max-w-3xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Seção 2: Atualizar Senha --}}
            <div class="p-6 sm:p-10 bg-white shadow-xl rounded-2xl border-t-8" 
                 style="border-color: #f3e5f5; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);">
                <div class="max-w-3xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Seção 3: Excluir Usuário --}}
            <div class="p-6 sm:p-10 bg-white shadow-xl rounded-2xl border-t-8" 
                 style="border-color: #f3e5f5; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);">
                <div class="max-w-3xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>