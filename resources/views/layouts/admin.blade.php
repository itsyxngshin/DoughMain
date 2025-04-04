<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css']) <!-- Laravel asset management -->
</head>
<body class="bg-gray-50 w-full h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md py-1 px-2 flex justify-between items-center w-full ">
        <div class="flex items-center gap-0">
            <img src="{{ asset('storage/logof.png') }}" alt="Logo" class="w-16 h-16 scale-110">
            <span class="text-xl text-[#51331B] font-bold" >DoughMain</span>
        </div>
        <div class="flex gap-4">
            <button class="flex gap-1 p-2 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(4 2)" stroke-width="1"><path d="m6.5 16.54l.631-.711Q8.205 14.6 9.064 13.49l.473-.624Q12.5 8.875 12.5 6.533C12.5 3.201 9.814.5 6.5.5s-6 2.701-6 6.033q0 2.342 2.963 6.334l.473.624a55 55 0 0 0 2.564 3.05"/><circle cx="6.5" cy="6.5" r="2.5"/></g></svg>
                Location
            </button>
            <button class="p-2 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 18.77v-1h1.616V9.845q0-1.96 1.24-3.447T11 4.546V4q0-.417.291-.708q.291-.292.707-.292t.709.292T13 4v.546q1.904.365 3.144 1.853t1.24 3.447v7.923H19v1zm6.997 2.615q-.668 0-1.14-.475t-.472-1.14h3.23q0 .67-.475 1.142q-.476.472-1.143.472M7.616 17.77h8.769V9.846q0-1.823-1.281-3.104T12 5.462t-3.104 1.28t-1.28 3.104z"/></svg>
            </button>
            
            <button class="p-2 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/><circle cx="12" cy="7" r="3"/></g></svg>
            </button>

        </div>
    </nav>
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white p-4 shadow-md hidden md:block h-screen">
            <ul class="text-[#51331B] space-y-2 space-x-2">
                <li></li>
                <li><a href="{{ route('admin.dashboard') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path stroke-width="0.8" stroke="currentColor" fill="currentColor" d="M13.5 8.183V4.817q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23t-.23-.587M4 11.2V4.8q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23T4 11.2m9.5 8v-6.4q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23t-.23-.57M4 19.183v-3.366q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23T4 19.183M5 11h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/></svg> Dashboard</a></li>
                <li><a href="{{ route('admin.bakery') }}" class="font-semibold block p-2 text-[#51331B] hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A4 4 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6a4 4 0 0 1-1 2.646m-2 1.228a4.01 4.01 0 0 1-4-1.228A4 4 0 0 1 12 13a4 4 0 0 1-3-1.354a3.99 3.99 0 0 1-4 1.228V20h14zM14 9a1 1 0 1 1 2 0a2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0a1 1 0 0 1 2 0a2 2 0 1 0 4 0"/></svg> Bakeries</a></li>
                <li><a href="{{ route('admin.users') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="users-outline"><g fill="currentColor" fill-rule="evenodd" class="Vector" clip-rule="evenodd"><path d="M8.75 9.5a1.75 1.75 0 1 0 0-3.5a1.75 1.75 0 0 0 0 3.5m0 2a3.75 3.75 0 1 0 0-7.5a3.75 3.75 0 0 0 0 7.5m-5.484 3.027c.899-1.249 2.269-2.027 4.02-2.027h3.428c1.752 0 3.121.778 4.02 2.027C15.607 15.74 16 17.339 16 19a1 1 0 1 1-2 0c0-1.377-.33-2.527-.89-3.305c-.533-.742-1.307-1.195-2.396-1.195H7.286c-1.09 0-1.863.453-2.397 1.195C4.33 16.472 4 17.623 4 19a1 1 0 1 1-2 0c0-1.661.393-3.26 1.266-4.473"/><path d="M2 19a1 1 0 0 1 1-1h11.971a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1M14.892 5.867l-.028-.002a2.3 2.3 0 0 1-.445-.07c-.345-.092-.655-.276-.796-.595l-.013-.028c-.208-.47.006-1.033.513-1.12a3.75 3.75 0 1 1 .596 7.448c-.514-.004-.815-.526-.684-1.023l.008-.03c.088-.338.366-.569.69-.714a2.3 2.3 0 0 1 .456-.147a1.887 1.887 0 0 0-.297-3.719M15.5 13.5a1 1 0 0 1 1-1h.214c1.752 0 3.121.778 4.02 2.027C21.607 15.74 22 17.339 22 19a1 1 0 1 1-2 0c0-1.377-.33-2.527-.89-3.305c-.533-.742-1.307-1.195-2.396-1.195H16.5a1 1 0 0 1-1-1"/><path d="M17 19a1 1 0 0 1 1-1h2.971a1 1 0 0 1 0 2H18a1 1 0 0 1-1-1"/></g></g></svg> Users</a></li>
                <li><a href="#" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16m-1-5h2v2h-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1a1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355"/></svg> FAQs</a></li>
                <li><a href="{{ route('admin.chat') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2 22V2h20v16H6zm3.15-6H20V4H4v13.125zM4 16V4zm2-2h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z"/></svg> Chat</a></li>
                <li>@livewire('admin.modal.admin-logout')</li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-6 h-screen overflow-hidden ">
            @yield('content') <!-- This is where child templates will inject content -->
        </div>
    </div>
</body>
</html>
