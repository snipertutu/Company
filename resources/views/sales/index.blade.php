<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Penjualan') }}
            </h2>
            <a href="{{ route('sales.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-black uppercase tracking-widest hover:bg-indigo-700 shadow-indigo-100 shadow-lg active:bg-indigo-900 transition ease-in-out duration-150">
                Buka Terminal POS
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex items-center gap-2">
                    <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-black uppercase text-black tracking-tighter">Alur Transaksi Langsung</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white text-gray-400 text-xs uppercase font-black border-b border-gray-50">
                            <tr>
                                <th class="px-6 py-4">ID Transaksi</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Kasir</th>
                                <th class="px-6 py-4 text-right">Total Pendapatan</th>
                                <th class="px-6 py-4 text-center">Struk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($sales as $sale)
                                <tr class="hover:bg-indigo-50/30 transition duration-150 group">
                                    <td class="px-6 py-5 text-sm font-mono text-gray-400">#{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600 font-medium">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase">
                                                {{ substr($sale->user->name, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-bold text-gray-800">{{ $sale->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right font-black text-gray-900">
                                        Rp {{ number_format($sale->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <button class="text-gray-400 hover:text-indigo-600 transition p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="text-gray-300 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-medium italic">Belum ada transaksi. Catat penjualan pertama Anda hari ini!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
