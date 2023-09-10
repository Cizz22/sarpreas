<aside
    class="shadow-xl max-w-62.5 z-30 ease-nav-brand fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased transition-transform duration-200 xl:left-0 xl:translate-x-0"
    aria-label="Sidebar">
    <div>
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
                sidenav-close></i>
            <div class="px-8 py-6 m-0 text-size-sm whitespace-nowrap text-slate-700 flex flex-row" href="javascript:;"
                target="_blank">
                <i class="fas fa-user-circle text-5xl"></i>
                <div class="flex flex-col">
                    <span class="ml-2 font-semibold transition-all duration-200 ease-nav-brand">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-horizontal-dark" />
        <ul class="space-y-2 pb-4 px-4">
            @foreach ($general_menus as $m)
                <li>
                    <a href="{{$m['url']}}">
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap"
                            sidebar-toggle-item="">{{ $m['title'] }}</span>
                        <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                        </svg>
                    </button>
                </a>
                </li>
            @endforeach
            <hr class="h-px mt-0 bg-transparent bg-gradient-horizontal-dark" />
            {{-- Add Competition Title --}}

            <li class="flex flex-row items-center justify-center w-full pt-8">
                <a href="{{ route('logout') }}"
                    class="flex items-center p-2 px-8 text-base font-normal text-white rounded-9 transition duration-75 group bg-red-500"
                    onclick="event.preventDefault();
                    document.getElementById('logout').submit();">

                    <span class="flex-1 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">Logout</span>

                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout"> @csrf
                </form>
            </li>
        </ul>

    </div>
</aside>
