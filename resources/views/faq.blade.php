@extends('layouts.navbar')

@section('content')
<section class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center">Frequently Asked Questions</h2>
    <p class="text-center text-gray-600">
        Here are the most frequently asked questions about DoughMain.
    </p>
    <p class="text-center text-gray-600">Still need help? <a href="#" class="text-blue-600 underline">Reach out to our friendly team!</a></p>

    <div class="mt-6 space-y-2">
        <details class="border-2 border-[#51331B] rounded-[20px] p-3 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-semibold">What is DoughMain?</summary>
            <p class="mt-2 text-gray-600">
            DoughMain is an online marketplace that connects customers with local bakeries in Albay. It allows users to browse bakery listings, place orders for delivery or pickup, and discover new baked goods easily.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-3 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-semibold">How do I place an order?</summary>
            <p class="mt-2 text-gray-600">
                You can browse the menu, select items, and checkout online.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-3 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-semibold">What payment methods do you accept?</summary>
            <p class="mt-2 text-gray-600">
                We accept credit/debit cards, GCash, and COD.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-3 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-semibold">Can I track my order?</summary>
            <p class="mt-2 text-gray-600">
                We accept credit/debit cards, GCash, and COD.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-3 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-semibold">Where is DoughMain available?</summary>
            <p class="mt-2 text-gray-600">
                We accept credit/debit cards, GCash, and COD.
            </p>
        </details>
    </div>
</section>

<!-- Contact Form -->
<section class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center">We'd love to help!</h2>
    <p class="text-center text-gray-600">Need assistance? Send us a message.</p>

    <form class="mt-6 space-y-4">
        <input type="text" placeholder="Name" class="w-full p-3 border rounded-lg">
        <input type="email" placeholder="Email" class="w-full p-3 border rounded-lg">
        <textarea placeholder="Message" class="w-full p-3 border rounded-lg"></textarea>
        <button class="w-full bg-black text-white py-3 rounded-lg">Submit</button>
    </form>
</section>
@endsection
