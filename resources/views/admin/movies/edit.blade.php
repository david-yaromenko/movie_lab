@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow p-8 mt-10">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Редагувати фільм</h1>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Видимість --}}
            <div class="flex items-center">
                <input type="hidden" name="is_visible" value="0">
                <input type="checkbox" name="is_visible" id="is_visible" value="1"
                    {{ $movie->is_visible ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <label for="is_visible" class="ml-2 text-gray-700">Показати на сайті</label>
            </div>

            {{-- Назва --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Назва (EN)</label>
                <input type="text" name="title[en]" value="{{ old('title.en', $movie->title['en'] ?? '') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Назва (UK)</label>
                <input type="text" name="title[uk]" value="{{ old('title.uk', $movie->title['uk'] ?? '') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Опис --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Опис (EN)</label>
                <textarea name="description[en]" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description.en', $movie->description['en'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Опис (UK)</label>
                <textarea name="description[uk]" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description.uk', $movie->description['uk'] ?? '') }}</textarea>
            </div>

            {{-- Теги --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Теги</label>
                <select name="tags[]" multiple
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 h-40">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @if (collect(old('tags', $movie->tags->pluck('id')))->contains($tag->id)) selected @endif>
                            {{ $tag->name['en'] ?? $tag->name['uk'] }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-sm mt-1">Утримуйте Ctrl (Cmd на Mac) для вибору кількох тегів</p>
            </div>

            {{-- ролі --}}
            <div class="space-y-4">
                @php
                    $roles = [
                        'director' => 'Режисер',
                        'screenwriter' => 'Сценарист',
                        'actor' => 'Актор',
                        'composer' => 'Композитор',
                    ];
                @endphp

                @foreach ($roles as $roleKey => $roleLabel)
                    @php
                        $selectedPersons = old(
                            "roles.$roleKey",
                            isset($movie)
                                ? $movie->personRoles()->where('role', $roleKey)->pluck('person_id')->toArray()
                                : [],
                        );
                    @endphp

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">{{ $roleLabel }}</label>
                        <select name="roles[{{ $roleKey }}][]" multiple
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach ($persons as $person)
                                @if ($person->types->contains('type', $roleKey))
                                    <option value="{{ $person->id }}"
                                        {{ in_array($person->id, $selectedPersons) ? 'selected' : '' }}>
                                        {{ $person->name['uk'] ?? ($person->name['en']) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>


            {{-- рік --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Рік</label>
                <input type="number" name="year" value="{{ old('year', $movie->year) }}" min="1900"
                    max="{{ date('Y') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Дата початку та кінця --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Дата початку перегляду</label>
                    <input type="datetime-local" name="watch_start_date"
                        value="{{ old('watch_start_date', $movie->watch_start_date) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Дата закінчення перегляду</label>
                    <input type="datetime-local" name="watch_end_date"
                        value="{{ old('watch_end_date', $movie->watch_end_date) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- Трейлер --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">YouTube посилання трейлера</label>
                <input type="text" name="trailer_id_youtube"
                    value="{{ old('trailer_id_youtube', $movie->trailer_id_youtube) }}"
                    placeholder="наприклад, dQw4w9WgXcQ"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Постер --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Постер(не більше 2МБ)</label>
                @if ($movie->poster)
                    <img src="{{ asset('storage/' . $movie->poster) }}" class="w-32 h-48 object-cover rounded mb-2">
                @endif
                <input type="file" name="poster" accept="image/*"
                    class="block w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100">
            </div>

            {{-- Скриншоти --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Скріншоти(не більше 2МБ)</label>
                <div class="flex gap-2 mb-2">
                    @if ($movie->screenshots)
                        @foreach ($movie->screenshots as $screenshot)
                            <img src="{{ asset('storage/' . $screenshot) }}" class="w-24 h-24 object-cover rounded">
                        @endforeach
                    @endif
                </div>
                <input type="file" name="screenshots[]" multiple accept="image/*"
                    class="block w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100">
            </div>

            {{-- Кнопка --}}
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow">
                    Зберегти зміни
                </button>
            </div>
            <a href="{{ route('admin.movies.index') }}"
                class=" mb-4 mt-2 flex justify-center bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Відмінити
            </a>
        </form>
    </div>
@endsection
