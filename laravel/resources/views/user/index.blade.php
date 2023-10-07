<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold capitalize leading-tight text-indigo-700">
            {{ __($usertype ?? 'User') }}s
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        @forelse($users as $user)
            <div class="m-5 rounded-2xl bg-white p-5">
                <a href="{{ url("student/$user->id") }}">{{ $user->name }}</a><br>
                {{ $user->email }}
            </div>
        @endforeach
        {{ $users->links() }}
    </div>
</x-app-layout>
