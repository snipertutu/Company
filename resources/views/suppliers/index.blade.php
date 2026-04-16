<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Supplier') }}
            </h2>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                Tambah Supplier
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Nama Supplier</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4">No. Telepon</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $supplier->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $supplier->address ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $supplier->phone ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-4">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-indigo-600 hover:underline font-bold">Ubah</a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Hapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline font-bold">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Data supplier tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
