<nav x-data="{tab: '{{ request()->route()->getName() }}'}" class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
        <x-application-logo />

        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="{{ route("post.form") }}" type="button" class="text-white shadow-xs font-medium leading-5 rounded-lg text-sm px-3 py-2 box-border bg-primary-600 border border-transparent uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Add new post
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-stone-600 rounded-xl md:hidden hover:bg-gray-50 hover:text-heading focus:outline-none focus:ring-2 focus:ring-gray-100" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-200 rounded-xl bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <!-- <li>
                    <a @click="tab='home'" href="{{ route("home") }}" :class="tab==='home' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3 font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
                        Home
                    </a>
                </li> -->
                <x-navlinks tab="home" :route="route('home')" >Home</x-navlinks>

                <!-- <li>
                    <a @click="tab='self.profile.show'" href="{{ route("self.profile.show") }}" :class="tab==='self.profile.show' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3 font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
                        Profile
                    </a>
                </li> -->
                <x-navlinks tab="self.profile.show" :route="route('self.profile.show')">Profile</x-navlinks>

                <!-- <li>
                    <a @click="tab='search'" href="{{ route("search") }}" :class="tab==='search' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3 font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
                        Search
                    </a>
                </li> -->
                <x-navlinks tab="search" :route="route('search')">Search</x-navlinks>

                <!-- <li>
                    <a @click="tab='profile.view'" href="{{ route("profile.view") }}" :class="tab==='profile.view' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3  font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
                        Settings
                    </a>
                </li> -->
                <x-navlinks tab="profile.view" :route="route('profile.view')">Settings</x-navlinks>

                <!-- <li>
                    <a @click="tab='logout'" href="{{ route("logout") }}" :class="tab==='logout' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3 font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
                        Logout
                    </a>
                </li> -->
                <x-navlinks tab="logout" :route="route('logout')">Logout</x-navlinks>
            </ul>
        </div>
    </div>
</nav>