<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold capitalize leading-tight text-indigo-700">
            {{ __($usertype ?? 'User') }}
        </h2>
    </x-slot>
    <x-slot name="actions">
        @if (Auth::user()->id === $user->id)
            <x-link-button :href="url('profile')">
                {{ __('Edit') }}
            </x-link-button>
        @endif
    </x-slot>
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <h3 class="pb-2 text-xl font-semibold text-gray-600">{{ $user->name }}</h3>
        <p>Email: {{ $user->email }}</p>
        @if ($user->usertype === 'student')
            <p>GPA: {{ $user->gpa ?? 'n/a' }}</p>
            <!-- Attributes -->
            <div class="my-5">
                <h4 class="font-semibold">Preferences</h4>
                <div>
                    <h5 class="mr-1 inline">Role:</h5>
                    @forelse ($user->attributes->where('attributetype', 'role') as $attribute)
                        {{ $attribute->name }}
                    @empty
                        None.
                    @endforelse
                </div>
                <div>
                    <h5 class="mr-1 inline">Skill:</h5>
                    @forelse ($user->attributes->where('attributetype', 'skill') as $attribute)
                        {{ $attribute->name }}
                    @empty
                        None.
                    @endforelse
                </div>
                <div>
                    <h5 class="mr-1 inline">Industry:</h5>
                    @forelse ($user->attributes->where('attributetype', 'industry') as $attribute)
                        {{ $attribute->name }}
                    @empty
                        None.
                    @endforelse
                </div>
            </div>
            <div class="mb-5">
                <h4 class="font-semibold">Project Allocation</h4>

                @isset($user->allocation)
                    <a href="{{ url("project/{$allocation->project->id}") }}">{{ $allocation->project->name ?? '' }}</a>
                @endisset
            @empty($user->allocation)
                None.
            @endempty
        </div>
        <div class="mb-5">
            <h4 class="font-semibold">Applications ({{ count($user->applications) }})</h4>
            @forelse ($user->applications as $application)
                <div><a
                        href="{{ url("project/{$application->project->id}") }}">{{ $application->project->name }}</a>
                </div>
            @empty
                None.
            @endforelse
        </div>
    @endif


</x-app-layout>
