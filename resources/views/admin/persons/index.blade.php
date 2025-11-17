@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-8 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Додати персону</h1>

    {{-- Успішне повідомлення --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Помилки --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.persons.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Ролі --}}
<div>
    <label class="block text-gray-700 font-semibold mb-2">Ролі</label>
    <select name="types[]" multiple required
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 h-40">
        <option value="director" {{ collect(old('types'))->contains('director') ? 'selected' : '' }}>Режисер</option>
        <option value="screenwriter" {{ collect(old('types'))->contains('screenwriter') ? 'selected' : '' }}>Сценарист</option>
        <option value="actor" {{ collect(old('types'))->contains('actor') ? 'selected' : '' }}>Актор</option>
        <option value="composer" {{ collect(old('types'))->contains('composer') ? 'selected' : '' }}>Композитор</option>
    </select>
    <p class="text-gray-500 text-sm mt-1">Утримуйте Ctrl (Cmd на Mac), щоб обрати кілька типів</p>
</div>

        {{-- Імʼя --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Імʼя (EN)</label>
            <input type="text" name="name[en]" value="{{ old('name.en') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Імʼя (UK)</label>
            <input type="text" name="name[uk]" value="{{ old('name.uk') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Фото --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Фото(не більше 2МБ)</label>
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
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @if(collect(old('tags'))->contains($tag->id)) selected @endif>
                        {{ $tag->name['en'] ?? $tag->name['uk'] }}
                    </option>
                @endforeach
            </select>
            <p class="text-gray-500 text-sm mt-1">Утримуйте Ctrl (Cmd на Mac), щоб вибрати кілька тегів</p>
        </div>

        {{-- Кнопка --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow">
                Зберегти персону
            </button>
        </div>
    </form>
                <a href="{{ route('admin.movies.index') }}" class=" mb-4 mt-2 flex justify-center bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Назад
    </a>

    {{-- Список персон --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Список персон</h2>
<table class="min-w-full bg-white border border-gray-300 rounded overflow-hidden text-center">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 border-b">ID</th>
            <th class="px-4 py-2 border-b">Імʼя (EN)</th>
            <th class="px-4 py-2 border-b">Імʼя (UA)</th>
            <th class="px-4 py-2 border-b">Ролі</th>
            <th class="px-4 py-2 border-b">Теги</th>
            <th class="px-4 py-2 border-b">Дії</th>
        </tr>
    </thead>
    <tbody>
        @foreach($persons as $person)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b text-gray-700">{{ $person->id }}</td>
                <td class="px-4 py-2 border-b">{{ $person->name['en'] ?? '' }}</td>
                <td class="px-4 py-2 border-b">{{ $person->name['uk'] ?? '' }}</td>

                {{-- Ролі --}}
                <td class="px-4 py-2 border-b">
                    @if($person->types->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($person->types as $type)
                                <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full font-semibold">
                                    {{ ucfirst($type->type) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-gray-400 text-sm">—</span>
                    @endif
                </td>

                {{-- Теги --}}
                <td class="px-4 py-2 border-b">
                    @if($person->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($person->tags as $tag)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full">
                                    {{ $tag->name['en'] ?? $tag->name['uk'] }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-gray-400 text-sm">—</span>
                    @endif
                </td>

                {{-- Дії --}}
                <td class="px-4 py-2 border-b text-center space-x-2">
                    <a href="{{ route('admin.persons.edit', $person->id) }}"
                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                        Редагувати
                    </a>

                    <form action="{{ route('admin.persons.destroy', $person->id) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Видалити цю персону?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-500 hover:text-red-700 font-semibold text-sm">
                            Видалити
                        </button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        {{-- Пагинація --}}
        <div class="mt-4">
            {{ $persons->links() }}
        </div>
        
</div>
@endsection
