@if($products->isEmpty())
    <div class="p-3 text-gray-500">No results found.</div>
@else
    <ul>
        @foreach($products as $product)
            <li class="p-2 hover:bg-gray-100 border-b">
                <a href="{{ route('product.details', $product->id) }}" class="flex items-center gap-3">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded" alt="{{ $product->name }}">
                    <div>
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-sm text-gray-600">${{ number_format($product->price, 2) }}</div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endif
