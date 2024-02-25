@extends('layouts.employees')
@section('content_admin')
    <div class=" w-full p-6">
        <div class="h-[89vh] bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <button class="btn btn-primary" onclick="modalpost.showModal()">open modal +</button>
            <div class="overflow-x-auto mt-10">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name kategory</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <!-- row 1 -->
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="flex justify-end gap-4">

                                        <a x-data="{ tooltip: 'Delete' }" href="#"
                                            x-on:click.prevent="
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda tidak akan dapat mengembalikan tindakan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Delete data!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                     axios.delete(`/employees/categories/delete/{{ $item->id }}`)
                         .then((response) => {
                        Swal.fire(
                            'Berhasil!',
                            'Berhasil delete data.',
                            'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                    })
                    .catch((error) => {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat memberikan akses ke akun.',
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
                                            data-url="{{ route('employees.get', $item->id) }}">
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

                <dialog id="modalpost" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Add Kategory</h3>
                        <form method="post" id="inputField" action="{{ route('employees.categories') }}">
                            @csrf
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Nama Kategory</span>
                                </div>
                                <input type="text" name="name" id="name" placeholder="Type here"
                                    class="input input-bordered w-full" />
                                @error('name')
                                    <small class="mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </label>
                            <div class="modal-action">
                                <button id="myButton" onclick="openModal()" class="btn">Submit</button>
                        </form>
                        <form method="dialog">
                            <button class="btn btn-success" id="closeButton">Close</button>
                        </form>
                    </div>
                </dialog>
            </div>
        </div>
    </div>


    <script>
        const modal = document.getElementById('modalpost');
        const inputElement = document.getElementById('name');
        const buttonElement = document.getElementById('myButton');

        document.getElementById('closeButton').addEventListener('click', function() {
            inputElement.value = "";
        });

        $(document).ready(function() {
            @if ($errors->has('name'))
                modal.showModal();
            @endif
        });

        let id = 0;

        $(document).ready(function() {
            $('body').on('click', '#show-user', function() {
                var userURL = $(this).data('url');
                $.get(userURL, function(data) {
                    modal.showModal();
                    inputElement.value = data.name;
                    id = data.id;
                });
            });
        });

        function openModal() {
            if (id !== 0) {
                buttonElement.type = 'button';
                modal.close();
                var formData = {
                    name: inputElement.value
                };
                axios.put(`/employees/categories/update/${id}`, formData)
                    .then((response) => {
                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Update data!',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    })
                    .catch((error) => {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat memberikan akses ke akun.',
                            'error'
                        );
                    });
            } else {
                buttonElement.type = 'submit';
            }
        }
    </script>

@endsection
