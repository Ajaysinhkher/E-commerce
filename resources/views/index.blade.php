{{-- {{ dd($products->toArray()) }}; --}}

@extends('layouts.app')

@section('content')
<x-hero-banner></x-hero-banner>
{{-- need to pass product image here for hero banner --}}
<!-- Product Grid -->

{{-- dd($products->toArray()); --}}
<x-products :products='$products'></x-products>
<div class="mt-6 flex justify-center">
    {{-- {{ $products->links() }} --}}
</div>
@endsection
