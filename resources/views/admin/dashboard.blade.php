@extends('layouts.sidebar')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <!-- Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-blue-600 font-semibold">Pesanan Masuk</p>
            <p class="text-2xl font-bold">12</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-green-600 font-semibold">Kamar Tersedia</p>
            <p class="text-2xl font-bold">5</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-red-600 font-semibold">Kamar Digunakan</p>
            <p class="text-2xl font-bold">9</p>
        </div>
    </div>

    <!-- Jadwal dan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Kalender -->
        <div class="bg-white p-4 rounded shadow md:col-span-2">
            <h2 class="text-lg font-bold mb-2">Jadwal Pemesanan</h2>
            <p class="text-sm mb-2">Juli 2025</p>
            <div class="grid grid-cols-7 gap-2 text-center text-sm font-semibold">
                @foreach (["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"] as $day)
                    <div>{{ $day }}</div>
                @endforeach
            </div>
            <div class="grid grid-cols-7 gap-2 mt-2 text-center">
                @for ($i = 1; $i <= 29; $i++)
                    <div class="border rounded p-2 relative cursor-pointer" onclick="showDetails({{ $i }})">
                        {{ $i }}
                        {{-- Notifikasi Merah (Trip) --}}
                        @if(in_array($i, [3, 8]))
                            <span class="absolute -top-1 -right-1 w-5 h-5 text-xs bg-red-500 text-white rounded-full flex items-center justify-center">
                                2
                            </span>
                        @endif

                        {{-- Notifikasi Hijau (Homestay) --}}
                        @if(in_array($i, [13, 20]))
                            <span class="absolute -bottom-1 -left-1 w-5 h-5 text-xs bg-green-500 text-white rounded-full flex items-center justify-center">
                                1
                            </span>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white p-4 rounded shadow flex flex-col items-center justify-center h-[300px]">
            <h2 class="text-lg font-bold mb-4 text-center">Statistik Booking</h2>
            <div class="w-full max-w-xs h-64">
                <canvas id="bookingChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Modal -->
        <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-4 rounded shadow-lg w-80">
                <h3 class="text-lg font-bold mb-2">Detail Booking</h3>
                <ul id="bookingList" class="text-sm text-gray-700 space-y-1"></ul>
                <button onclick="closeModal()" class="mt-4 bg-blue-500 text-white px-4 py-1 rounded">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('bookingChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Trip', 'Homestay'],
                datasets: [{
                    label: 'Booking',
                    data: [60, 40],
                    backgroundColor: ['#4CAF50', '#F44336'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });


    function showDetails(day) {
        const list = document.getElementById('bookingList');
        list.innerHTML = '';

        const todayBookings = bookings.filter(b => {
            return new Date(b.date).getDate() === day;
        });

        if (todayBookings.length === 0) {
            list.innerHTML = '<li>Tidak ada booking.</li>';
        } else {
            todayBookings.forEach(b => {
                list.innerHTML += `<li>${b.type.charAt(0).toUpperCase() + b.type.slice(1)} - ${b.date}</li>`;
            });
        }

        document.getElementById('bookingModal').classList.remove('hidden');
        document.getElementById('bookingModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('bookingModal').classList.add('hidden');
    }
</script>
@endsection
