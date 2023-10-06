<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
        @if (Auth::user()->usertype === 'ip' && !is_null(Auth::user()->approved_at))
            <x-link-button :href="url('project/create')">
                {{ __('Create') }}
            </x-link-button>
        @endif
    </x-slot>
    @forelse($offer_years as $year)
        @forelse($offer_trimesters as $trimester)
            @forelse($projects->where('offer_year', $year->offer_year)->where('offer_trimester', $trimester->offer_trimester) as $project)
                @if ($project->offer_year == $year->offer_year && $project->offer_trimester == $trimester->offer_trimester)
                    @if ($loop->first)
                        <h3 class="text-xl font-semibold">Trimester
                            {{ $trimester->offer_trimester }}, {{ $year->offer_year }}</h3>
                    @endif
                    <p><a href="{{ url("project/$project->id") }}">{{ $project->name }} by {{ $project->user->name }}</a>
                        <a href="{{ url("project/$project->id") }}/edit">Edit</a>
                    </p>
                @endif
            @endforeach
        @endforeach
    @endforeach

    @forelse($projects as $project)
        <p><a href="{{ url("project/$project->id") }}">{{ $project->name }} by {{ $project->user->name }}</a> <a
                href="{{ url("project/$project->id") }}/edit">Edit</a></p>
    @endforeach
</x-app-layout>
