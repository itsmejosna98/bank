<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deposite Money
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <form method="POST" enctype="multipart/form-data" action="{{ url('/deposite-amount') }}">
    @csrf
    <label for="amount">Deposit Amount:</label><br>
    <input type="number" required id="amount" name="amount"><br>
    <button type="submit" class="btn btn-primary mr-2">Submit</button>
</form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
