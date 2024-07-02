<div>
    <x-app-layout>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mt-12 ml-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @switch($caso)
                    @case('dashboard')
                        @livewire('super-admin.estadistica')
                    @break

                    @case('rolesPermisos')
                        @livewire('super-admin.roles')
                    @break

                    @case('usuarios')
                        @livewire('super-admin.usuarios')
                    @break

                    @case('estudiante')
                        @livewire('super-admin.estudiantes')
                    @break

                    @default
                        @livewire('super-admin.estadistica')
                @endswitch
            </div>
        </div>
    </x-app-layout>
</div>
