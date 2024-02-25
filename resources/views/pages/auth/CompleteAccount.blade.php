@extends('layouts.index')

@section('content')
    <div class="container items-center px-5 py-12 lg:px-20 mx-auto">
        <form method="POST" action="{{ route('complete.account.post', $data->id) }}"
            class="flex flex-col w-full p-10 px-8 pt-6 mx-auto my-6 mb-4 transition duration-500 ease-in-out transform bg-white border rounded-lg lg:w-1/2 ">
            @csrf
            @method('PUT')
            <div class="relative pt-4">
                <label for="phone_number" class="text-base leading-7 text-blueGray-500">Full Name</label>
                <input type="text" id="name" value="{{ $data->name }}" name="name"
                    class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform rounded-lg bg-gray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                @error('name')
                    <small class="mt-2 text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="relative pt-4">
                <label for="phone_number" class="text-base leading-7 text-blueGray-500">Phone Number</label>
                <input type="text" id="phone_number" value="{{ $data->phone }}" name="phone_number"
                    class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform rounded-lg bg-gray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                @error('phone_number')
                    <small class="mt-2 text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex flex-wrap mt-4 mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="text-base leading-7 text-blueGray-500" for="address">Address</label>
                    <textarea
                        class="w-full h-32 px-4 py-2 mt-2 text-base text-blueGray-500 transition duration-500 ease-in-out transform bg-white border rounded-lg focus:border-blue-500 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 appearance-none autoexpand"
                        id="address" name="address" required="">{{ $data->address }}</textarea>
                </div>
                @error('address')
                    <small class="mt-2 text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex items-center w-full pt-4 mb-4">
                <button
                    class="w-full py-3 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800 ">
                    Submit </button>
            </div>
        </form>
    </div>
    </div>
@endsection
