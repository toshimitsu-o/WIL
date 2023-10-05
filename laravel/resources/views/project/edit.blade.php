<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project') }}
        </h2>
    </x-slot>
    @if (count($errors) > 0)
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url("project/$project->id") }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        Name: <input type="text" name="name" value="{{ old('name') ?? $project->name }}">
        <br>
        <textarea class="h-full w-full bg-gray-50 outline-none" placeholder="Description" name="description">{{ old('description') ?? $project->description }}</textarea>
        <br>
        Capacity: <input type="number" name="capacity" value="{{ old('capacity') ?? $project->capacity }}">
        <br>
        Email Address: <input type="text" name="email" value="{{ old('email') ?? $project->email }}">
        <br>
        Offering Year: <input type="number" name="offer_year" value="{{ old('offer_year') ?? $project->offer_year }}">
        <br>
        Offering Trimester: <input type="number" name="offer_trimester" value="{{ old('offer_trimester') ?? $project->offer_trimester }}">
        <br>
        @foreach ($attributes as $attribute)
    <input type="checkbox" id="{{ $attribute->name }}" name="attributes[]" value="{{ $attribute->id }}" 
        {{ old('attributes') ? (in_array($attribute->id, old('attributes')) ? 'checked' : '') 
                             : ($project->attributes->contains($attribute->id) ? 'checked' : '') }}>
    <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
@endforeach
        <br>
        <input type="submit" value="Edit">
    </form>
</x-app-layout>
