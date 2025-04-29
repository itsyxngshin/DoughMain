<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Admin Dashboard', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css']) <!-- Laravel asset management -->
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 w-full h-screen">
    <div>
        <!-- Navbar -->
    <nav class="bg-white shadow-md py-1 px-2 flex justify-between items-center fixed top-0 left-0 w-full z-50">
        <div class="flex items-center gap-0">
            <!-- Burger Button -->
            <button id="burger" class="p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                </svg>
            </button>

            <img src="{{ asset('storage/doughmainLogo.png') }}" alt="Logo" class="w-12 h-12 mx-3 my-2 scale-100">
            <span class="text-xl text-[#51331B] font-bold">DoughMain</span>
        </div>

        <div class="flex gap-4 -translate-x-8">
            <!-- Location Button -->
            <button class="flex gap-1 p-2 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 21">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(4 2)" stroke-width="1">
                        <path d="m6.5 16.54l.631-.711Q8.205 14.6 9.064 13.49l.473-.624Q12.5 8.875 12.5 6.533C12.5 3.201 9.814.5 6.5.5s-6 2.701-6 6.033q0 2.342 2.963 6.334l.473.624a55 55 0 0 0 2.564 3.05"/>
                        <circle cx="6.5" cy="6.5" r="2.5"/>
                    </g>
                </svg>
                Location
            </button>

            <!-- Notification Button -->
            <div class="relative">
                <button id="notifButton" class="p-2 bg-transparent relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 18.77v-1h1.616V9.845q0-1.96 1.24-3.447T11 4.546V4q0-.417.291-.708q.291-.292.707-.292t.709.292T13 4v.546q1.904.365 3.144 1.853t1.24 3.447v7.923H19v1zm6.997 2.615q-.668 0-1.14-.475t-.472-1.14h3.23q0 .67-.475 1.142q-.476.472-1.143.472M7.616 17.77h8.769V9.846q0-1.823-1.281-3.104T12 5.462t-3.104 1.28t-1.28 3.104z"/>
                    </svg>
                    <span id="notifBadge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full hidden">0</span>
                </button>

                <!-- Notification Dropdown -->
                <div id="notifDropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg hidden">
                    <div class="p-3 border-b font-semibold text-gray-800">Notifications</div>
                    <div id="notifList" class="max-h-60 overflow-y-auto">
                        <p class="p-3 text-gray-500 text-sm">No new notifications</p>
                    </div>
                    <button id="clearNotif" class="w-full text-center py-2 text-blue-500 font-semibold hover:bg-gray-100">Clear All</button>
                </div>
            </div>

            <!-- Cart Button -->
            <a href="cart">
            <button class="p-2 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/>
                </svg>
            </button>
            </a>

            <!--<a href="userprofile">
                <button class="p-2 bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/>
                            <circle cx="12" cy="7" r="3"/>
                        </g>
                    </svg>
                </button>
            </a>-->

        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-white h-screen p-10 mt-12 shadow-md fixed left-0 top-0 h-full transition-all duration-300">
            <ul class="text-[#51331B] space-y-3">

            <li><a href="{{ route('admin.dashboard') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path stroke-width="0.8" stroke="currentColor" fill="currentColor" d="M13.5 8.183V4.817q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23t-.23-.587M4 11.2V4.8q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23T4 11.2m9.5 8v-6.4q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23t-.23-.57M4 19.183v-3.366q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23T4 19.183M5 11h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/></svg> Dashboard</a></li>
                <li><a href="{{ route('admin.bakery') }}" class="font-semibold block p-2 text-[#51331B] hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A4 4 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6a4 4 0 0 1-1 2.646m-2 1.228a4.01 4.01 0 0 1-4-1.228A4 4 0 0 1 12 13a4 4 0 0 1-3-1.354a3.99 3.99 0 0 1-4 1.228V20h14zM14 9a1 1 0 1 1 2 0a2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0a1 1 0 0 1 2 0a2 2 0 1 0 4 0"/></svg> Bakeries</a></li>
                <li><a href="{{ route('admin.users') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="users-outline"><g fill="currentColor" fill-rule="evenodd" class="Vector" clip-rule="evenodd"><path d="M8.75 9.5a1.75 1.75 0 1 0 0-3.5a1.75 1.75 0 0 0 0 3.5m0 2a3.75 3.75 0 1 0 0-7.5a3.75 3.75 0 0 0 0 7.5m-5.484 3.027c.899-1.249 2.269-2.027 4.02-2.027h3.428c1.752 0 3.121.778 4.02 2.027C15.607 15.74 16 17.339 16 19a1 1 0 1 1-2 0c0-1.377-.33-2.527-.89-3.305c-.533-.742-1.307-1.195-2.396-1.195H7.286c-1.09 0-1.863.453-2.397 1.195C4.33 16.472 4 17.623 4 19a1 1 0 1 1-2 0c0-1.661.393-3.26 1.266-4.473"/><path d="M2 19a1 1 0 0 1 1-1h11.971a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1M14.892 5.867l-.028-.002a2.3 2.3 0 0 1-.445-.07c-.345-.092-.655-.276-.796-.595l-.013-.028c-.208-.47.006-1.033.513-1.12a3.75 3.75 0 1 1 .596 7.448c-.514-.004-.815-.526-.684-1.023l.008-.03c.088-.338.366-.569.69-.714a2.3 2.3 0 0 1 .456-.147a1.887 1.887 0 0 0-.297-3.719M15.5 13.5a1 1 0 0 1 1-1h.214c1.752 0 3.121.778 4.02 2.027C21.607 15.74 22 17.339 22 19a1 1 0 1 1-2 0c0-1.377-.33-2.527-.89-3.305c-.533-.742-1.307-1.195-2.396-1.195H16.5a1 1 0 0 1-1-1"/><path d="M17 19a1 1 0 0 1 1-1h2.971a1 1 0 0 1 0 2H18a1 1 0 0 1-1-1"/></g></g></svg> Users</a></li>
                <li><a href="#" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16m-1-5h2v2h-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1a1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355"/></svg> FAQs</a></li>
                <li><a href="{{ route('admin.chat') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2 22V2h20v16H6zm3.15-6H20V4H4v13.125zM4 16V4zm2-2h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z"/></svg> Chat</a></li>
                <li>@livewire('admin.modal.admin-logout')</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 pt-20 ml-64">
            @yield('content')
        </div>
    </div>
    <!--
    <div class="flex h-screen">
        
        <div class="w-64 bg-white p-4 shadow-md hidden md:block h-screen">
            <ul class="text-[#51331B] space-y-2 space-x-2">
                <li></li>
                <li><a href="{{ route('sellerdashboard') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path stroke-width="0.8" stroke="currentColor" fill="currentColor" d="M13.5 8.183V4.817q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23t-.23-.587M4 11.2V4.8q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23T4 11.2m9.5 8v-6.4q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23t-.23-.57M4 19.183v-3.366q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23T4 19.183M5 11h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/></svg> Dashboard</a></li>
                <li><a href="{{ route('productmanagement') }}" class="font-semibold block p-2 text-[#51331B] hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.298 9.566H4.702a1.96 1.96 0 0 0-1.535.744a1.94 1.94 0 0 0-.363 1.66l1.565 6.408a3.9 3.9 0 0 0 1.4 2.072c.682.519 1.517.8 2.376.8h7.708c.859 0 1.694-.281 2.376-.8a3.9 3.9 0 0 0 1.4-2.072l1.565-6.407a1.94 1.94 0 0 0-1.044-2.208a2 2 0 0 0-.854-.197M8.087 13.46v3.895M12 13.46v3.895m3.913-3.895v3.895m2.935-7.789a6.8 6.8 0 0 0-2.006-4.82A6.86 6.86 0 0 0 12 2.75a6.86 6.86 0 0 0-4.842 1.996a6.8 6.8 0 0 0-2.005 4.82"/></svg> Products</a></li>
                <li><a href="{{ route('ordermanagement') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/></svg> Orders</a></li>
                <li><a href="{{ route('transactionmanagement') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" d="M10.5 10a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zM1 5.5A2.5 2.5 0 0 1 3.5 3h9A2.5 2.5 0 0 1 15 5.5v5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 10.5zM14 6v-.5A1.5 1.5 0 0 0 12.5 4h-9A1.5 1.5 0 0 0 2 5.5V6zM2 7v3.5A1.5 1.5 0 0 0 3.5 12h9a1.5 1.5 0 0 0 1.5-1.5V7z"/></svg> Transactions</a></li>
                <li><a href="{{ route('sellerchat') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2 22V2h20v16H6zm3.15-6H20V4H4v13.125zM4 16V4zm2-2h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z"/></svg> Chat</a></li>
                <li>@livewire('seller.modal.logout')</li>
            </ul>
        </div>

        <div class="flex-1 p-6 h-screen overflow-hidden ">
            
        </div>
    </div>
-->
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

        // 🔔 Notification Functionality
        document.addEventListener("DOMContentLoaded", function () {
            const notifButton = document.getElementById("notifButton");
            const notifDropdown = document.getElementById("notifDropdown");
            const notifBadge = document.getElementById("notifBadge");
            const notifList = document.getElementById("notifList");
            const clearNotif = document.getElementById("clearNotif");

            let notifications = [
                { id: 1, text: "New order received!", time: "2 min ago" },
                { id: 2, text: "Payment completed successfully.", time: "10 min ago" }
            ];

            function updateNotifications() {
                notifList.innerHTML = notifications.length === 0
                    ? '<p class="p-3 text-gray-500 text-sm">No new notifications</p>'
                    : notifications.map(notif => `<div class="p-3 border-b hover:bg-gray-100">${notif.text} <br><small>${notif.time}</small></div>`).join("");
                notifBadge.textContent = notifications.length;
                notifBadge.classList.toggle("hidden", notifications.length === 0);
            }

            notifButton.addEventListener("click", () => notifDropdown.classList.toggle("hidden"));
            clearNotif.addEventListener("click", () => { notifications = []; updateNotifications(); });

            updateNotifications();
        });
    </script>

    </div><!-- Navbar -->
    


</body>
</html>

