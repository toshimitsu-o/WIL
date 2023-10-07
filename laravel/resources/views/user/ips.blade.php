<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
            Industry Partners
        </h2>
    </x-slot>
    @forelse($users as $user)
        <div>
            <a href="{{ url("project/provider/$user->id") }}">{{ $user->name }}</a><br>
            {{-- Approve Button --}}
            @if (Auth::user()->usertype === 'teacher' && empty($user->approved_at))
                <form method="POST" action="{{ url('partner/' . $user->id . '/approve') }}">
                    @csrf
                    @method('PATCH')
                    <x-primary-button class="ml-3">{{ __('Approve') }}
                    </x-primary-button>
                </form>
            @endif
            {{-- Approve Button --}}
        </div>
    @endforeach
</x-app-layout>
