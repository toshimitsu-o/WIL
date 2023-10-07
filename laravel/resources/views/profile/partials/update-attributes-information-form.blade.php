<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Project Preferences') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your preferences for your project assignment.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update_attributes') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Role')" />
            @foreach ($attributes->where('attributetype', 'role') as $attribute)
                <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]" value="{{ $attribute->id }}"
                    {{ old('attributes')
                        ? (in_array($attribute->id, old('attributes'))
                            ? 'checked'
                            : '')
                        : ($user->attributes->contains($attribute->id)
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
                        : ($user->attributes->contains($attribute->id)
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
                        : ($user->attributes->contains($attribute->id)
                            ? 'checked'
                            : '') }}>
                <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('industry')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
