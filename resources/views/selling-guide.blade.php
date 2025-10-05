<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Panduan Berjualan</x-slot>

    {{-- Bagian Banner --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8 max-w-2xl space-y-6">
            <h1 class="text-2xl font-bold">🛍️ Panduan Berjualan</h1>
            <div>
                <h2 class="mb-1 text-lg font-semibold">Selamat Datang di Panduan Berjualan</h2>
                <p>Laman ini berisi panduan bagi para penjual untuk mengelola toko, produk, pesanan, dan
                    performa bisnis secara mudah dan cepat.</p>
            </div>

            <div>
                <h2 class="mb-1 text-lg font-semibold">Fitur Utama</h2>
                <ul class="space-y-4">
                    <li>
                        <h3 class="font-semibold">🏪 Manajemen Toko</h3>
                        <p>Kelola profil bisnismu dengan mudah - ubah nama toko, logo, deskripsi, alamat, serta
                            informasi
                            kontak
                            agar pembeli lebih percaya dan mudah menemukan tokomu.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">📦 Manajemen Produk</h3>
                        <p>Tambahkan, ubah, atau hapus produk dengan cepat.
                            Lengkapi informasi seperti nama produk, kategori, harga, deskripsi, dan foto agar menarik
                            perhatian
                            pembeli.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">💰 Harga & Promosi</h3>
                        <p>Atur harga produk, diskon, dan promo khusus untuk menarik lebih banyak pelanggan.
                            Gunakan fitur promosi untuk meningkatkan penjualan dan visibilitas produkmu.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">🌟 Ulasan & Rating</h3>
                        <p>Lihat ulasan dan penilaian dari pembeli.
                            Gunakan feedback tersebut untuk meningkatkan kualitas produk dan layanan pelanggan.</p>
                    </li>
                    <li>
                        <h3 class="font-semibold">📊 Analisis Penjualan</h3>
                        <p>Pantau performa penjualan secara real-time melalui grafik dan laporan penjualan.
                            Dapatkan wawasan untuk mengambil keputusan bisnis yang lebih baik.</p>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="mb-1 text-lg font-semibold">Panduan Singkat Untuk Penjual Baru</h2>
                <ol class="list-decimal list-inside space-y-1">
                    <li>Buat akun penjual <a href="{{ route('register') }}" class="text-blue-600 hover:underline">di sini</a>.</li>
                    <li>Lengkapi profil bisnismu.</li>
                    <li>Tambahkan produk pertamamu.</li>
                </ol>
            </div>
        </div>
    </section>

</x-guest-layout>
