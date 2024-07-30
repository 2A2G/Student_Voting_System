<div>
    <x-guest-layout>
        <div class="min-h-screen flex flex-col bg-gradient-to-r from-blue-50 to-blue-100">
            <div class="container mx-auto py-6 px-4 md:px-6 lg:px-8">
                @if (Route::has('login'))
                    <nav class="flex justify-end space-x-4">
                        @auth
                            <a href="{{ url('inefrapasa/dashboard') }}"
                                class="rounded-full bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-opacity-75">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-full bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-opacity-75">
                                Log in
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>

            <div class="flex flex-1 flex-col items-center justify-center text-center p-6 md:p-10 lg:p-12">
                <div
                    class="bg-white bg-opacity-90 p-8 md:p-12 lg:p-16 rounded-lg shadow-lg max-w-2xl md:max-w-4xl lg:max-w-5xl w-full">
                    <div class="flex justify-center mb-6">
                        <x-authentication-card-logo />
                    </div>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-lobster text-pink-800 drop-shadow-lg">
                        PROJECT
                    </h1>
                    <h2 class="text-5xl md:text-7xl lg:text-8xl font-lobster text-gray-800 mt-4 drop-shadow-lg">
                        INEFRAPASA
                    </h2>
                </div>
                <br>
                <a href="{{ route('sveEstudinate') }}"
                    class="mt-6 rounded-full bg-blue-600 px-6 py-3 md:px-8 md:py-4 lg:px-10 lg:py-5 text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-opacity-75">
                    Sistema de Votación Estudiantil
                </a>
            </div>

            <!-- Footer -->
            <footer
                class="w-full py-6 text-center text-sm bg-gray-800 text-gray-300 flex items-center justify-center space-x-4">
                <span>Desarrollado por Aldair <span class="font-semibold">AG</span> &copy; {{ date('Y') }}</span>
                <span>|</span>
                <a href="https://github.com/2A2G" class="text-blue-400 hover:text-blue-500" target="_blank"
                    rel="noopener noreferrer">
                    GitHub: @2A2G
                </a>
                <span>|</span>
                <a href="https://co.linkedin.com/in/aldair-guti%C3%A9rrez-guerrero-b002a9274"
                    class="text-blue-400 hover:text-blue-500" target="_blank" rel="noopener noreferrer">
                    LinkedIn: Aldair Gutierrez
                </a>
                <span>|</span>
                <span>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
            </footer>


        </div>
    </x-guest-layout>
</div>
