@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-8 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Редагувати персону</h1>

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

    <form action="{{ route('admin.persons.update', $person->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Ролі --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Ролі</label>
            <select name="types[]" multiple required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 h-40">
                @php
                    $selectedTypes = $person->types->pluck('type')->toArray();
                @endphp
                <option value="director" {{ in_array('director', $selectedTypes) ? 'selected' : '' }}>Режисер</option>
                <option value="screenwriter" {{ in_array('screenwriter', $selectedTypes) ? 'selected' : '' }}>Сценарист</option>
                <option value="actor" {{ in_array('actor', $selectedTypes) ? 'selected' : '' }}>Актор</option>
                <option value="composer" {{ in_array('composer', $selectedTypes) ? 'selected' : '' }}>Композитор</option>
            </select>
        </div>

        {{-- Імʼя --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Імʼя (EN)</label>
            <input type="text" name="name[en]" value="{{ old('name.en', $person->name['en'] ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Імʼя (UK)</label>
            <input type="text" name="name[uk]" value="{{ old('name.uk', $person->name['uk'] ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Фото --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Фото</label>
            @if($person->photo)
                <img src="{{ asset('storage/' . $person->photo) }}" alt="Фото" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="photo" accept="image/*"
                class="block w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700
                       hover:file:bg-indigo-100">
        </div>

        {{-- Теги --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Теги</label>
            <select name="tags[]" multiple
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 h-40">
                @php
                    $selectedTags = $person->tags->pluck('id')->toArray();
                @endphp
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                        {{ $tag->name['en'] ?? $tag->name['uk'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Кнопка --}}
        <div class="pt-4 flex justify-center">
            <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow">
                Зберегти зміни
            </button>
        </div>
    </form>
                <a href="{{ route('admin.persons.index') }}" class=" mb-4 mt-2 flex justify-center bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Відмінити
    </a>
</div>
@endsection
