<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-indigo-700">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <x-slot name="actions">
        @if (Auth::user()->usertype === 'ip' && Auth::user()->id === $project->user_id)
            <div class="mt-5 flex">
                <div class="grow text-right"> </div>
                <x-link-button :href="url('project/' . $project->id . '/edit')">
                    {{ __('Edit') }}
                </x-link-button>

                <form method="POST" action="{{ url("project/$project->id") }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <x-danger-button class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </form>
            </div>
        @endif
        @if (Auth::user()->usertype === 'student')
            <x-link-button :href="url('project/' . $project->id . '/apply')">
                {{ __('Apply') }}
            </x-link-button>
        @endif
    </x-slot>
    <div class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
        <h3 class="pb-2 text-xl font-semibold text-gray-600">PROJECT: {{ $project->name }}</h3>
        <div class="my-5 flex flex-col gap-5 sm:flex-row">
            <div class="flex-1 rounded-2xl bg-white p-5">
                <p class="mb-4">{{ $project->description }}</p>
                <p>Industry Partner: <a
                        href="{{ url("project/provider/{$project->user->id}") }} ">{{ $project->user->name }}</a>
                </p>
                <p>Team Capacity: {{ $project->capacity }}</p>
                <p>Email: {{ $project->email }}</p>
                <p>Offering: Trimester {{ $project->offer_trimester }}, {{ $project->offer_year }}</p>

                <!-- Attributes -->
                <div class="mt-5">
                    <h4 class="font-semibold">Preferences</h4>
                    <div>
                        <h5 class="mr-1 inline">Role:</h5>
                        @forelse ($project->attributes->where('attributetype', 'role') as $attribute)
                            {{ $attribute->name }}
                        @empty
                            None.
                        @endforelse
                    </div>
                    <div>
                        <h5 class="mr-1 inline">Skill:</h5>
                        @forelse ($project->attributes->where('attributetype', 'skill') as $attribute)
                            {{ $attribute->name }}
                        @empty
                            None.
                        @endforelse
                    </div>
                    <div>
                        <h5 class="mr-1 inline">Industry:</h5>
                        @forelse ($project->attributes->where('attributetype', 'industry') as $attribute)
                            {{ $attribute->name }}
                        @empty
                            None.
                        @endforelse
                    </div>
                </div>

                {{-- PDF files --}}
                @if (count($project->projectfiles->where('filetype', 'pdf')) > 0)
                    <div class="mt-5">
                        <h4 class="font-semibold">PDF Attachment</h4>
                        @forelse ($project->projectfiles->where('filetype', 'pdf') as $pdf)
                            <a href="{{ asset("storage/$pdf->filepath") }}" target="_blank">
                                PDF file #{{ $loop->index + 1 }}
                            </a>
                        @empty
                            None.
                        @endforelse
                    </div>
                @endif

            </div>
            {{-- Images --}}
            @if (count($project->projectfiles->where('filetype', 'img')) > 0)
                <div class="flex-1">
                    @forelse ($project->projectfiles->where('filetype', 'img') as $image)
                        <img src="{{ asset("storage/$image->filepath") }}" alt="{{ $project->name }} Image"
                            class="rounded-2xl" />
                    @empty
                        None.
                    @endforelse
                </div>
            @endif
        </div>

        <!-- Applications -->
        <div class="mb-5">
            <h4 class="font-semibold">Aplications ({{ count($project->applications) }})</h4>
            @forelse ($project->applications as $application)
                <div class="my-5">
                    {{ $application->user->name }} <br>
                    Justification: {{ $application->justification }}
                </div>
                @empty
                No applications.
            @endforelse
        </div>
        <!-- Allocations -->
        <div class="mb-5">
            <h4 class="font-semibold">Student Assignments ({{ count($project->allocations) }})</h4>
            @forelse ($project->allocations as $allocation)
                <div class="my-5">
                    {{ $allocation->user->name }} (GPA: {{ $application->user->gpa }})<br>
                    Attributes:
                    @foreach ($application->user->attributes as $attribute)
                        {{ $attribute->name }},
                    @endforeach
                </div>
                @empty
                No applicants.
            @endforelse
        </div>
    </div>
</x-app-layout>
