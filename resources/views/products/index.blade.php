<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inventori Produk') }}
            </h2>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Tambah Produk
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900 border-b border-gray-100 flex gap-4">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">Daftar Stok Inventori</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-400 tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-right">Harga Jual</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4">Satuan</th>
                                @if(auth()->user()->role === 'admin')
                                <th class="px-6 py-4 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition border-b border-gray-50">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right font-mono font-bold text-indigo-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $product->stock < 10 ? 'bg-red-100 text-red-700 border border-red-200' : 'bg-green-100 text-green-700 border border-green-200' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-tighter">{{ $product->unit }}</td>
                                    @if(auth()->user()->role === 'admin')
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Ubah</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-800 font-bold text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="px-6 py-20 text-center text-gray-400 italic font-medium">Inventori kosong. Silakan tambahkan produk!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
