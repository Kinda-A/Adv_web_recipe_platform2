<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- NAV LINKS -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                <a href="/recipes" class="text-gray-700 hover:text-gray-900">
                    Recipes
                </a>

                @auth
                    <a href="/recipes/create" class="text-gray-700 hover:text-gray-900">
                        Create
                    </a>
                @endauth

            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">

                <!-- GUEST -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">
                            Register
                        </a>
                    @endif
                @endguest


                <!-- AUTH USER -->
                @auth
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-gray-700">
                                <div>{{ Auth::user()->name }}</div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>

                        </x-slot>

                    </x-dropdown>
                @endauth

            </div>

        </div>
    </div>

</nav>