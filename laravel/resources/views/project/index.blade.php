<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
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
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        @forelse($offer_years as $year)
            @forelse($offer_trimesters as $trimester)
                @forelse($projects->where('offer_year', $year->offer_year)->where('offer_trimester', $trimester->offer_trimester) as $project)
                    @if ($project->offer_year == $year->offer_year && $project->offer_trimester == $trimester->offer_trimester)
                        @if ($loop->first)
                            <h3 class="pb-2 text-xl font-semibold text-gray-600">Trimester
                                {{ $trimester->offer_trimester }}, {{ $year->offer_year }}</h3>
                            <div class="my-6">
                                <table class="min-w-full rounded-2xl bg-white">
                                    <thead class="bg-opacity-40">
                                        <tr>
                                            <th class="px-4 py-2 text-center text-xs">Project Name</th>
                                            <th class="px-4 py-2 text-center text-xs w-1/4">Provider</th>
                                            <th class="px-4 py-2 text-center text-xs w-6">Applications</th>
                                            <th class="px-4 py-2 text-center text-xs w-5">Assigned (Capacity)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        @endif
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-2"><a href="{{ url("project/$project->id") }}">{{ $project->name }}</a>
                            </td>
                            <td class="px-4 py-2">{{ $project->user->name }}</td>
                            <td class="px-4 py-2">{{ $project->applications->count() }}</td>
                            <td class="px-4 py-2">{{ $project->allocations->count() }} ({{ $project->capacity }})</td>
                        </tr>
                        @if ($loop->last)
                            </tbody>
                            </table>
    </div>
    @endif
    @endif
    @endforeach
    @endforeach
    @endforeach

    </div>
</x-app-layout>
