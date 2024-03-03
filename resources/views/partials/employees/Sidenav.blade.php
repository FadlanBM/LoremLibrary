<!--sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
        <h2 class="font-bold text-2xl">LOREM <span class="bg-[#f84525] text-white px-2 rounded-md">Perpus</span></h2>
    </a>
    <div class="mt-2">
        <ul class="mt-4">
            <li class=" mb-1 group">
                <a href=""
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
    <ul class="mt-4">
        <span class="text-gray-400 font-bold">Management</span>
        <li class="{{ request()->is('employees/borrowers') ? 'active' : '' }} mb-1 group">
            <a href="{{route('employees.borrowers')}}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-user mr-3 text-lg'></i>
                <span class="text-sm">Peminjam</span>
            </a>
        </li>
        <li class="{{ request()->is('employees/book') ? 'active' : '' }} mb-1 group">
            <a href="{{route('employees.book')}}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bxs-book-content mr-3 text-lg'></i>
                <span class="text-sm">Buku</span>
            </a>
        </li>
        <li class=" {{ request()->is('employees/categories') ? 'active' : '' }} mb-1 group">
            <a href="{{ route('employees.categories') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-category mr-3 text-lg'></i>
                <span class="text-sm">Kategory</span>
            </a>
        </li>
        <li class="{{ request()->is('employees/addlending') ? 'active' : '' }} mb-1 group">
            <a href="{{route('lending.index')}}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-add-to-queue mr-3 text-lg'></i>
                <span class="text-sm">Add Peminjam</span>
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end sidenav -->
