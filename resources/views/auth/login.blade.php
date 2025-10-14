<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Login</x-slot>

    {{-- Bagian Login --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <div
                class="flex flex-col w-full max-w-sm mx-auto p-5 border border-gray-300 rounded-lg shadow overflow-hidden">
                {{-- Judul Card --}}
                <h1 class="mb-5 text-xl font-bold">Log In</h1>

                {{-- Form Login --}}
                <form action="{{ route('login') }}" method="post" class="space-y-5">
                    @csrf

                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                            required
                            class="w-full px-3 py-2 bg-white text-sm border border-gray-300 rounded-md focus:outline-blue-500">

                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ show: false }" class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password" placeholder="Password"
                            required
                            class="w-full px-3 py-2 bg-white text-sm border border-gray-300 rounded-md focus:outline-blue-500">
                        <div class="absolute inset-y-0 right-3 flex items-center cursor-pointer" @click="show = !show">
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

                {{-- Divider --}}
                <div class="flex items-center mt-5 mb-3">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="px-3 text-sm text-gray-500">Atau</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                {{-- Login Lainnya --}}
                <div class="flex justify-center">
                    <a href="{{ route('login.google') }}"
                        class="inline-flex w-fit gap-2 px-3 py-1.5 bg-white border border-gray-300 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                            viewBox="0 0 48 48">
                            <path fill="#FFC107"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#FF3D00"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4CAF50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1976D2"
                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                        Sign In With Google
                    </a>
                </div>

                {{-- Daftar --}}
                <p class="mt-5 text-center">Belum punya akun? <a href="{{ route('register') }}"
                        class="text-blue-600 hover:underline">daftar sekarang!</a></p>
            </div>
        </div>
    </section>

</x-guest-layout>
