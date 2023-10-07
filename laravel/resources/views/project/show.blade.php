<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-700 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <x-slot name="actions">
        @if (Auth::user()->usertype === 'ip' && !is_null(Auth::user()->approved_at))
            <x-link-button :href="url('project/create')">
                {{ __('Create') }}
            </x-link-button>
        @endif
    </x-slot>
    <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
    <h3 class="pb-2 text-xl font-semibold text-gray-600">PROJECT: {{ $project->name }}</h3>
    <div class="my-5 rounded-2xl bg-white p-5">
    <p>Provided by <a href="{{ url("project/provider/{$project->user->id}")}} ">{{ $project->user->name }}</a></p>
    <p>{{ $project->description }}</p>
    <p>Team Capacity: {{ $project->capacity }}</p>
    <p>Email: {{ $project->email }}</p>
    <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>
    
    <!-- Attributes -->
    @foreach ($project->attributes as $attribute)
        {{ $attribute->name }}
    @endforeach
    </div>
    @if (Auth::user()->usertype === 'student')
        <x-link-button :href="url('project/' . $project->id . '/apply')">
            {{ __('Apply') }}
        </x-link-button>
    @endif

    <!-- Applications -->
    <h4>Aplications ({{ count($project->applications) }})</h4>
    @foreach ($project->applications as $application)
        <div class="my-5">
            {{ $application->user->name }} <br>
            Justification: {{ $application->justification }}
        </div>
    @endforeach

    <!-- Allocations -->
    <h4>Student Assignment ({{ count($project->allocations) }})</h4>
    @foreach ($project->allocations as $allocation)
        <div class="my-5">
            {{ $allocation->user->name }} (GPA: {{ $application->user->gpa }})<br>
            Attributes:
            @foreach ($application->user->attributes as $attribute)
                {{ $attribute->name }}, 
            @endforeach
        </div>
    @endforeach

    @if (Auth::user()->id === $project->user_id)
    <div class="flex mt-5">
        <div class="grow text-right"> </div>
        <x-link-button :href="url('project/' . $project->id . '/edit')">
            {{ __('Edit') }}
        </x-link-button>

        <form method="POST" action="{{ url("project/$project->id") }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <x-danger-button class="ml-3">
                {{ __('Delete') }}
            </x-danger-button>
        </form>
    </div>
    @endif
    </div>
</x-app-layout>
