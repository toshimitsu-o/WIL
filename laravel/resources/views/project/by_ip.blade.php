<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
    </x-slot>
    <h3 class="text-xl">{{ $ip->name }}</h3>
    <p>Email: {{ $ip->email }}</p>
    <div class="space-x-2">
        @foreach ($projects as $project)
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h4><a href="{{ url("project/$project->id") }}">{{ $project->name }}</a></h4>
                <p>{{ $project->description }}</p>
                <p>Team Capacity: {{ $project->capacity }}</p>
                <p>Email: {{ $project->email }}</p>
                <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
