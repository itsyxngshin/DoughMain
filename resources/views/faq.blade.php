@extends('layouts.navbar')

@section('content')
<section class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-[#343434] font-poppins text-4xl font-bold text-center leading-normal">Frequently Asked Questions</h2>
    <p class="text-center leading-normal">
        Here are the most frequently asked questions about DoughMain.
    </p>
    <p class="text-center leading-normal">Still need help? <a href="#" class="underline">Reach out to our friendly team!</a></p>

    <div class="mt-6 space-y-2">
        <details class="border-2 border-[#51331B] rounded-[20px] p-5 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-poppins font-semibold leading-normal text-lg">What is DoughMain?</summary>
            <p class="mt-2 font-montserrat font-normal leading-normal">
            DoughMain is an online marketplace that connects customers with local bakeries in Albay. It allows users to browse bakery listings, place orders for delivery or pickup, and discover new baked goods easily.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-5 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-poppins font-semibold leading-normal text-lg">How do I place an order?</summary>
            <p class="mt-2 font-montserrat font-normal leading-normal">
                To place an order, simply browse the bakery menu, select your desired items, and proceed to checkout.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-5 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-poppins font-semibold leading-normal text-lg">What payment methods do you accept?</summary>
            <p class="mt-2 font-montserrat font-normal leading-normal">
                We accept a variety of payment methods, including credit/debit cards, GCash, and Cash on Delivery (COD).
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-5 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-poppins font-semibold leading-normal text-lg">Can I track my order?</summary>
            <p class="mt-2 font-montserrat font-normal leading-normal">
                Yes, you can track the status of your order through the DoughMain platform, providing real-time updates from the moment it is processed until it's out for delivery.
            </p>
        </details>

        <details class="border-2 border-[#51331B] rounded-[20px] p-5 bg-[rgba(81,51,27,0)]">
            <summary class="cursor-pointer font-poppins font-semibold leading-normal text-lg">Where is DoughMain available?</summary>
            <p class="mt-2 font-montserrat font-normal leading-normal">
                DoughMain is currently available in Albay, connecting local bakeries with customers in the area for easy browsing, ordering, and delivery.
            </p>
        </details>
    </div>
</section>

<!-- Contact Form -->
<section class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-[#343434] font-poppins text-4xl font-bold text-center leading-normal">We'd love to help!</h2>
    <p class="text-center text-[#343434] font-poppins leading-normal">Need assistance? Send us a message, and we’ll get back to you as soon as possible.</p>

    <form class="mt-6 space-y-4">
        <label for="name" class="block text-[#343434] font-poppins font-semibold">Name</label>
        <input id="name" type="text" placeholder="Enter your name here" class="w-full p-3 border rounded-lg">

        <label for="email" class="block text-[#343434] font-poppins font-semibold">Email</label>
        <input id="email" type="email" placeholder="Enter your email here" class="w-full p-3 border rounded-lg">

        <label for="message" class="block text-[#343434] font-poppins font-semibold">Message</label>
        <textarea id="message" placeholder="Enter your message here" class="w-full p-3 border rounded-lg"></textarea>

        <button class="w-full bg-[#343434] text-white text-center font-poppins font-bold leading-normal py-3 rounded-lg">Submit</button>
    </form>
</section>
@endsection
