<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Financial Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Income</div>
                    <div class="mt-2 text-3xl font-bold text-green-600">${{ number_format($totalIncome, 2) }}</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Expense</div>
                    <div class="mt-2 text-3xl font-bold text-red-600">${{ number_format($totalExpense, 2) }}</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Net Balance</div>
                    <div class="mt-2 text-3xl font-bold text-blue-600">${{ number_format($balance, 2) }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Expense Distribution (By Category)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($categoryData as $category)
                            @if($category->transactions_sum_amount > 0)
                                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border border-gray-100 shadow-sm">
                                    <span class="font-semibold text-gray-700">{{ $category->name }}</span>
                                    <span class="font-bold text-red-600">-${{ number_format($category->transactions_sum_amount, 2) }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    @if($categoryData->where('transactions_sum_amount', '>', 0)->isEmpty())
                        <p class="text-gray-500 italic">No expenses have been recorded yet.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in! You can view your expense distribution from the panel above.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>