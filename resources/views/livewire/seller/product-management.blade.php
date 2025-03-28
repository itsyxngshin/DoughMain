@extends('layouts.seller')

@section('Product Management')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Product Management</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Example Product Cards -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold">Product 1</h5>
            <p class="text-gray-600">Product description here.</p>
            <div class="mt-4 flex gap-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Edit</button>
                <button class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
            </div>
        </div>
    </div>
@endsection
