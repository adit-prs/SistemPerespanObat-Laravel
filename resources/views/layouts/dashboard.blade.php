@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        @include('partials.sidebar')
        @include('partials.navbar')

        <div class="pt-14 sm:ml-64">
            <main class="min-h-screen w-full px-8 py-8">
                <div class="w-full">
                    @yield('page')
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
@endsection