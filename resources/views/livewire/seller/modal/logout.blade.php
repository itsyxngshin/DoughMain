  

    <div x-data="{ open: false }">
        <div>
            <a @click="open = true" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5.616 20q-.691 0-1.153-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h6.403v1H5.616q-.231 0-.424.192T5 5.616v12.769q0 .23.192.423t.423.192h6.404v1zm10.846-4.461l-.702-.72l2.319-2.319H9.192v-1h8.887l-2.32-2.32l.702-.718L20 12z"/></svg> Logout</a>
        </div>

        <div x-show="open" x-cloak wire:ignore.self @click.away="open = false" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-5 rounded shadow-md w-1/3 ">
                <p class="text-center">Are you sure you want to Logout?</p>
                <div class="mt-4 flex justify-center gap-2">
                    <div class="flex gap-2">
                        <button @click="open = false" class="bg-gray-300 px-4 py-2 rounded">No</button>
                        <form method="POST" action="{{ route('sellerlogout') }}">
                            @csrf
                            <button type="submit" class="bg-[#51331b] text-white px-4 py-2 rounded">Yes</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 