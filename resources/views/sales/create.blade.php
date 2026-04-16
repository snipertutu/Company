<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terminal Penjualan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Transaction Form -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <form action="{{ route('sales.store') }}" method="POST" id="posForm">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-black uppercase text-gray-700 mb-2 tracking-widest">Tanggal Transaksi</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-black uppercase text-gray-700 mb-2 tracking-widest">Pilih Produk</label>
                                <select name="product_id" id="product_id" class="w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                            {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }}) - Stok: {{ $product->stock }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-700 mb-2 tracking-widest">Jumlah (Kuantitas)</label>
                                    <input type="number" name="quantity" id="quantity" min="1" value="1" class="w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-700 mb-2 tracking-widest">Jumlah Bayar (Tunai)</label>
                                    <input type="number" name="pay" id="pay" step="0.01" class="w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Masukkan jumlah uang" required>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-50">
                                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-black uppercase tracking-widest shadow-lg shadow-indigo-100 transition duration-150">
                                    Proses Transaksi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Live Summary -->
                <div class="bg-white rounded-2xl shadow-xl p-10 border-2 border-indigo-100 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-8 border-b border-gray-100 pb-4">
                            <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
                            <h4 class="text-sm font-black uppercase text-gray-800 tracking-widest">Ringkasan Penjualan</h4>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <span class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Subtotal Tagihan</span>
                                <span class="text-3xl font-black text-indigo-700" id="summaryTotal">Rp 0</span>
                            </div>

                            <div class="flex justify-between items-center p-4">
                                <span class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">Uang Dibayarkan</span>
                                <span class="text-2xl font-black text-gray-800" id="summaryPay">Rp 0</span>
                            </div>

                            <div class="pt-6 border-t-2 border-dashed border-gray-100">
                                <div class="flex flex-col items-center justify-center bg-emerald-50 p-8 rounded-2xl border-2 border-emerald-100 shadow-inner">
                                    <span class="text-emerald-700 font-black uppercase text-xs mb-4 tracking-[0.2em]">Total Kembalian</span>
                                    <span class="text-6xl font-black text-emerald-600 mb-2" id="summaryChange">Rp 0</span>
                                    <div class="h-1 w-20 bg-emerald-200 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center gap-3 p-4 bg-amber-50 rounded-xl border border-amber-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <p class="text-[10px] text-amber-800 font-bold uppercase tracking-tight">Periksa nominal bayar sebelum memproses transaksi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const payInput = document.getElementById('pay');
        const summaryTotal = document.getElementById('summaryTotal');
        const summaryPay = document.getElementById('summaryPay');
        const summaryChange = document.getElementById('summaryChange');

        function updateSummary() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption ? parseFloat(selectedOption.dataset.price || 0) : 0;
            const quantity = parseInt(quantityInput.value || 0);
            const total = price * quantity;
            const pay = parseFloat(payInput.value || 0);
            const change = pay - total;

            summaryTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
            summaryPay.innerText = 'Rp ' + pay.toLocaleString('id-ID');
            summaryChange.innerText = change >= 0 ? 'Rp ' + change.toLocaleString('id-ID') : 'Rp 0';
        }

        productSelect.addEventListener('change', updateSummary);
        quantityInput.addEventListener('input', updateSummary);
        payInput.addEventListener('input', updateSummary);
    </script>
</x-app-layout>
