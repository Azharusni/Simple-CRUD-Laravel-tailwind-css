@extends('layouts.app', ['title' => ' Login'])

@section('content')

<!-- component -->

<form method="POST" action="{{ route('login') }}">
    @csrf
<div class="bg-white lg:w-4/12 md:6/12 w-10/12 m-auto my-10 shadow-md">
    <div class="py-8 px-8 rounded-xl">
        <h1 class="font-medium text-2xl mt-3 text-center">Login</h1>
        <form action="" class="mt-6">
            <div class="my-5 text-sm">
                <label for="email" class="block text-black">Email</label>
                <input type="text" autofocus id="email" name="email" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="email" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="my-5 text-sm">
                <label for="password" class="block text-black">Password</label>
                <input type="password" id="password" name="password" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Password" />
                <div class="flex justify-end mt-2 text-xs text-gray-600">
                   <a href="{{ route('password.request') }}" class="hover:text-black">Forget Password?</a>
                </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <button class="block text-center text-white bg-gray-800 p-3 duration-300 rounded-sm hover:bg-black w-full" type="submit">Login</button>
        </form>



        <p class="mt-12 text-xs text-center font-light text-gray-400"> Don't have an account? <a href="{{ route('register') }}" class="text-black font-medium"> Create One </a>  </p>

    </div>
</div>
</form>
@endsection
