@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <a href="{{ route('admin.movies.index') }}"
            class=" mb-4 mt-2 inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Назад
        </a>

        <div class="mb-6 bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Додати новий тег</h2>
            <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Назва --}}
                <div>
                    <label class="block font-medium mb-1">Назва (UA)</label>
                    <input type="text" name="name[uk]" value="{{ old('name.uk') }}"
                        class="border border-gray-300 rounded p-2 w-full">
                    @error('name.uk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Назва (EN)</label>
                    <input type="text" name="name[en]" value="{{ old('name.en') }}"
                        class="border border-gray-300 rounded p-2 w-full">
                    @error('name.en')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block font-medium mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}"
                        class="border border-gray-300 rounded p-2 w-full">
                    <p class="text-gray-500 text-sm">Якщо залишити пустим, буде згенеровано автоматично.</p>
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Додати
                    тег</button>
            </form>
        </div>


    </div>
@endsection
