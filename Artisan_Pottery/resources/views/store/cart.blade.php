@extends('layouts.client.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Shopping Cart</h1>

    @if(count($cart) > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Cart Items -->
            @foreach($cart as $id => $item)
                <div class="flex justify-between items-center mb-4 pb-4 border-b">
                    <div class="flex items-center">
                        @if(isset($item['image_path']) && $item['image_path'])
                            <img src="{{ asset('storage/' . $item['image_path']) }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                        
                        <div class="ml-4">
                            <h3 class="font-medium">{{ $item['name'] }}</h3>
                            <div class="text-sm text-gray-600">
                                @if($item['discount'])
                                    <span class="line-through">${{ number_format($item['price'], 2) }}</span>
                                    <span class="text-amber-600 ml-2">${{ number_format($item['total_price'], 2) }}</span>
                                @else
                                    <span>${{ number_format($item['price'], 2) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center border rounded-lg mr-4">
                            <button onclick="updateQuantity({{ $id }}, 'decrease')" 
                                    class="px-3 py-1 border-r hover:bg-gray-100">
                                -
                            </button>
                            <span class="px-4 py-1">{{ $item['quantity'] }}</span>
                            <button onclick="updateQuantity({{ $id }}, 'increase')" 
                                    class="px-3 py-1 border-l hover:bg-gray-100">
                                +
                            </button>
                        </div>
                        <span class="font-medium w-24 text-right">${{ number_format($item['total'], 2) }}</span>
                        <button onclick="removeItem({{ $id }})" 
                                class="ml-4 text-red-500 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach

            <!-- Cart Summary -->
            <div class="mt-8">
                <div class="flex justify-between mb-2">
                    <span>Subtotal:</span>
                    <span>${{ $total }}</span>
                </div>
                <div class="flex justify-between mb-2 text-sm text-gray-600">
                    <span>Shipping:</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="flex justify-between font-semibold text-lg mt-4 pt-4 border-t">
                    <span>Total:</span>
                    <span>${{ $total }}</span>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('shop') }}" 
                       class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300">
                        Continue Shopping
                    </a>
                    <button onclick="proceedToCheckout()" 
                            class="bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-gray-400 text-5xl mb-4"></i>
            <h2 class="text-2xl font-medium text-gray-600 mb-4">Your cart is empty</h2>
            <a href="{{ route('shop') }}" 
               class="bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 inline-block">
                Start Shopping
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function updateQuantity(productId, action) {
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ action: action })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Failed to update quantity', 'error');
        });
    }

    function removeItem(productId) {
        if (confirm('Are you sure you want to remove this item?')) {
            fetch(`/cart/remove/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to remove item', 'error');
            });
        }
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } text-white z-50`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endpush
@endsection