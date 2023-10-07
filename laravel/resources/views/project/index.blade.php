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
    @forelse($offer_years as $year)
        @forelse($offer_trimesters as $trimester)
            @forelse($projects->where('offer_year', $year->offer_year)->where('offer_trimester', $trimester->offer_trimester) as $project)
                @if ($project->offer_year == $year->offer_year && $project->offer_trimester == $trimester->offer_trimester)
                    @if ($loop->first)
                    <h3 class="pb-2 text-xl font-semibold text-gray-600">Trimester
                            {{ $trimester->offer_trimester }}, {{ $year->offer_year }}</h3>
                    @endif
                    <div class="m-5 rounded-2xl bg-white p-5"><a href="{{ url("project/$project->id") }}">{{ $project->name }} by {{ $project->user->name }}</a>
                    </div>
                @endif
            @endforeach
        @endforeach
    @endforeach

    </div>
</x-app-layout>
