<x-app-layout>
    <x-slot name="add_script">
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
        <script type="text/javascript">
            // Solution Source: https://www.tutsmake.com/laravel-8-dynamically-multiple-add-or-remove-input-fields-using-jquery/
            $(function() {
                var i = 0;
                $("#add-image-btn").click(function() {
                    ++i;
                    $("#image-upload").append(`
                    <div class="flex gap-4">
                        <div class="grow">
                            <input id="images[${i}]" name="images[${i}]" type="file"
                                class="mt-1 block w-full" />
                        </div>
                    </div>
                    `);
                });
                var j = 0;
                $("#add-pdf-btn").click(function() {
                    ++i;
                    $("#pdf-upload").append(`
                    <div class="flex gap-4">
                        <div class="grow">
                            <input id="pdfs[${j}]" name="pdfs[${j}]" type="file"
                                class="mt-1 block w-full" />
                        </div>
                    </div>
                    `);
                });
            });
        </script>
    </x-slot>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <h3 class="pb-2 text-xl font-semibold text-gray-600">NEW PROJECT</h3>

        <form action="{{ url('project') }}" method="POST" enctype="multipart/form-data">
            <div class="my-5 space-y-6 rounded-2xl bg-white p-5">
                {{ csrf_field() }}
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Description" name="description">{{ old('description') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div>
                    <x-input-label for="capacity" :value="__('Capacity')" />
                    <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full"
                        :value="old('capacity')" />
                    <x-input-error class="mt-2" :messages="$errors->get('capacity')" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"
                        :value="old('email', Auth::user()->email)" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <div>
                    <x-input-label for="offer_year" :value="__('Offering Year')" />
                    <x-text-input id="offer_year" name="offer_year" type="number" class="mt-1 block w-full"
                        :value="old('offer_year')" />
                    <x-input-error class="mt-2" :messages="$errors->get('offer_year')" />
                </div>
                <div>
                    <x-input-label for="offer_trimester" :value="__('Offering Trimester')" />
                    <x-text-input id="offer_trimester" name="offer_trimester" type="number" class="mt-1 block w-full"
                        :value="old('offer_trimester')" />
                    <x-input-error class="mt-2" :messages="$errors->get('offer_trimester')" />
                </div>
                {{-- Attributes --}}
                <h4 class="font-semibold">Prefferences</h4>
                <div>
                    <x-input-label for="name" :value="__('Role')" />
                    @foreach ($attributes->where('attributetype', 'role') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]"
                            value="{{ $attribute->id }}"
                            {{ old('attributes') ? (in_array($attribute->id, old('attributes')) ? 'checked' : '') : '' }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
                <div>
                    <x-input-label for="name" :value="__('Skill')" />
                    @foreach ($attributes->where('attributetype', 'skill') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]"
                            value="{{ $attribute->id }}"
                            {{ old('attributes') ? (in_array($attribute->id, old('attributes')) ? 'checked' : '') : '' }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('skill')" />
                </div>
                <div>
                    <x-input-label for="name" :value="__('Industry')" />
                    @foreach ($attributes->where('attributetype', 'industry') as $attribute)
                        <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]"
                            value="{{ $attribute->id }}"
                            {{ old('attributes') ? (in_array($attribute->id, old('attributes')) ? 'checked' : '') : '' }}>
                        <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    @endforeach
                    <x-input-error class="mt-2" :messages="$errors->get('industry')" />
                </div>
                {{-- Image uploads --}}
                <h4 class="font-semibold">Image Attachment</h4>
                <div id="image-upload">
                    <div class="flex gap-4">
                        <div class="grow">
                            <input id="images[0]" name="images[0]" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('images[0]')" />
                        </div>
                    </div>
                </div>
                <button type="button" name="add" id="add-image-btn"
                    class="ml-3 inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">Add
                    More Image</button>
                {{-- End: Image uploads --}}
                {{-- PDF uploads --}}
                <h4 class="font-semibold">PDF Attachment</h4>
                <div id="pdf-upload">
                    <div class="flex gap-4">
                        <div class="grow">
                            <input id="pdfs[0]" name="pdfs[0]" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('pdfs[0]')" />
                        </div>
                    </div>
                </div>
                <button type="button" name="add" id="add-pdf-btn"
                    class="ml-3 inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">Add
                    More PDF</button>
                {{-- End: PDF uploads --}}
            </div>
            <div class="mt-5 flex">
                <div class="grow text-right"> </div>
                <x-primary-button class="ml-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
