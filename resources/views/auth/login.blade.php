<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Login</x-slot>

    {{-- Bagian Banner --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <div class="flex justify-center">
                <div class="w-full max-w-sm flex flex-col p-5 border border-gray-300 rounded-lg shadow overflow-hidden">
                    <h1 class="mb-5 text-xl font-bold">Log In</h1>

                    <form action="{{ route('login') }}" method="post" class="space-y-5">
                        @csrf

                        <div>
                            <input id="email" type="email" name="email" :value="old('email')" placeholder="Email"
                                required
                                class="w-full px-3 py-2 bg-white text-sm border border-gray-300 rounded-md focus:outline-blue-500">

                            @error('email')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{ show: false }" class="relative">
                            <input :type="show ? 'text' : 'password'" id="password" name="password"
                                placeholder="Password" required
                                class="w-full px-3 py-2 bg-white text-sm border border-gray-300 rounded-md focus:outline-blue-500">
                            <div class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                                @click="show = !show">
                                <template x-if="!show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                        <path
                                            d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                                    </svg>
                                </template>
                                <template x-if="show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </template>
                            </div>
                        </div>

                        <x-buttons.primary-button type="submit" class="w-full">Masuk</x-buttons.primary-button>
                    </form>

                    <div class="flex items-center mt-5 mb-3">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="px-3 text-sm text-gray-500">Atau</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <div class="flex items-center justify-center gap-2">
                        <a href="" class="border border-gray-300 p-1">Facebook</a>
                        <a href="" class="border border-gray-300 p-1">Google</a>
                    </div>

                    <p class="mt-5 text-center">Belum punya akun? <a href="{{ route('register') }}"
                            class="text-blue-600 hover:underline">daftar sekarang!</a></p>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
