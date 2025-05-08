<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DoughMain')</title>
  
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Laravel asset management -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
     body {
      font-family: 'Montserrat', sans-serif;
      font-weight: 400;
      font-size: 15px;
    }

    #sidebar {
    background-color: #ffff;
    transform: translateX(-100%);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    z-index: 40;
  }

  #sidebar.show {
    transform: translateX(0);
    box-shadow: 8px 0 24px rgba(0, 0, 0, 0.1);
  }

  #sidebarBackdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(3px);
    z-index: 30;
    display: none;
  }

  #sidebarBackdrop.show {
    display: block;
  }

  /* Main Content Area */
  #mainContent {
    transition: margin-left 0.4s ease;
  }

  .ml-64 {
    margin-left: 16rem; /* for desktop layout */
  }

  /* Mobile Styles */
  @media screen and (max-width: 768px) {
    /* Sidebar for mobile */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 40;
      transform: translateX(-100%);
      transition: transform 0.3s ease;
    }

    #sidebar.show {
      transform: translateX(0);
    }

    #sidebarBackdrop.show {
      display: block;
    }

    #mainContent {
      margin-left: 0;
    }

    .ml-64 {
      margin-left: 0; /* No sidebar margin on mobile */
    }

    #sidebar a {
      padding: 10px 15px;
      font-size: 16px;
    }

    .burger {
      display: block;
      
    }
  }

  /* Hide sidebar items on mobile by default */
  @media screen and (max-width: 768px) {
    #sidebar {
      display: none;
    }

    #sidebar.show {
      display: block;
    }


    img:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease;
      filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.15));
    }

    button:active {
      transform: scale(0.97);
      transition: transform 0.1s ease;
    }

    .shadow-modern {
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
      border-radius: 0.75rem;
      transition: box-shadow 0.3s ease;
    }

    .cart-profile{
      margin-right: 5px;
      gap: 2px;
    }
    
    .burger-position{
      margin-left: 3px;
    }

    @keyframes fadeSlideIn {
      0% {
        opacity: 0;
        transform: translateY(10px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .flex-1 > * {
      animation: fadeSlideIn 0.6s ease-out forwards;
    }

    /* Hide scrollbar for all elements using .no-scrollbar */
    .no-scrollbar::-webkit-scrollbar {
    display: none;
    }
    .no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;     /* Firefox */
    }
    
  .border-brown-800 {
    border-color: #51331B;
  }
  }
  
    </style>
    <style>
        .scrollable-container::-webkit-scrollbar {
        width: 6px;
        }
        .scrollable-container::-webkit-scrollbar-thumb {
        background-color:rgba(193, 193, 193, 0); /* Tailwind's orange-500 */
        border-radius: 10px;
        }
        .scrollable-container::-webkit-scrollbar-track {
        background-color:rgba(243, 244, 246, 0); /* Tailwind's gray-100 */
        }

        .scrollable-container {
        scrollbar-width: thin;
        scrollbar-color:rgba(218, 216, 216, 0.39) #f3f4f6;
        }
        </style>
    @livewireStyles
</head>

<body class="bg-gray-50">
<div>
    <!-- Sidebar Backdrop -->
    <div id="sidebarBackdrop"></div>

    <!-- Navbar -->
    <nav id="navbar" class="bg-white shadow-md py-1 px-2 flex justify-between items-center fixed top-0 left-0 w-full z-50">
        <div class="flex items-center burger-position gap-0 ml-8">
            <!-- Burger Button -->
            <button id="burger" class="p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                </svg>
            </button>

            <img src="{{ asset('storage/doughmainLogo.png') }}" alt="Logo" class="w-12 h-12 mx-3 my-2 scale-100">
            <span class="text-xl text-[#51331B] font-bold">DoughMain</span>
        </div>

        <div class="cart-profile flex flex-row flex-nowrap items-center gap-4 mr-10">
            <!-- Cart Button -->
            <a href="{{ route('user.cart') }}">
            <button class="p-2 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/>
                </svg>
            </button>
            </a>

            <a href="{{ route('profile') }}">
                <button class="p-2 bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/>
                            <circle cx="12" cy="7" r="3"/>
                        </g>
                    </svg>
                </button>
            </a>

        </div>
    </nav>

    <div id="sidebar" class="w-64 bg-white h-full p-10 mt-12 shadow-md fixed left-0 top-0 h-full transition-all duration-300">
    <ul class="text-[#51331B] space-y-3">
        <li><a href="{{ route('homepage') }}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path stroke-width="0.8" stroke="currentColor" fill="currentColor" d="M13.5 8.183V4.817q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23t-.23-.587M4 11.2V4.8q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23T4 11.2m9.5 8v-6.4q0-.34.234-.57t.58-.23h4.88q.347 0 .576.23t.23.57v6.4q0 .34-.234.57t-.58.23h-4.88q-.346 0-.576-.23t-.23-.57M4 19.183v-3.366q0-.357.234-.587t.58-.23h4.88q.347 0 .576.23t.23.587v3.366q0 .358-.234.587q-.234.23-.58.23h-4.88q-.346 0-.576-.23T4 19.183M5 11h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/></svg> Homepage</a></li>
        <li><a href="{{ route('my.orders')}}" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5 19V8.1L3.242 4.234l.916-.426L6.084 8.05h11.832l1.926-4.242l.916.427L19 8.1V19zm5-6.5h4q.213 0 .356-.144t.144-.357t-.144-.356T14 11.5h-4q-.213 0-.356.144t-.144.357t.144.356t.356.143M6 18h12V9.05H6zm0 0V9.05z"/></svg> Orders</a></li>
        <li>
            <form method="POST" action="{{ route('userlogout') }}" class="inline">
                @csrf
                <button type="submit" class="block p-2 text-[#51331B] font-semibold hover:bg-[#F8E3B6] rounded flex gap-1 items-center w-full text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" stroke-width="0.8" stroke="currentColor" d="M5.616 20q-.691 0-1.153-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h6.403v1H5.616q-.231 0-.424.192T5 5.616v12.769q0 .23.192.423t.423.192h6.404v1zm10.846-4.461l-.702-.72l2.319-2.319H9.192v-1h8.887l-2.32-2.32l.702-.718L20 12z"/>
                    </svg>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- Mobile Burger Menu -->
<button id="burger" class="p-2 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
    </svg>
</button>

        <!-- Main Content -->
        <div class="flex-1 ml-0 transition-all h-screen duration-300" id="mainContent">
            @yield('content')
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        //This code will run when the DOM is loaded, even if images and other resources are still loading.
        const navbar = document.getElementById('navbar');
        //Check if the navbar exists before doing anything else with it.
        if(navbar){
            navbar.classList.remove('hidden');
        } else {
            console.warn("Navbar element not found");
        }
    });

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

    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const mainContent = document.getElementById('mainContent');

    burger.addEventListener('click', () => {
        const isOpen = sidebar.classList.toggle('show');
        sidebarBackdrop.classList.toggle('show');
        mainContent.classList.toggle('ml-64', isOpen);
        mainContent.classList.toggle('blur-sm', isOpen);
    });

    sidebarBackdrop.addEventListener('click', () => {
        sidebar.classList.remove('show');
        sidebarBackdrop.classList.remove('show');
        mainContent.classList.remove('ml-64');
        mainContent.classList.remove('blur-sm');
    });

    </script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
