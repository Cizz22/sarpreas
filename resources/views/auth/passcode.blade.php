<x-guest-layout>
    <div class="container mx-auto mt-8 mb-6">
        <div class="flex flex-wrap items-center justify-center">
            <div class="w-full max-w-sm">
                <img class="rounded-full w-32 h-32 ml-32 mb-4 object-cover"
                    src="https://images.unsplash.com/photo-1509822929063-6b6cfc9b42f2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    alt="login">
                <div class="flex flex-col break-words bg-white dark:bg-gray-800 rounded-lg shadow-md">

                    <div
                        class="font-semibold bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-3 px-6 mb-0 rounded-t-lg">
                        {{ __('Login') }}
                    </div>


                    <form class="w-full p-6" method="POST" action="{{ route('passcode-login') }}">
                        @csrf
                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 dark:text-white text-sm font-bold mb-2">
                                {{ __('Passcode') }}:
                            </label>

                            <input id="passcode" type="text"
                                class="form-input w-full @error('passcode') border-red-500 @enderror" name="passcode"
                                value="{{ old('passcode') }}" required autofocus>

                            @error('passcode')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex mb-6">
                            <label class="inline-flex items-center text-sm text-gray-700 dark:text-white"
                                for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <div class="flex flex-wrap items-center">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:ring">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
