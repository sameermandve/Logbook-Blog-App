@extends('layouts.base')

@section('title', "Logbook | Not Found")

@section("content")
<section class="bg-white mt-20 md:mt-12">
    <div class="py-8 px-4 mx-auto max-w-7xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl font-heading tracking-tight font-extrabold lg:text-9xl text-primary-600">404</h1>
            <p class="mb-4 text-3xl font-heading tracking-tight font-bold text-gray-900 md:text-4xl">Something's missing.</p>
            <p class="mb-4 text-lg font-light text-gray-500">Sorry, we can't find that page. You'll find lots to explore on the home page. </p>
            <a href="{{ route("home") }}" class="inline-flex text-white bg-primary-600 border border-transparent uppercase tracking-wider hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">
                Back to Homepage
            </a>
        </div>
    </div>
</section>
@endsection