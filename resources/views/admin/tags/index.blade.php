@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Теги проекту</h1>
        <a href="{{ route('admin.movies.index') }}"
            class=" mb-4 mt-2 inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Назад
        </a>

        {{-- Список тегів --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Список тегів</h2>
            <table class="min-w-full bg-white border border-gray-300 rounded overflow-hidden text-center">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Назва (EN)</th>
                        <th class="px-4 py-2 border-b">Назва (UA)</th>
                        <th class="px-4 py-2 border-b">Slug</th>
                        <th class="px-4 py-2 border-b">Використань</th>
                        <th class="px-4 py-2 border-b">Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $tag->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $tag->name['en'] ?? '' }}</td>
                            <td class="px-4 py-2 border-b">{{ $tag->name['uk'] ?? '' }}</td>
                            <td class="px-4 py-2 border-b">{{ $tag->slug }}</td>
                            <td class="px-4 py-2 border-b">{{ $tag->usage_count ?? 0 }}</td>
                            <td class="px-4 py-2 border-b">

                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Видалити тег?');">
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
                {{ $tags->links() }}
            </div>
        </div>
    </div>
@endsection
