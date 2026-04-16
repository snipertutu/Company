<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Pembelian') }}
            </h2>
            <a href="{{ route('purchases.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-900 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-black shadow-lg shadow-gray-100 transition ease-in-out duration-150">
                Catat Pembelian Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 bg-gray-50/30 border-b border-gray-100">
                    <span class="text-xs font-black uppercase text-black tracking-widest">Riwayat Stok Masuk</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white text-gray-400 text-xs uppercase font-black border-b border-gray-50">
                            <tr>
                                <th class="px-6 py-4">ID Ref</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Supplier</th>
                                <th class="px-6 py-4 text-right">Total Biaya</th>
                                <th class="px-6 py-4 text-center">Dikelola Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($purchases as $purchase)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-5 text-sm font-mono text-gray-400">#P{{ str_pad($purchase->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600 font-medium">{{ \Carbon\Carbon::parse($purchase->date)->format('d M Y') }}</td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm font-bold text-gray-800 uppercase tracking-tighter">{{ $purchase->supplier->name }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-right font-black text-gray-900">
                                        Rp {{ number_format($purchase->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-3 py-1 bg-gray-100 rounded text-[10px] font-black text-gray-500 uppercase">{{ $purchase->user->name }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic font-medium">Belum ada riwayat pembelian stok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
