<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __($usertype ?? 'User') }}
        </h2>
    </x-slot>
    <h3>{{ $user->name }}</h3>
    <p>Email: {{ $user->email }}</p>
    <p>GPA: {{ $user->gpa ?? 'n/a' }}</p>
    @foreach ($user->attributes as $attribute)
        {{ $attribute->name }}
    @endforeach
    
</x-app-layout>