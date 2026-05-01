@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">

            <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="text-sm">Username</label>
                    <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm">Email</label>
                    <input type="email" name="email" class="w-full border px-3 py-2 rounded">
                </div>

                <div class="mb-4">
                    <label class="text-sm">Password</label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-6">
                    <label class="text-sm">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Register
                </button>

                <p class="text-center text-sm mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600">Login</a>
                </p>

            </form>
        </div>
    </div>
@endsection