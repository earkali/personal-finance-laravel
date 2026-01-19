<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transactions') }}
            </h2>
            <a href="{{ route('transactions.create') }}" 
               style="background-color: #2563eb !important; color: white !important; display: inline-block !important; padding: 10px 20px !important; border-radius: 8px !important; font-weight: bold !important; border: 1px solid #1d4ed8 !important;"
               class="shadow-md hover:bg-blue-700 transition duration-150">
                + Add New Transaction
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaction->date->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->description }}</td>
                            <td class="px-6 py-4">
                                <span style="background-color: #dbeafe !important; color: #1e40af !important;" class="px-2 py-1 text-xs font-bold rounded-full">
                                    {{ $transaction->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold {{ $transaction->type == 'expense' ? 'text-red-600' : 'text-green-600' }}">
                                {{ $transaction->type == 'expense' ? '-' : '+' }}${{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 flex items-center gap-4">
                                <a href="{{ route('transactions.edit', $transaction) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</a>
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Delete this transaction?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>