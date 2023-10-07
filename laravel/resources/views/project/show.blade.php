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
    <!-- Attributes -->
    @foreach ($project->attributes as $attribute)
        {{ $attribute->name }}
    @endforeach

    @if (Auth::user()->usertype === 'student')
        <x-link-button :href="url('project/' . $project->id . '/apply')">
            {{ __('Apply') }}
        </x-link-button>
    @endif

    <!-- Applications -->
    <p>Aplications for this project ({{ count($project->applications) }})</p>
    @foreach ($project->applications as $application)
        <div class="my-5">
            Applicant: {{ $application->user->name }} <br>
            Justification: {{ $application->justification }}
        </div>
    @endforeach

    <!-- Allocations -->
    <p>Student Assignment for this project ({{ count($project->allocations) }})</p>
    @foreach ($project->allocations as $allocation)
        <div class="my-5">
            Student: {{ $allocation->user->name }} <br>
            GPA: {{ $application->user->gpa }}
            Attributes: {{ $application->user->attributes }}
            @foreach ($application->user->attributes as $attribute)
                {{ $attribute->name }}
            @endforeach
        </div>
    @endforeach

    @if (Auth::user()->id === $project->user_id)
        <x-link-button :href="url('project/' . $project->id . '/edit')">
            {{ __('Edit') }}
        </x-link-button>

        <form method="POST" action="{{ url("project/$project->id") }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <x-danger-button class="ml-3">
                {{ __('Delete Project') }}
            </x-danger-button>
        </form>
    @endif

</x-app-layout>
