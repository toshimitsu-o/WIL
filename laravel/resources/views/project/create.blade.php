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

    <form action="{{ url('project') }}" method="POST">
        {{ csrf_field() }}
        Name: <input type="text" name="name" value="{{ old('name') }}">
        <br>
        <textarea class="h-full w-full bg-gray-50 outline-none" placeholder="Description" name="message">{{ old('description') }}</textarea>
        <br>
        Capacity: <input type="number" name="capacity" value="{{ old('capacity') }}">
        <br>
        Email Address: <input type="text" name="email" value="{{ old('email') ?? Auth::user()->email }}">
        <br>
        Offering Year: <input type="number" name="offer_year" value="{{ old('offer_year') ?? 2024 }}">
        <br>
        Offering Trimester: <input type="number" name="offer_trimester" value="{{ old('offer_trimester') }}">
        <br>
        @foreach ($attributes as $attribute)
                <input type="checkbox" id="{{$attribute->name}}" name="{{$attribute->name}}" value="{{$attribute->name}}"  @checked(old($attribute->name)) />
                <label for="{{$attribute->name}}">{{$attribute->name}}</label>
        @endforeach
        <br>
        <input type="submit" value="Create">
    </form>
</x-app-layout>
