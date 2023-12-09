<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Statement Money
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction) { ?>
            <tr>
                <td style="text-align: center;">{{$transaction->created_at->format('Y-m-d')}}</td>
                <td style="text-align: center;">{{$transaction->amount}}</td>
                <td style="text-align: center;">{{$transaction->type}}</td>
                <td style="text-align: center;">{{$transaction->details}}</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
