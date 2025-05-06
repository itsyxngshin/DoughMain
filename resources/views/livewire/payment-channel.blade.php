@extends('components.layouts.navbar')

@section('content')
<div class="pt-28 px-4 min-h-screen bg-gray-100 flex justify-center">
    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-[#4A2E0F] mb-6 text-center">Payment Details</h2>

        <!-- GCash Number -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Send payment to:</label>
            <div class="bg-gray-100 border border-gray-300 rounded-md px-4 py-2 text-lg text-[#4A2E0F] font-mono">
                0917 123 4567
            </div>
        </div>

        <!-- Form Starts -->
        <form action="{{-- route('payment.submit') --}}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Reference Number -->
            <div>
                <label for="reference" class="block text-gray-700 font-semibold mb-1">GCash Reference Number</label>
                <input type="text" id="reference" name="reference" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4A2E0F]" placeholder="Enter GCash Ref No.">
            </div>

            <!-- Screenshot Upload -->
            <div>
                <label for="screenshot" class="block text-gray-700 font-semibold mb-1">Upload Screenshot of Payment</label>
                <input type="file" id="screenshot" name="screenshot" accept="image/*" class="w-full border border-gray-300 rounded-md p-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-[#4A2E0F] file:text-white hover:file:bg-[#3c2410]">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-[#4A2E0F] text-white px-6 py-2 rounded-md hover:bg-[#3c2410] font-semibold shadow-md">
                    Submit Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
