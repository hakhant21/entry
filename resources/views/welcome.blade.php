<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles / Scripts -->
    </head>
    <body>
        <div class="container mx-auto">
            <div class="mt-4">
                <form action="{{ route('upload') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="file">Old Mongodb Sales Json File</label>
                    <input type="file" name='file' class="mb-4 w-1/3 py-2 px-4 rounded-lg border border-gray-200">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
            <div class="mt-4">
                <form action="{{ route('fuelin') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="file">Old Mongodb FuelIns Json File</label>
                    <input type="file" name='file' class="mb-4 w-1/3 py-2 px-4 rounded-lg border border-gray-200">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
             <div class="mt-4">
                <form action="{{ route('sales') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="sales">New FMS Data with Tank Balance</label>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>
