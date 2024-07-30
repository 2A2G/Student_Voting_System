<div>
    <x-guest-layout>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mt-12 ml-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @switch($caso)
                    @case('estudiante')
                        @livewire('invitado.estudiante')
                    @break

                    @default
                        @livewire('invitado.dashboard')
                @endswitch
            </div>
        </div>
    </x-guest-layout>
</div>
