@extends('layouts.employees')
@section('content_admin')
    <div class="w-full p-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-start gap-10">
                <div class="mr-5 p-0">
                    <form method="post" action="{{route('lending.input.post')}}" id="inputField2" enctype="multipart/form-data"
                        class="flex justify-start gap-5 items-center flex-wrap">
                        @csrf
                        <!-- Bagian Formulir -->
                        <div class="flex-grow">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                QR Book Peminjaman
                            </label>
                            <div class="flex items-center">
                                <input type="text" id="codeadd" name="codeadd" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <i class='bx bx-qr' id="btn_scan_peminjam" style='font-size: 3em;'></i>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Formulir kedua dan tombol Submit -->
                <div class="mr-5 p-0">
                    <form method="post" action="{{route('lending.return.post')}}" id="inputField2" enctype="multipart/form-data"
                        class="flex justify-start gap-5 items-center flex-wrap">
                        @csrf
                        <!-- Bagian Formulir -->
                        <div class="flex-grow">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                QR Book Pengembalian
                            </label>
                            <div class="flex items-center">
                                <input type="text" id="codereturn" name="codereturn" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <i class='bx bx-qr' id="btn_scan_return" style='font-size: 3em;'></i>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto mt-10">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Rencana Pengembalian</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lendings as $ls)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $borrower->name }}
                                </td>
                                <td>
                                    {{ $dateLast = $ls->borrow_date ? \Carbon\Carbon::parse($ls->borrow_date)->format('d-m-Y') : '-' }}
                                </td>
                                <td>{{ $dateLast = $ls->return_date ? \Carbon\Carbon::parse($ls->return_date)->format('d-m-Y') : '-' }}
                                </td>
                                <td>{{ $dateLast = $ls->date_last ? \Carbon\Carbon::parse($ls->date_last)->format('d-m-Y') : '-' }}
                                <td>{{ $ls->status == 'true' ? 'Active' : 'Not Active' }}
                                <td>
                                    <a href="{{ route('lending.get', $ls->code) }}" id="show-buku">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                                            <circle cx="12" cy="12" r="10" fill="#000000" />
                                            <circle cx="12" cy="12" r="6" fill="#ffffff" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <dialog id="my_modal_pinjam" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Scan QR Ladings!</h3>
            <p class="py-4">Scan the QR Below</p>
            <div id="reader2" width="600px"></div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <dialog id="my_modal_return" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Scan QR Ladings!</h3>
            <p class="py-4">Scan the QR Below</p>
            <div id="reader" width="600px"></div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
        </div>
    </dialog>

    <script>
        var modalQrPeminjam = document.getElementById('my_modal_pinjam');
        var modalQrReturn = document.getElementById('my_modal_return');
        var btn_scan_peminjam = document.getElementById('btn_scan_peminjam');
        var btn_scan_return = document.getElementById('btn_scan_return');
        scanQRCode('reader2');
        scanQRCodeReturn('reader');

        btn_scan_peminjam.addEventListener('click', function() {
            modalQrPeminjam.showModal();
        });

        btn_scan_return.addEventListener('click', function() {
            modalQrReturn.showModal();

        });

        function scanQRCode(readerId) {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                readerId, {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);
                window.location.href = `/employees/show/validasi/lending/${decodedText}`;
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function scanQRCodeReturn(readerId) {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                readerId, {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);
                window.location.href = `/employees/return/lending/${decodedText}`;
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }
    </script>
@endsection
