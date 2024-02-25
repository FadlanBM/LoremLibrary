@extends('layouts.admin')
@section('content_admin')
    <div class=" w-full p-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Position
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $item)
                            <tr
                                class="bg-white border-b  hover:bg-gray-50 ">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                                    <img class="w-10 h-10 rounded-full"
                                        src="{{ asset('storage/profile/' . $item->avatar) }}" alt="Jese image">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $item->name }}</div>
                                        <div class="font-normal text-gray-500">{{ $item->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ Str::upper($item->role) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                        {{ $item->status ? 'Active' : 'Pasif' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <a x-data="{ tooltip: 'Delete' }" href="#"
                                            x-on:click.prevent="
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'You won t be able to revert this action!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete data!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                     axios.delete(`/employees/admin/destroy/{{ $item->id }}`)
                         .then((response) => {
                        Swal.fire(
                            'Success!',
                            'Delete data successfully.',
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
                            'An error occurred while deleting account.',
                            'error'
                        );
                    });
                }
            });
        ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0)" id="show-user"
                                            data-url="{{ route('employees.show', $item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <p><strong>Name:</strong> <span id="user-name"></span></p>
                <p><strong>Email:</strong> <span id="user-email"></span></p>
                <p><strong>Alamat:</strong> <span id="user-alamat"></span></p>
                <p><strong>Phone:</strong> <span id="user-phone"></span></p>
                <p><strong>Role:</strong> <span id="user-role"></span></p>
                <div class="modal-action  flex justify-end">
                    <form method="dialog">
                        <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    </form>
                    <a onclick="openModal()" class="btn btn-primary ml-2" onclick="saveChanges()">Jadikan Admin</a>
                </div>
            </div>
        </dialog>
    </div>
    <script type="text/javascript">
        let id = 0;
        const modal3 = document.getElementById('my_modal_1');
        $(document).ready(function() {
            $('body').on('click', '#show-user', function() {
                var userURL = $(this).data('url');
                $.get(userURL, function(data) {
                    modal3.showModal();
                    console.log(data);
                    $('#user-name').text(data.name);
                    $('#user-email').text(data.email);
                    $('#user-alamat').text(data.address);
                    $('#user-phone').text(data.phone_number);
                    $('#user-role').text(data.role);
                    id = data.id;
                })
            });
        });

        function openModal() {
            modal3.close();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won t be able to revert this action!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Grant Admin access!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`/employees/access/admin/` + id)
                        .then((response) => {
                            Swal.fire(
                                'Success!',
                                'Grant admin access!.',
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
        }
    </script>
@endsection
