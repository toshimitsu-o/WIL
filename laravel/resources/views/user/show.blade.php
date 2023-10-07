<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __($usertype ?? 'User') }}
        </h2>
    </x-slot>
    <h3>{{ $user->name }}</h3>
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
@if (Auth::user()->id === $user->id)
        <x-link-button :href="url('profile')">
            {{ __('Edit') }}
        </x-link-button>
        @endif

</x-app-layout>
