<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - UKM PROTIC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    #adminSidebar,
    .sidebar-text,
    .sidebar-logo-container,
    .sidebar-link-justify {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-collapsed {
        width: 88px !important;
    }

    .sidebar-collapsed .sidebar-text {
        opacity: 0;
        max-width: 0;
        display: none !important;
    }

    .sidebar-collapsed .sidebar-link-justify {
        justify-content: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        width: 50px;
        margin: 0 auto;
    }

    .sidebar-collapsed .sidebar-logo-container .sidebar-justify-center {
        justify-content: center !important;
        padding: 0 !important;
    }

    .sidebar-collapsed #iconKas {
        display: none !important;
    }

    #adminSidebar {
        overflow-x: hidden;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .custom-scroll::-webkit-scrollbar { width: 8px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #0a362d; border-radius: 10px; }

    .force-uppercase { text-transform: uppercase !important; }
</style></head>
<body class="bg-[#f8faf9] flex h-screen overflow-hidden">

    @include('admin.partials.sidebar')

    <div class="flex-grow flex flex-col min-w-0 overflow-hidden">

        @include('admin.partials.navbar')

        <main class="flex-grow overflow-y-auto p-10 custom-scroll bg-[#fcfcfc]">
            <div class="max-w-7xl mx-auto animate-in fade-in duration-500">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('sidebar-collapsed');
        }

        function toggleAccount(event) {
            event.stopPropagation();
            const drop = document.getElementById('accountDropdown');
            const chevron = document.getElementById('chevronAccount');

            if (drop.classList.contains('hidden')) {
                drop.classList.remove('hidden');
                setTimeout(() => {
                    drop.classList.remove('opacity-0', 'scale-95');
                    drop.classList.add('opacity-100', 'scale-100');
                }, 10);
                chevron.style.transform = "rotate(180deg)";
            } else {
                closeAccountDropdown();
            }
        }

        function closeAccountDropdown() {
            const drop = document.getElementById('accountDropdown');
            const chevron = document.getElementById('chevronAccount');
            if (drop && !drop.classList.contains('hidden')) {
                drop.classList.remove('opacity-100', 'scale-100');
                drop.classList.add('opacity-0', 'scale-95');
                setTimeout(() => { drop.classList.add('hidden'); }, 200);
                chevron.style.transform = "rotate(0deg)";
            }
        }

        window.addEventListener('click', function(event) {
            const container = document.getElementById('dropdownContainer');
            if (container && !container.contains(event.target)) {
                closeAccountDropdown();
            }
        });

        function toggleDropdown(id) {
            const sidebar = document.getElementById('adminSidebar');
            if (sidebar.classList.contains('sidebar-collapsed')) return;
            const drop = document.getElementById(id);
            if(drop) drop.classList.toggle('hidden');
            const icon = document.getElementById('iconKas');
            if(icon) icon.classList.toggle('rotate-180');
        }
    </script>
</body>
</html>
