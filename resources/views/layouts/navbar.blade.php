<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DoughMain')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css']) <!-- Laravel asset management -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-1 px-2 flex justify-between items-center fixed top-0 left-0 w-full z-50">
        <div class="flex items-center gap-0">
            <!-- Burger Button -->
            <button id="burger" class="p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                </svg>
            </button>

            <img src="{{ asset('storage/logof.png') }}" alt="Logo" class="w-16 h-16 scale-110">
            <span class="text-xl text-[#51331B] font-bold">DoughMain</span>
        </div>

        <!-- Search Bar -->
        <div class="relative w-96">
            <input type="text" placeholder="Search by product, categories..." class="w-full p-2 pl-10 pr-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#51331B]">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 w-5 h-5 text-gray-500" viewBox="0 0 24 24">
                <path fill="currentColor" d="M10 2a8 8 0 1 1-5.3 14.1l-4.2 4.2a1 1 0 0 1-1.4-1.4l4.2-4.2A8 8 0 0 1 10 2zm0 2a6 6 0 1 0 4.2 10.2a6 6 0 0 0-4.2-10.2z"/>
            </svg>
        </div>

        <div class="flex gap-4 -translate-x-8">
    <button class="flex gap-1 p-2 bg-transparent">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 21">
            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(4 2)" stroke-width="1">
                <path d="m6.5 16.54l.631-.711Q8.205 14.6 9.064 13.49l.473-.624Q12.5 8.875 12.5 6.533C12.5 3.201 9.814.5 6.5.5s-6 2.701-6 6.033q0 2.342 2.963 6.334l.473.624a55 55 0 0 0 2.564 3.05"/>
                <circle cx="6.5" cy="6.5" r="2.5"/>
            </g>
        </svg>
        Location
    </button>

    <button class="p-2 bg-transparent">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="M5 18.77v-1h1.616V9.845q0-1.96 1.24-3.447T11 4.546V4q0-.417.291-.708q.291-.292.707-.292t.709.292T13 4v.546q1.904.365 3.144 1.853t1.24 3.447v7.923H19v1zm6.997 2.615q-.668 0-1.14-.475t-.472-1.14h3.23q0 .67-.475 1.142q-.476.472-1.143.472M7.616 17.77h8.769V9.846q0-1.823-1.281-3.104T12 5.462t-3.104 1.28t-1.28 3.104z"/>
        </svg>
    </button>

    <button class="p-2 bg-transparent">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
            <path fill="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/>
        </svg>
    </button>

    <button class="p-2 bg-transparent">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/>
                <circle cx="12" cy="7" r="3"/>
            </g>
        </svg>
    </button>
</div>

    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-white h-screen p-10 mt-12 shadow-md fixed left-0 top-0 h-full transition-all duration-300">
            <ul class="text-[#51331B] space-y-3">
            <li><a href="{{ route('admin.dashboard') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path stroke-width="0.8" stroke="currentColor" fill="currentColor" d="M13.5 8.183V4.817q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23t-.23-.587M4 11.2V4.8q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23T4 11.2m9.5 8v-6.4q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23t-.23-.57M4 19.183v-3.366q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23T4 19.183M5 11h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/></svg> Homepage</a></li>
                <li><a href="#" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/></svg> Orders</a></li>
                <li><a href="#" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" d="M10.5 10a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zM1 5.5A2.5 2.5 0 0 1 3.5 3h9A2.5 2.5 0 0 1 15 5.5v5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 10.5zM14 6v-.5A1.5 1.5 0 0 0 12.5 4h-9A1.5 1.5 0 0 0 2 5.5V6zM2 7v3.5A1.5 1.5 0 0 0 3.5 12h9a1.5 1.5 0 0 0 1.5-1.5V7z"/></svg> Payments</a></li>
                <li><a href="#" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5.616 20q-.691 0-1.153-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h6.403v1H5.616q-.231 0-.424.192T5 5.616v12.769q0 .23.192.423t.423.192h6.404v1zm10.846-4.461l-.702-.72l2.319-2.319H9.192v-1h8.887l-2.32-2.32l.702-.718L20 12z"/></svg> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 pt-20 ml-64">
            @yield('content')
        </div>
    </div>

    <script>
         window.onload = function () {
            document.getElementById('navbar').classList.remove('hidden');
        };

        document.getElementById('burger').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.flex-1');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.add('ml-64');
            } else {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64');
            }
        });
</script>

</body>
</html>
