<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finansal Özet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Toplam Gelir</div>
                    <div class="mt-2 text-3xl font-bold text-green-600">{{ number_format($totalIncome, 2) }} TL</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Toplam Gider</div>
                    <div class="mt-2 text-3xl font-bold text-red-600">{{ number_format($totalExpense, 2) }} TL</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Net Bakiye</div>
                    <div class="mt-2 text-3xl font-bold text-blue-600">{{ number_format($balance, 2) }} TL</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Başarıyla giriş yaptınız! Yukarıdaki panelden güncel durumunuzu takip edebilirsiniz.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>