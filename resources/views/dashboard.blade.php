<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                💧 Water Supply MIS Dashboard
            </h2>
            <span class="text-gray-600 text-sm">Date: {{ now()->format('Y-m-d') }}</span>
        </div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6 space-y-10">

            <!-- Welcome -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-red-400 p-6 rounded-2xl shadow-md flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold">هرکلی {{ auth()->user()->name }} 👋</h3>
                    <p class="text-blue-100">له دې ځایه کولای شې چې ټول سیستم کنټرول کړې — مشتریان، بلونه او میترونه.</p>
                </div>
                <div class="text-7xl opacity-20">🚰</div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-redtext-red-400 p-6 rounded-xl shadow border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase">Customers</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Customer::count() }}</h3>
                        </div>
                        <div class="text-blue-500 text-4xl">👤</div>
                    </div>
                    <a href="{{ route('customers.index') }}" class="text-sm text-blue-600 hover:underline mt-3 inline-block">View Details →</a>
                </div>

                <div class="bg-redtext-red-400 p-6 rounded-xl shadow border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase">Meters</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Meter::count() }}</h3>
                        </div>
                        <div class="text-green-500 text-4xl">📟</div>
                    </div>
                    <a href="{{ route('meters.index') }}" class="text-sm text-green-600 hover:underline mt-3 inline-block">View Details →</a>
                </div>

                <div class="bg-redtext-red-400 p-6 rounded-xl shadow border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase">Bills</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Bill::count() }}</h3>
                        </div>
                        <div class="text-yellow-500 text-4xl">🧾</div>
                    </div>
                    <a href="{{ route('bills.index') }}" class="text-sm text-yellow-600 hover:underline mt-3 inline-block">View Details →</a>
                </div>

                <div class="bg-redtext-red-400 p-6 rounded-xl shadow border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase">Paid Bills</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Bill::where('paid', 1)->count() }}</h3>
                        </div>
                        <div class="text-purple-500 text-4xl">💰</div>
                    </div>
                    <a href="{{ route('bills.index') }}" class="text-sm text-purple-600 hover:underline mt-3 inline-block">View Details →</a>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-redtext-red-400 rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-700">📊 د وروستیو ۶ میاشتو اوبو مصرف او عواید</h3>
                </div>
                <canvas id="usageChart" height="100"></canvas>
            </div>

            <!-- Recent Bills -->
            <div class="bg-redtext-red-400 rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-700">🧾 وروستي بلونه</h3>
                    <a href="{{ route('bills.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                        <thead class="bg-blue-50 text-gray-700 uppercase">
                            <tr>
                                <th class="py-2 px-3 border-b">ID</th>
                                <th class="py-2 px-3 border-b">Customer</th>
                                <th class="py-2 px-3 border-b">Meter</th>
                                <th class="py-2 px-3 border-b">Amount</th>
                                <th class="py-2 px-3 border-b">Status</th>
                                <th class="py-2 px-3 border-b text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Bill::with(['customer','meter'])->latest()->take(5)->get() as $bill)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-3 border-b">{{ $bill->id }}</td>
                                <td class="py-2 px-3 border-b">{{ $bill->customer->name }}</td>
                                <td class="py-2 px-3 border-b">{{ $bill->meter->serial_number ?? '—' }}</td>
                                <td class="py-2 px-3 border-b text-gray-700 font-medium">{{ number_format($bill->amount, 2) }} AFN</td>
                                <td class="py-2 px-3 border-b">
                                    @if(!$bill->paid)
                                        <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">Unpaid</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Paid</span>
                                    @endif
                                </td>
                                <td class="py-2 px-3 border-b text-center">
                                    @if(!$bill->paid)
                                        <a href="{{ route('payment.create', $bill->id) }}" class="text-blue-600 hover:text-blue-800">Pay</a>
                                    @else
                                        <span class="text-gray-500 text-xs">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = ["June", "July", "August", "September", "October", "November"];
        const consumptionData = [120, 150, 130, 160, 180, 200];
        const revenueData = [6000, 7500, 6800, 8000, 9000, 10000];

        const ctx = document.getElementById("usageChart").getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "اوبو مصرف (m³)",
                        data: consumptionData,
                        borderColor: "rgba(59,130,246,0.9)",
                        backgroundColor: "rgba(59,130,246,0.1)",
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: "عواید (AFN)",
                        data: revenueData,
                        borderColor: "rgba(16,185,129,0.9)",
                        backgroundColor: "rgba(16,185,129,0.1)",
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: "index", intersect: false },
                stacked: false,
                plugins: { legend: { position: "bottom" } },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: "Value" }
                    }
                }
            }
        });
    </script>
</x-app-layout>
