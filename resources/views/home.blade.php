<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="min-w-screen min-h-screen bg-gray-200 px-5 pb-5 pt-20">

    <div class="flex flex-col">

        <div class="object-cover bg-cover h-52 w-full rounded-t-lg"
             style="background-image: url(https://thumbs.dreamstime.com/z/euro-banknotes-background-background-texture-consisting-euro-banknotes-euro-banknotes-115935373.jpg)">
            <form method="get" action="/actual-currencies">
                <button
                    class=" m-6 uppercase p-3 flex items-center bg-yellow-500 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-16 h-16 ">
                    <svg width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"
                         style="transform: rotate(360deg);">
                        <path
                            d="M26 18A10 10 0 1 1 16 8h6.182l-3.584 3.585L20 13l6-6l-6-6l-1.402 1.414L22.185 6H16a12 12 0 1 0 12 12z"
                            fill="currentColor"></path>
                    </svg>
                </button>
            </form>
        </div>


        <div class="py-8 px-5 bg-white ">
            <div class="-mx-1">
                <form method="post" action="/convert">
                    <ul class="flex w-full flex-wrap items-center h-10">
                        <li class="block relative">
                            <div class="flex">
                                <label class="flex items-center h-10 leading-10 px-4  no-underline text-yellow-900"
                                       for="symbol">Choose symbol</label>
                                <select
                                    class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline transition-colors duration-100 mx-1 bg-yellow-200 text-yellow-900"
                                    name="id" id="symbol">
                                    @foreach( $currencies as $currency)
                                        <option value="{{ $currency['id'] }}"> {{ $currency['symbol'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>

                        <li class="block relative">
                            <div class="flex">
                                <label class="flex items-center h-10 leading-10 px-4  no-underline text-yellow-900"
                                       for="amount">Amount </label>
                                <input
                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="text" name="amount" id="amount">
                            </div>
                        </li>

                        <li class="block relative">
                            <button
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer bg-yellow-200 no-underline hover:no-underline transition-colors duration-100 mx-1 hover:bg-yellow-100 text-yellow-900"
                                type="submit">Calculate
                            </button>
                        </li>
                    </ul>
                </form>

                @if ($errors != null)
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center h-10 leading-10 px-4 no-underline text-red-500">
                        {{ $error }}
                            </div>
                        @endforeach
                @endif

            </div>
        </div>

        @if ($total > 0)
            <div class="py-8 px-8 bg-white rounded-b-lg shadow-xl">
                <p class="flex items-center h-10 leading-10 px-4  no-underline text-xl font-bold text-yellow-900">
                    {{ $amount }} Euros = {{ $total }} {{ $symbol }}
                </p>
                <p class="flex items-center h-10 leading-10 px-4  no-underline text-yellow-900">
                    1 EUR = {{ $rate }} {{ $symbol }}
            </div>
        @endif

    </div>
</div>

</body>
</html>
