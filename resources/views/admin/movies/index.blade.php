@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Всі фільми</h1>

        <a href="{{ route('admin.movies.create') }}"
            class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Додати фільм
        </a>
        <a href="{{ route('admin.tags.create') }}"
            class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Додати тег
        </a>
        <a href="{{ route('admin.tags.index') }}"
            class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Всі теги
        </a>
        <a href="{{ route('admin.persons.index') }}"
            class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Додати персону
        </a>


        <form method="POST" action="{{ route('logout') }}" class="inline-block ">
            @csrf
            <button type="submit"
                class="inline-flex items-center  px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                Вихід
            </button>
        </form>



        <table class="min-w-full bg-white border border-gray-300 rounded overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Постер</th>
                    <th class="px-4 py-2 border-b">Назва (EN)</th>
                    <th class="px-4 py-2 border-b">Назва (UA)</th>
                    <th class="px-4 py-2 border-b">Рік</th>
                    <th class="px-4 py-2 border-b">Видимість</th>
                    <th class="px-4 py-2 border-b">Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="px-7 py-2 border-b">{{ $movie->id }}</td>

                        {{-- Постер --}}
                        <td class="px-4 py-2 border-b">
                            @if ($movie->poster)
                                <img src="{{ asset('storage/' . $movie->poster) }}" alt="poster"
                                    class="w-16 h-24 object-cover rounded">
                            @else
                                <span class="text-gray-400">Немає</span>
                            @endif
                        </td>

                        {{-- Назва --}}
                        <td class="px-4 py-2 border-b">{{ $movie->title['en'] ?? '' }}</td>
                        <td class="px-4 py-2 border-b">{{ $movie->title['uk'] ?? '' }}</td>

                        {{-- Рік --}}
                        <td class="px-4 py-2 border-b">{{ $movie->year ?? '-' }}</td>

                        {{-- Видимість --}}
                        <td class="px-4 py-2 border-b">
                            @if ($movie->is_visible)
                                <span class="text-green-600 font-semibold">Так</span>
                            @else
                                <span class="text-red-600 font-semibold">Ні</span>
                            @endif
                        </td>

                        {{-- Действия --}}
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.movies.edit', $movie->id) }}"
                                class="text-blue-500 hover:underline mr-2">Редагувати</a>

                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Видалити цей фільм?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Пагинація --}}
        <div class="mt-4">
            {{ $movies->links() }}
        </div>

    </div>
@endsection
