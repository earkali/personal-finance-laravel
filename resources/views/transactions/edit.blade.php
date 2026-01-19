<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">İşlemi Düzenle</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <label>Tarih</label>
                        <input type="date" name="date" value="{{ $transaction->date->format('Y-m-d') }}" class="border rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Açıklama</label>
                        <input type="text" name="description" value="{{ $transaction->description }}" class="border rounded w-full">
                    </div>

                    <div class="mb-4">
                        <label>Kategori</label>
                        <select name="category_id" class="border rounded w-full">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Tür</label>
                        <select name="type" class="border rounded w-full">
                            <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Gider</option>
                            <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Gelir</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Tutar</label>
                        <input type="number" step="0.01" name="amount" value="{{ $transaction->amount }}" class="border rounded w-full" required>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>