@extends('layouts.employees')
@section('content_admin')
    <div class="w-full p-6">
        <div class="max-w-full bg-white rounded-lg overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Informasi Peminjaman</div>
                <p class="text-gray-700 text-base">
                    <span class="font-semibold">Nama Peminjam</span> {{ $borrower->name }}
                </p>
                <p class="text-gray-700 text-base">
                    <span class="font-semibold">Tanggal Pinjam:</span>
                    {{ $dateLast = $lending->borrow_date ? \Carbon\Carbon::parse($lending->borrow_date)->format('d-m-Y') : '-' }}
                </p>
                <p class="text-gray-700 text-base">
                    <span class="font-semibold">Batas Kembali:</span>
                    {{ $dateLast = $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('d-m-Y') : '-' }}
                </p>
                <p class="text-gray-700 text-base">
                    <span class="font-semibold">Tanggal Kembali:</span>
                    {{ $dateLast = $lending->date_last ? \Carbon\Carbon::parse($lending->date_last)->format('d-m-Y') : '-' }}
                </p>
            </div>
            <div class="px-6 py-4">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Buku</th>
                                <th>Kategory</th>
                                <th>Penulis</th>
                                <th>No Inventaris</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBooks as $bk)
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
                                    <td>
                                        {{ $bk->pivot->no_inventaris }}
                                    </td>
                                    <td> {{ $bk->publisher }}
                                    </td>
                                    <td>{{ $bk->year_published }}</td>
                                    <td>
                                        <div class="flex justify-end gap-4">

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-6 py-4">
                <a href="{{ route('lending.index') }}">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                        Back
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
