<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
    </x-slot>
    <h3>{{ $project->name }}</h3>
    <p>Provider: {{ $project->user->name }}</p>
    <p>{{ $project->description }}</p>
    <p>Team Capacity: {{ $project->capacity }}</p>
    <p>Email: {{ $project->email }}</p>
    <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>
        @foreach ($project->attributes as $attribute)
            {{$attribute->name}}
        @endforeach
    <p><a href="{{ url("project/$project->id/edit") }}">Edit</a></p>
    <form method="POST" action="{{ url("project/$project->id") }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="submit" value="Delete">
    </form>
</x-app-layout>
