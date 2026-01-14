@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-900 text-gray-100">
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow p-6">
            <h1 class="text-xl font-semibold mb-4 text-center">Login</h1>
            <form class="max-w-sm mx-auto" method="POST" action="{{route('login.attempt')}}">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Masukan email</label>
                    <input type="email" id="email" name="email"
                           class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                           placeholder="name@email.com" required/>
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Masukan password</label>
                    <input type="password" id="password" name="password"
                           class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                           placeholder="••••••••" required/>
                </div>
                <button type="submit"
                        class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                    Submit
                </button>
            </form>
        </div>
    </div>
@endsection