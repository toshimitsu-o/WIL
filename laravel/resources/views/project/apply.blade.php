<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
            {{ __('Project Application') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <h3 class="pb-2 text-xl font-semibold text-gray-600">{{ $project->name }}</h3>
        <p>Provider: {{ $project->user->name }}</p>
        <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>
        <div class="my-5 space-y-6 rounded-2xl bg-white p-5">
            <h4 class="font-semibold">Apply for This Project</h4>
            <form action="{{ url("project/$project->id/apply") }}" method="POST">
                @csrf
                <div>
                    <x-input-label for="description" :value="__('Justification')" />
                    <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Justification" name="justification">{{ old('justification') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('justification')" />
                </div>

                <div class="mt-5 flex">
                    <div class="grow text-right"> </div>
                    <x-primary-button class="ml-3">
                        {{ __('Apply') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
