@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter sm:text-5xl">Track Your Order</h1>
        <p class="mt-4 text-gray-500 font-medium italic">Enter your Order ID to see real-time updates on your package.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8 sm:p-12">
            <form action="{{ route('track-order') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-blue-600 font-bold">#</span>
                    <input type="text" name="order_id" value="{{ request('order_id') }}" placeholder="Enter Order ID" 
                           class="w-full pl-8 pr-4 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-blue-500 focus:ring-0 transition-all font-bold text-lg border-blue-100">
                </div>
                <button type="submit" class="px-10 py-4 bg-blue-600 text-white font-black rounded-2xl uppercase tracking-widest text-sm hover:bg-gray-900 transition-all shadow-lg active:scale-95 whitespace-nowrap">
                    Track
                </button>
            </form>

            @if(request('order_id'))
                @php
                    $order = \App\Models\Order::find(request('order_id'));
                @endphp

                @if($order)
                    <div class="mt-12 animate-fade-in">
                        <!-- STATUS PROGRESS BAR -->
                        <div class="mb-12">
                            <div class="relative flex items-center justify-between">
                                <div class="absolute inset-0 top-1/2 -translate-y-1/2 h-1 bg-gray-100 w-full z-0"></div>
                                <div class="absolute inset-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 z-0 transition-all duration-1000" style="width: {{ $currentStatusIndex > 0 ? ($currentStatusIndex / (count($statuses) - 1)) * 100 : 0 }}%"></div>
                                @php
                                    $statusLabels = [
                                        'processing' => 'Processing',
                                        'shipped' => 'Shipped',
                                        'out_for_delivery' => 'Out',
                                        'delivered' => 'Delivered'
                                    ];
                                    $statuses = array_keys($statusLabels);
                                    $currentStatusIndex = array_search($order->shipping_status, $statuses);
                                    if($currentStatusIndex === false) $currentStatusIndex = 0;
                                @endphp
                                
                                @foreach($statuses as $index => $status)
                                    @php
                                        $isPast = $index < $currentStatusIndex;
                                        $isCurrent = $index === $currentStatusIndex;
                                        $isFuture = $index > $currentStatusIndex;
                                        
                                        $circleClass = $isPast ? 'bg-blue-600 border-blue-600 text-white' : 
                                                       ($isCurrent ? 'bg-white border-blue-600 text-blue-600 shadow-lg shadow-blue-200' : 'bg-white border-gray-200 text-gray-300');
                                        
                                        $textClass = $isPast ? 'text-blue-600 font-medium' : 
                                                     ($isCurrent ? 'text-blue-600 font-black scale-110' : 'text-gray-300 font-medium');
                                    @endphp
                                    
                                    <div class="relative z-10 flex flex-col items-center">
                                        <div class="h-10 w-10 flex items-center justify-center rounded-full border-4 transition-all duration-500 {{ $circleClass }}">
                                            @if($isPast)
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($isCurrent)
                                                <span class="h-3 w-3 bg-blue-600 rounded-full animate-pulse"></span>
                                            @else
                                                <span class="text-xs font-black uppercase">{{ substr($statusLabels[$status], 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <span class="mt-3 text-[10px] uppercase tracking-widest transition-all duration-300 {{ $textClass }}">{{ $statusLabels[$status] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- ORDER DETAILS CARD -->
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                                <span class="text-6xl font-black">📦</span>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 relative z-10">
                                <div>
                                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Customer Info</h3>
                                    <p class="font-bold text-gray-900 text-lg">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-500 italic">{{ $order->customer_email }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Order Status</h3>
                                    <div class="flex flex-col items-start gap-1">
                                        <div class="flex items-center">
                                            <span class="h-3 w-3 rounded-full bg-blue-600 animate-pulse mr-2"></span>
                                            <span class="font-black text-blue-600 uppercase italic tracking-tighter text-xl">{{ strtoupper($statusLabels[$order->shipping_status] ?? $order->shipping_status) }}</span>
                                        </div>
                                        @if($order->tracking_number)
                                            <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs font-bold font-mono">TN: {{ $order->tracking_number }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="sm:col-span-2 pt-4 border-t border-gray-200">
                                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Items Summary</h3>
                                    <div class="space-y-3">
                                        @foreach(json_decode($order->items, true) as $item)
                                            <div class="flex justify-between items-center text-sm">
                                                <div class="flex items-center">
                                                    <span class="text-gray-400 mr-2 font-mono">x{{ $item['quantity'] }}</span>
                                                    <span class="font-bold text-gray-800">{{ $item['name'] }}</span>
                                                </div>
                                                <span class="font-black text-gray-900">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-between items-center mt-6 pt-4 border-t-2 border-dashed border-gray-200">
                                        <span class="text-sm font-black text-gray-400 uppercase">Total Paid</span>
                                        <span class="text-2xl font-black text-blue-600 italic tracking-tighter">₱{{ number_format($order->total, 2) }}</span>
                                    </div>
                                    @if($order->payment_method)
                                        <div class="mt-4 flex items-center gap-2">
                                            <span class="text-[10px] bg-gray-200 text-gray-600 px-2 py-0.5 rounded uppercase font-black tracking-widest">{{ $order->payment_method }}</span>
                                            @if($order->reference)
                                                <span class="text-[10px] text-gray-400 italic">Ref: {{ $order->reference }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 text-center text-gray-400 text-xs italic">
                            Order placed on {{ $order->created_at->format('M d, Y h:i A') }}
                        </div>

                    </div>
                @else
                    <div class="mt-12 text-center p-12 bg-red-50 rounded-3xl border-2 border-dashed border-red-100">
                        <span class="text-4xl mb-4 inline-block">🔍</span>
                        <p class="font-bold text-red-600">Order not found.</p>
                        <p class="text-red-400 text-sm mt-1">Please double-check your Order ID and try again.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Help Section -->
    <div class="mt-12 text-center animate-fade-in-up">
        <p class="text-gray-400 text-sm font-medium">Need more help? <a href="#" class="text-blue-600 underline font-bold">Contact Support</a></p>
    </div>
</div>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
</style>
@endsection
