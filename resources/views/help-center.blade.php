<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Pusat Bantuan</x-slot>

    {{-- Bagian Banner --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8 max-w-2xl space-y-6">
            <h1 class="text-2xl font-bold">🚨 Pusat Bantuan</h1>
            <div>
                <h2 class="mb-1 text-lg font-semibold">Pendahuluan</h2>
                <p class="text-justify indent-5">
                    Selamat datang di Pusat Bantuan!
                    Di sini kamu bisa menemukan panduan dan jawaban atas pertanyaan umum seputar penggunaan platform
                    kami - baik sebagai pembeli maupun penjual.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="mb-1 text-lg font-semibold">Panduan Umum</h2>
                <ul class="space-y-2">
                    <li>
                        <h3 class="font-semibold">1. Cara Membuat Akun</h3>
                        <p>Untuk memulai, klik icon User di pojok kanan atas, klik daftar sekarang!. Pilih tipe akun
                            "<strong>Pengunjung</strong>" lalu isi data diri
                            dengan benar.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">2. Cara Merubah Profil</h3>
                        <p>Klik icon User di pojok kanan atas, pilih menu Profil Saya. Kamu bisa memperbarui username,
                            email, dan password.</p>
                    </li>
                </ul>

                <h2 class="mb-1 text-lg font-semibold">Untuk Penjual</h2>
                <ul class="space-y-2">
                    <li>
                        <h3 class="font-semibold">1. Cara Membuat Akun</h3>
                        <p>Untuk memulai, klik icon User di pojok kanan atas, klik daftar sekarang!. Pilih tipe akun
                            "<strong>Penjual</strong>" lalu isi data diri
                            dengan benar.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">2. Cara Merubah Profil</h3>
                        <p>Klik icon User di pojok kanan atas, pilih menu Profil Saya. Kamu bisa memperbarui username,
                            email, dan password.</p>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="mb-1 text-lg font-semibold">Butuh Bantuan Lebih Lanjut?</h2>
                <ul>
                    <li>Email:</li>
                    <li>Instagram:</li>
                    <li>TikTok:</li>
                </ul>
            </div>
        </div>
    </section>

</x-guest-layout>
