<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
    </x-slot>
    <h3>{{ $project->name }}</h3>
    <p>Provider: {{ $project->user->name }}</p>
    <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>

    <h4>Apply for this project</h4>
    <form action="{{ url("project/$project->id/apply") }}" method="POST">
        @csrf
        <textarea class="h-full w-full bg-gray-50 outline-none" placeholder="Justification" name="justification">{{ old('justification') }}</textarea>
        <br>
        <x-primary-button class="ml-3">
            {{ __('Apply') }}
        </x-primary-button>
    </form>


</x-app-layout>
