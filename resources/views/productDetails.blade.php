    {{-- <x-nav-link></x-nav-link> --}}

    @extends('layouts.app')
    @section('content')
    <x-product-details-card  :product="$product"></x-product-details-card>

    @endsection