<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
    </x-slot>
    @forelse($projects as $project)
        <p><a href="{{ url("project/$project->id") }}">{{ $project->name }} by {{ $project->user->name }}</a> <a
                href="{{ url("project/$project->id") }}/edit">Edit</a></p>
    @endforeach
    <a href="create">Create</a>
</x-app-layout>
