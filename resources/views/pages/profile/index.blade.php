@extends('layouts.index')
@section('content')
    <style>
        :root {
            --main-color: #4a76a8;
        }

        .bg-main-color {
            background-color: var(--main-color);
        }

        .text-main-color {
            color: var(--main-color);
        }

        .border-main-color {
            border-color: var(--main-color);
        }
    </style>

    <div class="h-screen bg-gray-100">
        <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <ul class="ml-auto flex items-center">
                <li class="dropdown ml-3 relative">
                    <button type="button" class="dropdown-toggle flex items-center focus:outline-none">
                        <div class="flex-shrink-0 w-10 h-10 relative">
                            <div class="p-1 bg-white rounded-full">
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/profile/' . auth()->user()->avatar) }}"
                                    alt="" />
                                <div
                                    class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping">
                                </div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left mr-5">
                            <h2 class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-xs text-gray-500">{{ strtoupper(auth()->user()->role) }}</p>
                        </div>
                    </button>
                    <ul
                        class=" dropdown-menu absolute top-full left-0 mt-1 hidden rounded-md bg-white border border-gray-100 w-full max-w-[140px] z-10">
                        <li>
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.index') : route('employees.index') }}"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">
                                <i class='bx bxs-dashboard mr-2'></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a id="btnLogout" role="menuitem"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer">
                                <i class="ri-login-box-line mr-2"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- end navbar -->

        <div class="container mx-auto my-5 p-5">
            <div class="md:flex no-wrap md:-mx-2 ">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">

                    <!-- Profile Card -->
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <!-- Photo File Input -->
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div class="mt-2" x-show="! photoPreview">
                                <img class="h-auto w-full mx-auto"
                                    src="{{ asset('storage/profile/' . auth()->user()->avatar) }}" alt="">
                            </div>
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block w-40 h-40 rounded-full m-auto shadow"
                                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                    photoPreview + '\');'"
                                    style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                </span>
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ auth()->user()->name }}</h1>
                            <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ strtoupper(auth()->user()->role) }}
                            </h3>
                            <ul
                                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                            class="bg-green-500 py-1 px-2 rounded text-white text-sm">{{ strtoupper(auth()->user()->active ? 'active' : 'pasif') }}</span></span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span
                                        class="ml-auto">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', auth()->user()->created_at)->format('d-m-Y') }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- End of profile card -->
                    <div class="my-4"></div>
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">About</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Nama Lengkap</div>
                                    <div class="px-4 py-2">{{ auth()->user()->name }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email</div>
                                    <a class="text-blue-800" href="mailto:jane@example.com">{{ auth()->user()->email }}</a>

                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Nomor Hp</div>
                                    <div class="px-4 py-2">{{ auth()->user()->phone_number }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Alamat</div>
                                    <div>{{ auth()->user()->address }}</div>
                                </div>
                            </div>
                        </div>
                           <div class="flex items-center mb-3 mt-5">
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                            <p class="mx-4 text-grey-600">Aksi</p>
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                        </div>
                        <button onclick="my_modal_3.showModal()"
                            class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Edit
                            Profile</button>
                        <button x-data="{ tooltip: 'Delete' }"
                            class="block w-full text-red-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4"
                            x-on:click.prevent="
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Delete data!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                        axios.delete(`/auth/profile/delete/{{ auth()->user()->id }}`)
                         .then((response) => {
                        Swal.fire(
                            'Success!',
                            'Account Successfully delete, you must log in again!.',
                            'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                    })
                    .catch((error) => {
                        Swal.fire(
                            'Fail!',
                            'An error occurred while granting access to the account.',
                            'error'
                        );
                    });
            }
        });
    ">
                            Delete Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            document.querySelector('.dropdown-menu').classList.toggle('hidden');
        });
    </script>
    <dialog id="my_modal_3" class="modal">
        <div class="modal-box bg-white">
            <form action="{{route('profile.put', auth()->user()->id)}}" method="POST" class="space-y-4"
                action="#">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Nama Lenngkap</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ auth()->user()->name }}" required />
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">
                        Nomor Hp</label>
                    <input type="text" name="phone" id="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ auth()->user()->phone_number }}" required />
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Alamat</label>
                    <input type="text" name="address" id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ auth()->user()->address }}" required />
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class=" btn btn-outline btn-primary">Update</button>
            </form>
            <form method="dialog">
                <button class="btn ml-2">Close</button>
            </form>
        </div>
        </div>
    </dialog>
<script>
    const modal = document.getElementById('my_modal_3');
        $(document).ready(function() {
            @if ($errors->any())
                modal.showModal();
            @endif
        });
</script>
@endsection
