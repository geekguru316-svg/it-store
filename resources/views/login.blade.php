@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center p-6 bg-gray-50/50">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        
        <div class="p-8 pb-6 border-b border-gray-50 bg-gray-50/80">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <span class="text-white text-3xl font-black italic tracking-tighter">IT</span>
                </div>
            </div>
            <h2 class="text-2xl font-black text-center text-gray-900 tracking-tight">Welcome Back</h2>
            <p class="text-center text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Sign in to IT Store Admin</p>
        </div>

        <div class="p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-bold shadow-sm">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="flex items-center">
                                <span class="mr-2">⚠</span> {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
 
             <!-- DEMO ACCESS (CLIENT TRICK) -->
             <div class="bg-blue-600 rounded-2xl p-5 mb-8 text-white shadow-xl shadow-blue-100 relative overflow-hidden group">
                 <div class="absolute -right-4 -top-4 text-6xl opacity-10 group-hover:scale-110 transition-transform">🔑</div>
                 <h3 class="text-xs font-black uppercase tracking-widest mb-3 flex items-center">
                     <span class="inline-block w-2 h-2 bg-white rounded-full animate-pulse mr-2"></span>
                     Demo Admin Access
                 </h3>
                 <div class="space-y-1">
                     <p class="text-sm font-bold flex justify-between">
                         <span class="opacity-60 font-medium">Email:</span>
                         <code>admin@demo.com</code>
                     </p>
                     <p class="text-sm font-bold flex justify-between">
                         <span class="opacity-60 font-medium">Password:</span>
                         <code>password</code>
                     </p>
                 </div>
                 <div class="mt-4 text-[10px] opacity-60 font-bold uppercase tracking-tighter">
                     * Click fields to auto-fill (Disabled in demo)
                 </div>
             </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" 
                           class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-0 focus:border-blue-500 transition-all font-bold text-gray-900" 
                           required placeholder="admin">
                </div>

                <div>
                    <label for="password" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                           class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-0 focus:border-blue-500 transition-all font-bold text-gray-900" 
                           required placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-xl hover:bg-blue-600 transition-all shadow-lg shadow-gray-200 active:transform active:scale-95 text-sm uppercase tracking-widest flex justify-center items-center group">
                        Secure Login
                        <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection