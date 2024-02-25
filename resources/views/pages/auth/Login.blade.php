@extends('layouts.index')

@section('content')
         <div class="flex justify-center items-center h-screen">
    <div class="m-auto md:w-8/12 lg:w-6/12 xl:w-6/12">
        <div class="rounded-xl bg-white shadow-xl">
            <div class="p-6 sm:p-16">
                <div class="space-y-4">
                    <img src="https://tailus.io/sources/blocks/social/preview/images/icon.svg" loading="lazy" class="w-10" alt="tailus logo" />
                    <h2 class="mb-8 text-2xl text-cyan-900 font-bold">
                        Sign in to unlock the <br />
                        Management Aplication
                    </h2>
                </div>
                <div class="mt-16 grid space-y-4">
                    <button onclick="window.location.href='{{url('/auth/redirect')}}'"
                        class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                        <div class="relative flex items-center space-x-4 justify-center">
                            <img src="https://tailus.io/sources/blocks/social/preview/images/google.svg"
                                class="absolute left-0 w-5" alt="google logo" />
                            <span
                                class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Continue
                                with Google</span>
                        </div>
                    </button>
                </div>

                <div class="mt-32 space-y-4 text-gray-600 text-center sm:-mb-8">
                    <p class="text-xs">
                        By proceeding, you agree to our
                        <a href="#" class="underline">Terms of Use</a> and confirm you
                        have read our
                        <a href="#" class="underline">Privacy and Cookie Statement</a>.
                    </p>
                    <p class="text-xs">
                        This site is protected by reCAPTCHA and the
                        <a href="#" class="underline">Google Privacy Policy</a> and
                        <a href="#" class="underline">Terms of Service</a> apply.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
