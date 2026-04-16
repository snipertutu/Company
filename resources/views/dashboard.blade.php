<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Internal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            @if(auth()->user()->role === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 border-b pb-2 mb-4 uppercase tracking-widest">Total Produk</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_products'] }}</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 border-b pb-2 mb-4 uppercase tracking-widest">Total Pendapatan</p>
                    <h3 class="text-3xl font-black text-indigo-600">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 border-b pb-2 mb-4 uppercase tracking-widest">Total Pengeluaran</p>
                    <h3 class="text-3xl font-black text-red-500">Rp {{ number_format($stats['total_purchases'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 border-b pb-2 mb-4 uppercase tracking-widest">Supplier</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stats['total_suppliers'] }}</h3>
                </div>
            </div>
            @else
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-8">
                <h3 class="text-2xl font-bold text-gray-800">Selamat Bekerja, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-600 mt-2">Gunakan menu di bawah untuk melakukan transaksi atau melihat daftar produk.</p>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Sales -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                            <h4 class="font-bold text-gray-800">Penjualan Terakhir</h4>
                            <a href="{{ route('sales.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua</a>
                        </div>
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-xs text-gray-400 uppercase font-bold">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Kasir</th>
                                    <th class="px-6 py-3">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($stats['recent_sales'] as $sale)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $sale->date }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $sale->user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 font-bold">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Belum ada transaksi terakhir.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Shortcuts -->
                <div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                        <h4 class="text-xl font-black text-gray-800 mb-6 border-b border-gray-50 pb-4 uppercase tracking-tighter">Aksi Cepat</h4>
                        <div class="flex flex-col gap-4">
                            <a href="{{ route('sales.create') }}" class="flex items-center justify-between p-4 bg-indigo-50 hover:bg-indigo-600 text-indigo-900 hover:text-white rounded-xl transition-all duration-300 group border border-indigo-100 shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-indigo-600 text-white rounded-lg group-hover:bg-white group-hover:text-indigo-600 transition-colors shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h.01"/><path d="M15 14h.01"/><path d="M9 18h.01"/><path d="M15 18h.01"/></svg>
                                    </div>
                                    <span class="font-bold">Penjualan Baru</span>
                                </div>
                                <span class="bg-indigo-100 text-indigo-700 group-hover:bg-white/20 group-hover:text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter transition-colors">POS</span>
                            </a>

                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('purchases.create') }}" class="flex items-center justify-between p-4 bg-emerald-50 hover:bg-emerald-600 text-emerald-900 hover:text-white rounded-xl transition-all duration-300 group border border-emerald-100 shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-emerald-600 text-white rounded-lg group-hover:bg-white group-hover:text-emerald-600 transition-colors shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.4-1.4 1"/><path d="m15 9-3-3-3 3"/><path d="M12 6v12"/><path d="M12 2a10 10 0 1 0 10 10"/></svg>
                                    </div>
                                    <span class="font-bold">Stok Masuk</span>
                                </div>
                                <span class="bg-emerald-100 text-emerald-700 group-hover:bg-white/20 group-hover:text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter transition-colors">BELI</span>
                            </a>

                            <a href="{{ route('products.create') }}" class="flex items-center justify-between p-4 bg-amber-50 hover:bg-amber-600 text-amber-900 hover:text-white rounded-xl transition-all duration-300 group border border-amber-100 shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-amber-600 text-white rounded-lg group-hover:bg-white group-hover:text-amber-600 transition-colors shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                                    </div>
                                    <span class="font-bold">Kelola Inventori</span>
                                </div>
                                <span class="bg-amber-100 text-amber-700 group-hover:bg-white/20 group-hover:text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter transition-colors">STOK</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
