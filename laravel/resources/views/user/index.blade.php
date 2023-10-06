<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
            {{ __($usertype ?? 'User') }}s
        </h2>
    </x-slot>
    @forelse($users as $user)
        <div>
            <a href="{{ url("student/$user->id") }}">{{ $user->name }}</a><br>
            {{ $user->email }}
        </div>
    @endforeach
</x-app-layout>
