<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('image.store', $album->id) }}" enctype="multipart/form-data">
                    @csrf
                    <h1 class="font-bold text-gray-800">Add Photo to Your Album</h1>
                    <div class="mt-4">
                        <input type="file" class="filepond" name="image" >
                    </div>
                    <div class="mt-4">
                        <input type="text" placeholder="Image Title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mt-4">
                        <x-button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Upload</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4">

        <h1 class="text-4xl md:text-5xl text-blue-600 mb-6 text-center underline decoration-wavy decoration-yellow-400">Photos in Your Album</h1>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mx-6">
            @foreach($images as $image)
            <x-image-card :image="$image" :albumId="$album->id" />
            @endforeach
        </div>
    </div>


</x-app-layout>

