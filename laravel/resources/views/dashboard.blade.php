<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
            {{ __('Industry Partners') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <div class="mb-12">
            @forelse($ips as $ip)
                <div class="m-5 rounded-2xl bg-white p-5 flex items-center"><div class="grow"><a
                        href="{{ url("project/provider/$ip->id") }}">{{ $ip->name }}</a></div>
                    {{-- Approve Button --}}
                    @if (Auth::user()->usertype === 'teacher' && empty($ip->approved_at))
                        <div>
                            <form method="POST" action="{{ url('partner/' . $ip->id . '/approve') }}">
                                @csrf
                                @method('PATCH')
                                <x-primary-button class="ml-3">{{ __('Approve') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                    {{-- Approve Button --}}
                </div>
            @endforeach

        </div>
        {{ $ips->links() }}
    </div>


</x-app-layout>
