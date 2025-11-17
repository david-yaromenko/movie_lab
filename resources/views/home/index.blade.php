@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Верхня панель --}}
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="w-8 h-8">
                <h1 class="text-xl font-bold">MOVIE LAB</h1>
            </div>

            <a href="https://t.me/movie_lab_news_bot" target="_blank" class="text-blue-600 hover:text-blue-700">
                {{ __('telegramBot.subscribe_to_news_bot') }}
            </a>

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

        {{-- Сітка фільмів --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 ">
            @foreach ($movies as $movie)
                <a href="{{ LaravelLocalization::localizeURL(route('home.show', $movie)) }}"
                    class="group block movie-card ">
                    <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg transition w-40 h-60">
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title_localized }}"
                            class=" w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="mt-2">
                        <p class="font-semibold group-hover:text-blue-600 transition">
                            {{ $movie->title_localized }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $movie->year }}
                            @if ($movie->personRoles->isNotEmpty())
                                {{ $movie->personRoles->first()->person->name[LaravelLocalization::getCurrentLocale()] ?? $person->name['en'] }}
                            @endif
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Пагинація --}}
        <div class="mt-8 flex justify-center">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
