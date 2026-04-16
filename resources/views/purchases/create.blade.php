<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Purchase Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 max-w-2xl mx-auto">
                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">Supplier</label>
                            <select name="supplier_id" class="w-full border-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                                <option value="">-- Select Provider --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">Date</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                        </div>

                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <h3 class="text-xs font-black uppercase text-gray-400 mb-4 tracking-widest">Item Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Product</label>
                                    <select name="product_id" class="w-full border-gray-200 rounded-lg text-sm" required>
                                        <option value="">-- Select Product --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} (Unit: {{ $product->unit }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Quantity</label>
                                        <input type="number" name="quantity" min="1" value="1" class="w-full border-gray-200 rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Unit Price Bought</label>
                                        <input type="number" name="price_bought" step="0.01" class="w-full border-gray-200 rounded-lg text-sm" placeholder="Cost per unit" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-50">
                            <button type="submit" class="w-full py-4 bg-indigo-900 hover:bg-black text-white rounded-xl font-black uppercase tracking-widest shadow-lg shadow-gray-100 transition duration-150">
                                Confirm & Update Stock
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
