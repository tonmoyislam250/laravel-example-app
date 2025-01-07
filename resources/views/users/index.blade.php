@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                @include('partials.navbar')

                <h1 class="text-4xl text-center my-10">User List</h1>

                <div class="text-center overflow-x-auto mt-10">
                    <table class="w-fit mx-auto border-collapse text-center">
                      <tr class="flex">
                        <th class="p-2">ID</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Email</th>
                      </tr>
                      @foreach($users as $user)
                        <tr class="flex">
                            <td class="p-2"><?= htmlspecialchars($user->id) ?></td>
                            <td class="p-2"><?= htmlspecialchars($user->name) ?></td>
                            <td class="p-2"><?= htmlspecialchars($user->email) ?></td>
                        </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


