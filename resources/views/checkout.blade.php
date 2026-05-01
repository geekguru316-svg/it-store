@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Order Summary</h2>
            <div class="space-y-4">
                @foreach($products as $product)
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-12 w-12 bg-white rounded border flex items-center justify-center mr-3">
                             @if($product->image)
                                <img src="{{ asset($product->image) }}" class="h-10 w-10 object-contain">
                             @else
                                <span class="text-xs text-gray-400 font-bold">IT</span>
                             @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">Qty: {{ $quantities[$product->id] ?? 1 }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-gray-900">₱{{ number_format($product->price * ($quantities[$product->id] ?? 1), 2) }}</span>
                </div>
                @endforeach
                
                <div class="flex justify-between text-xl font-black border-t border-gray-200 pt-4 mt-2">
                    <span class="text-gray-700">Total Amount</span>
                    <span class="text-indigo-600">₱{{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6" x-data="{ paymentMethod: 'gcash' }">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 border-b pb-2">Customer Information</h2>
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                
                @isset($id)
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="quantity" value="{{ $qty }}">
                @endisset

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                   class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-bold" 
                                   placeholder="John Doe" required>
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                                   class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-bold" 
                                   placeholder="john@example.com" required>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Select Payment Method</label>
                        <div class="space-y-2">
                            <label class="relative flex items-center p-3 border-2 rounded-xl cursor-pointer hover:shadow-sm transition-all bg-white" :class="paymentMethod === 'gcash' ? 'border-blue-600 bg-blue-50/30' : 'border-gray-100'">
                                <input type="radio" name="payment_method" value="gcash" x-model="paymentMethod" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                                <div class="ml-3">
                                    <span class="block text-xs font-black text-gray-800 uppercase tracking-tighter">GCash (Manual)</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-3 border-2 rounded-xl cursor-pointer hover:shadow-sm transition-all bg-white" :class="paymentMethod === 'maya' ? 'border-emerald-600 bg-emerald-50/30' : 'border-gray-100'">
                                <input type="radio" name="payment_method" value="maya" x-model="paymentMethod" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                <div class="ml-3">
                                    <span class="block text-xs font-black text-gray-800 uppercase tracking-tighter">Maya (Manual)</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-3 border-2 rounded-xl cursor-pointer hover:shadow-sm transition-all bg-white border-dashed" :class="paymentMethod === 'gcash_online' ? 'border-blue-600 bg-blue-50/30' : 'border-gray-100'">
                                <div class="absolute -top-2 -right-2 bg-blue-600 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-widest animate-pulse">Online Verification</div>
                                <input type="radio" name="payment_method" value="gcash_online" x-model="paymentMethod" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="block text-xs font-black text-gray-800 uppercase tracking-tighter">GCash (PayMongo Verified)</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-3 border-2 rounded-xl cursor-pointer hover:shadow-sm transition-all bg-white border-dashed" :class="paymentMethod === 'paymongo' ? 'border-emerald-600 bg-emerald-50/30' : 'border-gray-100'">
                                <input type="radio" name="payment_method" value="paymongo" x-model="paymentMethod" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                                <div class="ml-3">
                                    <span class="block text-xs font-black text-gray-800 uppercase tracking-tighter">Credit Card / Global Web Payments</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Manual Payment Instructions -->
                <div x-show="paymentMethod !== 'paymongo'" class="mb-8 p-6 bg-gray-50 rounded-2xl border-2 border-gray-200 animate-fade-in relative overflow-hidden">
                    <div x-show="paymentMethod === 'gcash'" class="relative z-10 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-blue-600 flex items-center justify-center rounded-lg mr-3 shadow-md">
                                <span class="text-white text-lg font-bold italic">G</span>
                            </div>
                            <p class="font-bold text-blue-600 text-lg uppercase italic tracking-tighter">GCash Payment</p>
                        </div>
                        
                        <div class="space-y-3 bg-white p-4 rounded-xl border border-gray-100 shadow-inner mb-6">
                            <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Send to:</p>
                                <p class="font-black text-gray-900 text-lg tracking-widest underline decoration-blue-500 decoration-2">09123456789</p>
                            </div>
                            <div class="flex justify-between items-center pt-1">
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Account Name:</p>
                                <p class="font-bold text-gray-800 text-sm">IT STORE PH</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Reference Number</label>
                            <input type="text" name="reference" :required="paymentMethod === 'gcash'"
                                   class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:border-blue-500 focus:ring-0 transition-all font-mono text-sm" 
                                   placeholder="1000 234 567890">
                            <p class="text-[9px] text-gray-400 italic">Please copy the reference number from your GCash receipt.</p>
                        </div>
                    </div>

                    <div x-show="paymentMethod === 'maya'" x-cloak class="relative z-10 transition-all duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-emerald-600 flex items-center justify-center rounded-lg mr-3 shadow-md">
                                <span class="text-white text-lg font-bold italic">M</span>
                            </div>
                            <p class="font-bold text-emerald-600 text-lg uppercase italic tracking-tighter">Maya Payment</p>
                        </div>
                        
                        <div class="space-y-3 bg-white p-4 rounded-xl border border-gray-100 shadow-inner mb-6">
                            <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Send to:</p>
                                <p class="font-black text-gray-900 text-lg tracking-widest underline decoration-emerald-500 decoration-2">09234567890</p>
                            </div>
                            <div class="flex justify-between items-center pt-1">
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Account Name:</p>
                                <p class="font-bold text-gray-800 text-sm">IT STORE OFFICIAL</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Reference Number</label>
                            <input type="text" name="reference" :required="paymentMethod === 'maya'"
                                   class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:border-emerald-500 focus:ring-0 transition-all font-mono text-sm" 
                                   placeholder="REF-XXXX-XXXX">
                            <p class="text-[9px] text-gray-400 italic">Please copy the reference number from your Maya details.</p>
                        </div>
                    </div>
                </div>

                <!-- PayMongo Info -->
                <div x-show="paymentMethod === 'paymongo' || paymentMethod === 'gcash_online'" x-cloak class="mb-8 p-8 bg-blue-600 rounded-3xl text-white shadow-xl animate-fade-in relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 text-9xl opacity-10 group-hover:rotate-12 transition-transform">💳</div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-black uppercase italic tracking-tighter mb-2">Secure Online Payment</h3>
                        <p class="text-blue-100 text-sm font-medium leading-relaxed mb-4">You will be redirected securely to <strong class="text-white" x-text="paymentMethod === 'gcash_online' ? 'GCash via PayMongo' : 'the PayMongo portal'"></strong>.</p>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-blue-300 animate-ping"></span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-200">Instant Verification Enabled</span>
                        </div>
                    </div>
                </div>

                <div x-show="paymentMethod !== 'paymongo' && paymentMethod !== 'gcash_online'" class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                    <p class="text-[10px] text-yellow-700 font-bold uppercase tracking-widest">Manual Verification Required</p>
                    <p class="text-[10px] text-yellow-600 italic">Our team will verify your reference number within 1-2 hours.</p>
                </div>

                <button type="submit" id="checkout-button" class="w-full bg-gray-900 text-white py-5 px-6 rounded-2xl hover:bg-blue-600 transition-all duration-300 font-black text-sm uppercase tracking-[0.2em] shadow-2xl active:scale-95 flex items-center justify-center">
                    <span id="button-text">Complete Purchase</span>
                    <span id="loading-spinner" class="hidden ml-3">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('cart.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition-colors group">
                <span class="mr-2 transition-transform group-hover:-translate-x-1">←</span> 
                Back to Cart
            </a>
        </div>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('checkout-button');
        const text = document.getElementById('button-text');
        const spinner = document.getElementById('loading-spinner');
        
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');
        text.textContent = 'Processing Order...';
        spinner.classList.remove('hidden');
    });
</script>
@endsection