<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700 capitalize">
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
        <div>
            <h4>Preferences</h4>
            <h5>Role</h5>
            @forelse ($user->attributes->where('attributetype', 'role') as $attribute)
                {{ $attribute->name }}
            @empty
                None.
            @endforelse
            <h5>Skill</h5>
            @forelse ($user->attributes->where('attributetype', 'skill') as $attribute)
                {{ $attribute->name }}
            @empty
                None.
            @endforelse
            <h5>Industry</h5>
            @forelse ($user->attributes->where('attributetype', 'industry') as $attribute)
                {{ $attribute->name }}
            @empty
                None.
            @endforelse
        </div>
        <div>
            <h4>Project Allocation</h4>

            @isset($user->allocation)
                <a href="{{ url("project/{$allocation->project->id}") }}">{{ $allocation->project->name ?? '' }}</a>
            @endisset
        @empty($user->allocation)
            None.
        @endempty
    </div>
    <div>
        <h4>Applications</h4>
        @forelse ($user->applications as $application)
            <div><a href="{{ url("project/{$application->project->id}") }}">{{ $application->project->name }}</a></div>
        @empty
            None.
        @endforelse
    </div>
@endif


</x-app-layout>
