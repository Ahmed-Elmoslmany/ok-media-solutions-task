<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Album
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('albums.update', $album->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div>
                        <input type="text" id="title" name="title" value="{{ old('title') ?? $album->title }}" required>
                    </div>
                    <div class="mt-4">
                        <x-button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
                            type="submit">Update Album</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>