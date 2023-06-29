<x-app-layout>
    <div class="lg:flex items-center justify-between gap-x-3 sm:space-y-4 md:space-y-2 lg:space-y-1">

        <x-card type="one">
            <div class="flex-1 text-left">
                <div class="text-sm font-semibold uppercase text-indigo-600 dark:text-indigo-500 tracking-tight mb-2">
                    earnings (monthly)</div>
                <div class="text-2xl font-semibold text-gray-700 dark:text-white leading-normal tracking-widest">
                    $40,000</div>
            </div>
            <div class="text-right">
                <svg class="fill-current text-indigo-600 dark:text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                    width="50" height="50" viewBox="0 0 24 24">
                    <title>money-wallet-open</title>
                    <g>
                        <path
                            d="M20.5.305h-17a3.535 3.535 0 0 0-3.5 3.5v13a4.5 4.5 0 0 0 3.306 4.174L14.465 23.6a2.929 2.929 0 0 0 2.487-.489A2.863 2.863 0 0 0 18 20.805v-9.692a4.264 4.264 0 0 0-3.119-4.1L4.056 4.028a.75.75 0 1 1 .4-1.446l3.534.975H20.5a.75.75 0 1 1 0 1.5h-5.235a.25.25 0 0 0-.067.491l.086.024a5.719 5.719 0 0 1 2.9 1.894.254.254 0 0 0 .194.091H20.5a.75.75 0 0 1 0 1.5h-1.038a.249.249 0 0 0-.238.327 5.609 5.609 0 0 1 .281 1.731v6.942a.25.25 0 0 0 .25.25h.745a3.5 3.5 0 0 0 3.5-3.5v-11A3.5 3.5 0 0 0 20.5.305zm-5 15a2 2 0 1 1-2-2 2 2 0 0 1 2 2z">
                        </path>
                    </g>
                </svg>
            </div>
        </x-card>

        <x-card type="two">
            <div class="flex-1 text-left">
                <div class="text-sm font-semibold uppercase tracking-tight text-green-600 dark:text-green-400 mb-2">
                    EARNINGS (ANNUAL)</div>
                <div class="text-2xl font-semibold text-gray-700 dark:text-white leading-normal tracking-widest">
                    $215,000</div>
            </div>
            <div class="text-right">
                <svg class="fill-current text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg"
                    width="50" height="50" viewBox="0 0 20 20">
                    <title>currency-dollar</title>
                    <g>
                        <path
                            d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z">
                        </path>
                    </g>
                </svg>
            </div>
        </x-card>

        <x-card type="three">
            <div class="flex-1 text-left">
                <div class="text-sm font-semibold uppercase tracking-tight text-pink-600 dark:text-pink-400 mb-2">
                    TASKS</div>
                <div class="text-2xl font-semibold text-gray-700 dark:text-white leading-normal tracking-widest">
                    50%</div>
            </div>
            <div class="text-right">
                <svg class="fill-current text-pink-600 dark:text-pink-400" xmlns="http://www.w3.org/2000/svg" width="50"
                    height="50" viewBox="0 0 20 20">
                    <title>pin</title>
                    <g>
                        <path d="M11 12h6v-1l-3-1V2l3-1V0H3v1l3 1v8l-3 1v1h6v7l1 1 1-1v-7z"></path>
                    </g>
                </svg>
            </div>
        </x-card>

        <x-card type="four">
            <div class="flex-1 text-left">
                <div class="text-sm font-semibold uppercase tracking-tight text-yellow-500 dark:text-yellow-400 mb-2">
                    PENDING REQUESTS</div>
                <div class="text-2xl font-semibold text-gray-700 dark:text-white leading-normal tracking-widest">
                    18</div>
            </div>
            <div class="text-right">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"><title>31</title><g><g id="31.-Papers" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><path id="Layer-1" stroke="#E4EBF4" stroke-width="4" fill="#E4EBF4" d="M24 90h52v8H24z"></path><path id="Layer-2" stroke="#D1DDEB" stroke-width="4" fill="#D1DDEB" d="M20 82h60v8H20z"></path><path id="Layer-3" stroke="#C1D0E0" stroke-width="4" fill="#C1D0E0" d="M16 74h68v8H16z"></path><path id="Layer-4" stroke="#A4B8CE" stroke-width="4" fill="#A4B8CE" d="M72.069 2L12 2.18v71.895h76V17.758L72.25 2.18z"></path><path id="Layer-5" stroke="#8DA1B7" stroke-width="4" fill="#8DA1B7" d="M88 18H72V2z"></path></g></g></svg> --}}
                <svg class="fill-current text-yellow-500 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                    width="50" height="50" viewBox="0 0 20 20">
                    <title>inbox-download</title>
                    <g fill="text-orange-400">
                        <path
                            d="M0 2C0 .9.9 0 2 0h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm14 12h4V2H2v12h4c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2zM9 8V5h2v3h3l-4 4-4-4h3z">
                        </path>
                    </g>
                </svg>
            </div>
        </x-card>

    </div>
</x-app-layout>
