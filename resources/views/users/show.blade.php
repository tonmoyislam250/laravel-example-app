@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                @include('partials.navbar')

                <h1 class="text-4xl text-center my-10">User Details</h1>

                <div class="text-center w-fit m-auto">
                    @if($user)
                        <table class="table-auto border-collapse border border-gray-400 w-full">
                            <thead>
                                <tr class="bg-black">
                                    <th class="p-2 border border-gray-400">Key</th>
                                    <th class="p-2 border border-gray-400">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $value)
                                    <tr class="hover:bg-gray-900">
                                        <td class="p-2 border border-gray-400">{{ ucfirst($key) }}</td>
                                        <td class="p-2 border border-gray-400">
                                            {{-- Handle objects or arrays gracefully --}}
                                            @if (is_array($value) || is_object($value))
                                                {{ json_encode($value) }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>   
                    @else
                        <p class="font-bold text-2xl">No user found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


