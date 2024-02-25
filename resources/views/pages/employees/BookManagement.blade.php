@extends('layouts.employees')
@section('content_admin')
    <div class=" w-full p-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <button class="btn btn-primary mb-10" onclick="modalpost.showModal()">open modal</button>
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Buku</th>
                            <th>Kategory</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($book as $bk)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                <img src="{{ asset('storage/sampul/' . $bk->img) }}"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold"> {{ $bk->title }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ implode(', ', $bk->categories->pluck('name')->toArray()) }}

                                </td>
                                <td>
                                    {{ $bk->author }}
                                </td>
                                <td> {{ $bk->publisher }}
                                </td>
                                <td>{{ $bk->year_published }}</td>
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
                     axios.delete(`/employees/book/delete/{{ $bk->id }}`)
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
                                        <a href="{{route('book.show',$bk->id)}}" id="show-buku" onclick="my_modal_1.showModal()">
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
    </div>

    <dialog id="modalpost" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Input Data Buku!</h3>
            <form method="post" action="" id="inputField" enctype="multipart/form-data">
                @csrf
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Judul Buku</span>
                    </div>
                    <input type="text" name="title" id="title" class="input input-bordered w-full" required />
                    @error('title')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Penulis</span>
                    </div>
                    <input type="text" name="author" id="author" class="input input-bordered w-full" required />
                    @error('author')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Penerbit</span>
                    </div>
                    <input type="text" name="publisher" id="publisher" class="input input-bordered w-full" required />
                    @error('publisher')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">No Inventaris</span>
                    </div>
                    <input type="text" name="no_inventaris" id="no_inventaris" class="input input-bordered w-full"
                        required />
                    @error('no_inventaris')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Description</span>
                    </div>
                    <input type="text" name="description" id="description" class="input input-bordered w-full"
                        required />
                    @error('description')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Tahun Terbit</span>
                    </div>
                    <input type="text" name="year_published" id="year_published" class="input input-bordered w-full"
                        required />
                    @error('year_published')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <label class="form-control w-full mt-3">
                    <div class="label">
                        <span class="label-text">QR Book</span>
                    </div>
                    <div class="flex items-center" id="item_qr">
                        <input type="text" id="inputcode" name="inputcode"
                            class=" input input-bordered flex-grow mr-2" />
                        <input type="hidden" id="code" name="code" />
                        <i class='bx bx-qr' id="btn_scan" style='font-size: 3em;'></i>
                    </div>
                    <div id="reader" width="600px"></div>
                    <a class="link link-success" id="btn_back">Back</a>
                    @error('code')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </label>
                <div class="mt-1 ">
                    <div class="label">
                        <span class="label-text">
                            Kategori Buku
                        </span>
                    </div>
                    @foreach ($category as $item)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" class="form-checkbox" name="items[]" value="{{ $item->id }}">
                            <span class="ml-2">{{ $item->name }}</span>
                        </label>
                    @endforeach
                    @error('items')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label class="form-control w-full mt-4">
                    <input type="file" id="img" name="img" class="file-input file-input-bordered w-full"
                        accept="image/jpeg, image/png" />
                    @error('img')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <img id="previewImage" src="" alt="Preview Image" class="mt-2">
                </label>
                <div class="modal-action">
                    <button class="btn btn-accent" type="submit">Submit</button>
            </form>
            <form method="dialog">
                <button class="btn" id="closeButton">Close</button>
            </form>
        </div>
        </div>
    </dialog>
    <script>
        var title = document.getElementById("title");
        var author = document.getElementById("author");
        var publisher = document.getElementById("publisher");
        var no_inventaris = document.getElementById("no_inventaris");
        var description = document.getElementById("description");
        var year_published = document.getElementById("year_published");

        var modal = document.getElementById('modalpost');
        var previewImage_Post = document.getElementById('previewImage');
        var inputImage_post = document.getElementById('img');
        var inputcode = document.getElementById("inputcode");
        var reader = document.getElementById("reader");
        var item_qr = document.getElementById("item_qr");
        var btn_scan = document.getElementById("btn_scan");
        var btn_back = document.getElementById("btn_back");
        var code = document.getElementById("code");
        previewImage_Post.classList.add('hidden');
        readerHide()

        document.getElementById('closeButton').addEventListener('click', function() {
            inputImage_post.value = '';
            previewImage_Post.classList.add('hidden');
            readerHide()
            clearformqr()

            title.value = "";
            author.value = "";
            publisher.value = "";
            no_inventaris.value = "";
            description.value = "";
            year_published.value = "";
        });

        btn_scan.addEventListener('click', function() {
            clearqr();
        });

        btn_back.addEventListener('click', function() {
            readerHide()
        });

        inputImage_post.addEventListener('change', function(event_post) {
            var file = event_post.target.files[0];
            if (file) {
                previewImage_Post.src = URL.createObjectURL(event_post.target.files[0]);
                previewImage_Post.classList.remove('hidden');
            } else {
                previewImage_Post.classList.add('hidden');
            }
        });

        function onScanSuccess(decodedText, decodedResult) {
            inputcode.value = decodedText;
            code.value = decodedText;
            readerHide()
            inputcode.disabled = true;
        }

        function onScanFailure(error) {
            clearqr();
        }

        // Buat instance Html5QrcodeScanner
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);

        // Render Html5QrcodeScanner
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        function clearqr() {
            item_qr.classList.add('hidden');
            inputcode.value = "";
            code.value = "";
            reader.style.display = 'block';
            btn_back.classList.remove('hidden');
        }

        function readerHide() {
            item_qr.classList.remove('hidden');
            reader.style.display = 'none';
            btn_back.classList.add('hidden');
            inputcode.disabled = false;
        }

        function clearformqr() {
            inputcode.value = "";
            code.value = "";
        }

        $(document).ready(function() {
            @if ($errors->any())
                modal.showModal();
            @endif
        });
    </script>
@endsection
