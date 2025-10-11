<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Dashboard</x-slot>

    {{-- Bagian Statistik User --}}
    <section>
        <h1 class="inline-block px-3 py-1 bg-[#3e2723] text-white font-semibold rounded-[10px_0_10px_0] mb-5">Statistik
            Pengguna</h1>

        {{-- Card Statistik --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <x-cards.stats-card title="Total Pengguna" :value="$totalActiveUsers" description="Total pengguna aktif"
                color="bg-yellow-600" :icon="view('components.icons.people-fill')->render()" />
            <x-cards.stats-card title="Total Admin" :value="$totalActiveAdmins" description="Total admin aktif" color="bg-red-600"
                :icon="view('components.icons.person-fill-gear')->render()" />
            <x-cards.stats-card title="Total Penjual" :value="$totalActiveSellers" description="Total penjual aktif"
                color="bg-green-600" :icon="view('components.icons.person-fill-hearts')->render()" />
            <x-cards.stats-card title="Total Pengunjung" :value="$totalActiveVisitors" description="Total pengunjung aktif"
                color="bg-blue-600" :icon="view('components.icons.person-fill-check')->render()" />
        </div>

        {{-- Chart Statistik --}}
        <div class="flex flex-col mt-5 p-5 bg-white rounded-lg shadow overflow-hidden">
            <h2 class="font-semibold mb-3">Perkembangan Pengguna Aktif & Tidak Aktif ({{ date('Y') }})</h2>
            <canvas id="userStatusChart" class="max-h-56"></canvas>
        </div>
    </section>

    {{-- Bagian Statistik Usaha --}}
    <section class="mt-7">
        <h1 class="inline-block px-3 py-1 bg-[#3e2723] text-white font-semibold rounded-[10px_0_10px_0] mb-5">Statistik
            Usaha</h1>

        {{-- Card Statistik --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <x-cards.stats-card title="Total Usaha" :value="$totalBusinesses" description="Total usaha aktif"
                color="bg-yellow-600" :icon="view('components.icons.cart-check')->render()" />
            <x-cards.stats-card title="Total Mikro" :value="$totalMicroBusinesses" description="Total usaha mikro"
                color="bg-red-600" :icon="view('components.icons.shop-window')->render()" />
            <x-cards.stats-card title="Total Kecil" :value="$totalSmallBusinesses" description="Total usaha kecil"
                color="bg-blue-600" :icon="view('components.icons.shop')->render()" />
            <x-cards.stats-card title="Total Menengah" :value="$totalMediumBusinesses" description="Total usaha menengah"
                color="bg-green-600" :icon="view('components.icons.buildings')->render()" />
        </div>

        {{-- Chart Statistik --}}
        <div class="flex flex-col mt-5 p-5 bg-white rounded-lg shadow overflow-hidden">
            <h2 class="font-semibold mb-3">Perkembangan Usaha ({{ date('Y') }})</h2>
            <canvas id="businessStatusChart" class="max-h-56"></canvas>
        </div>
    </section>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = @json($months);
        const activeUsers = @json($activeUsersByMonth);
        const inactiveUsers = @json($inactiveUsersByMonth);
        const businesses = @json($businessesByMonth);

        new Chart(document.getElementById('userStatusChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: 'Aktif',
                        data: activeUsers,
                        borderColor: '#2e7d32',
                        backgroundColor: 'rgba(46, 125, 50, 0.2)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Tidak Aktif',
                        data: inactiveUsers,
                        borderColor: '#c62828',
                        backgroundColor: 'rgba(198, 40, 40, 0.2)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('businessStatusChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Pertumbuhan Usaha',
                    data: businesses,
                    borderColor: '#2e7d32',
                    backgroundColor: 'rgba(46, 125, 50, 0.2)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</x-app-layout>
