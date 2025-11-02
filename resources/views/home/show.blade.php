@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Верхня панель з лого та вибір язику --}}
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center space-x-2">
            <a href="{{ LaravelLocalization::localizeURL(route('home.index')) }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="w-8 h-8">
                <h1 class="text-xl font-bold">MOVIE LAB</h1>
            </a>
        </div>

        <div class="text-right">
            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if (app()->getLocale() === $localeCode)
                    <span class="font-bold text-blue-600">{{ $properties['native'] }}</span>
                @else
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                       class="text-gray-600 hover:underline">
                        {{ $properties['native'] }}
                    </a>
                @endif
                @if (!$loop->last)
                    /
                @endif
            @endforeach
        </div>
    </div>

    {{-- Контент фільму --}}
    <div class="flex flex-col md:flex-row gap-6">

        {{-- Постер --}}
        <div class="md:w-1/3">
            <img src="{{ asset('storage/' . $movie->poster) }}" 
                 alt="{{ $movie->title_localized }}" 
                 class="rounded-lg shadow-md w-full">
        </div>

        {{-- Інформація --}}
        <div class="md:w-2/3">
            <h1 class="text-3xl font-bold mb-4">
                {{ $movie->title_localized }} ({{ $movie->year }})
            </h1>

            <p class="text-gray-700 mb-4">
                {!! nl2br(e($movie->description_localized)) !!}
            </p>

            {{-- Теги --}}
            @if($movie->tags->isNotEmpty())
                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach($movie->localized_tags as $tagName)
                        <span class="px-3 py-1 rounded-full bg-gray-200 text-sm">{{ $tagName }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Ролі --}}
            <div class="mb-4 space-y-2">
                @foreach(['director', 'screenwriter', 'actor', 'composer'] as $role)
                    @php($persons = $movie->personsByRole($role))
                    @if($persons->isNotEmpty())
                        <p class="font-semibold">
                            {{ ucfirst(__('roles.' . $role)) }}:
                            @foreach($persons as $person)
                                {{ $person->name[LaravelLocalization::getCurrentLocale()] ?? $person->name['en'] }}
                                @if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                @endforeach
            </div>

            {{-- YouTube трейлер --}}
            @if($movie->show_trailer)
                <div class="mb-4">
                    <iframe class="w-full h-64 md:h-80 rounded-lg"
                            src="https://www.youtube.com/embed/{{ $movie->trailer_id_youtube }}"
                            frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            @endif
        </div>
    </div>

    {{-- Скриншоти --}}
    @if($movie->screenshots)
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($movie->screenshots as $screenshot)
                <img src="{{ asset('storage/' . $screenshot) }}" 
                     alt="{{ __('Screenshot') }}" 
                     class="rounded-lg shadow-md w-full h-48 object-cover">
            @endforeach
        </div>
    @endif
</div>
@endsection
