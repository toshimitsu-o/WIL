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
        <h3 class="pb-2 text-xl font-semibold text-gray-600">PROJECT: {{ $project->name }}</h3>

        <form action="{{ url("project/$project->id") }}" method="POST">
            <div class="my-5 space-y-6 rounded-2xl bg-white p-5">
                @csrf
                {{ method_field('PUT') }}
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name)"
                        autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"" placeholder="Description" name="description">{{ old('description') ?? $project->description }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div>
                    <x-input-label for="capacity" :value="__('Capacity')" />
                    <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" :value="old('capacity', $project->capacity)" />
                    <x-input-error class="mt-2" :messages="$errors->get('capacity')" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $project->email)" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <div>
                    <x-input-label for="offer_year" :value="__('Offering Year')" />
                    <x-text-input id="offer_year" name="offer_year" type="number" class="mt-1 block w-full" :value="old('offer_year', $project->offer_year)" />
                    <x-input-error class="mt-2" :messages="$errors->get('offer_year')" />
                </div>
                <div>
                    <x-input-label for="offer_trimester" :value="__('Offering Trimester')" />
                    <x-text-input id="offer_trimester" name="offer_trimester" type="number" class="mt-1 block w-full" :value="old('offer_trimester', $project->offer_trimester)" />
                    <x-input-error class="mt-2" :messages="$errors->get('offer_year')" />
                </div>


                <div>
                    <x-input-label for="name" :value="__('Role')" />
                    @foreach ($attributes->where('attributetype', 'role') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]" value="{{ $attribute->id }}"
                            {{ old('attributes')
                                ? (in_array($attribute->id, old('attributes'))
                                    ? 'checked'
                                    : '')
                                : ($project->attributes->contains($attribute->id)
                                    ? 'checked'
                                    : '') }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
        
                <div>
                    <x-input-label for="name" :value="__('Skill')" />
                    @foreach ($attributes->where('attributetype', 'skill') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]" value="{{ $attribute->id }}"
                            {{ old('attributes')
                                ? (in_array($attribute->id, old('attributes'))
                                    ? 'checked'
                                    : '')
                                : ($project->attributes->contains($attribute->id)
                                    ? 'checked'
                                    : '') }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('skill')" />
                </div>
        
                <div>
                    <x-input-label for="name" :value="__('Industry')" />
                    @foreach ($attributes->where('attributetype', 'industry') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]" value="{{ $attribute->id }}"
                            {{ old('attributes')
                                ? (in_array($attribute->id, old('attributes'))
                                    ? 'checked'
                                    : '')
                                : ($project->attributes->contains($attribute->id)
                                    ? 'checked'
                                    : '') }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('industry')" />
                </div>

            </div>
            <div class="mt-5 flex">
                <div class="grow text-right"> </div>
                <x-primary-button class="ml-3">
                    {{ __('Edit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
