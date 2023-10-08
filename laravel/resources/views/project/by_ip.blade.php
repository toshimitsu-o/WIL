<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
            {{ __('Industry Partner') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <h3 class="pb-2 text-xl font-semibold text-gray-600">{{ $ip->name }}</h3>
        <p>Email address: {{ $ip->email }}</p>
        <div class="mt-10">
            <h4 class="text-lg">Projects</h4>
            @foreach ($projects as $project)
            <div class="m-5 rounded-2xl bg-white p-5">
                    <h5 class="text-lg"><a href="{{ url("project/$project->id") }}">{{ $project->name }}</a></h5>
                    <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
