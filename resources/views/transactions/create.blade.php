<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yeni İşlem Ekle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tarih</label>
                        <input type="date" name="date" class="border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
                        <input type="text" name="description" class="border rounded w-full py-2 px-3 text-gray-700" placeholder="Örn: Market alışverişi">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <select name="category_id" class="border rounded w-full py-2 px-3 text-gray-700" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tür</label>
                        <select name="type" class="border rounded w-full py-2 px-3 text-gray-700">
                            <option value="expense">Gider</option>
                            <option value="income">Gelir</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tutar</label>
                        <input type="number" step="0.01" name="amount" class="border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kaydet
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>