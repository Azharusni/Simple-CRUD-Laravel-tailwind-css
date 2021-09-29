<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
</head>
<body class="font-sans bg-gray-800 ">
    <nav class="border-b border-gray-500">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row  items-center text-white">
                <li>
                <a href="{{ url('/post') }}" >
                    {{ config('app.name', 'Simple CRUD') }}
                </a>
            </li>

            </ul>

            <div class="flex flex-col md:flex-row items-center text-white">
                <ul class="flex flex-col md:flex-row  items-center">
                    @guest
                        @if (Route::has('login'))
                            <li >
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                                <span class="mx-2"> | </span>
                        @if (Route::has('register'))
                            <li>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    <ul class="flex flex-col md:flex-row  items-center">
                        <li >

                            <div class="flex flex-col md:flex-row  items-center">
                                <a class="flex flex-col md:flex-row  items-center" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    @endguest

                </ul>

                <!-- <div class="md:ml-4 mt-3 md:mt-0">
                        <a href="">
                            <img src="/img/avatar.jpg" alt="avatar" class="rounded-full w-8 h-8">
                        </a>
                </div> -->
            </div>
        </div>
    </nav>

    <!-- mian content -->
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
</body>
</html>
