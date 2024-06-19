<x-app-layout>


    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="mt-12 ml-4 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            @switch($componente ?? '')
                @case('usuarios')
                    @livewire('hg')
        
                @break

                @default
                    @livewire('super-admin.estadistica')
            @endswitch
        </div>
    </div>

</x-app-layout>
