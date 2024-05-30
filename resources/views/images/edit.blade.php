{{--<div class="container mx-auto mt-8">--}}
{{--    <h1 class="text-3xl font-bold text-center mb-8">Edit Image</h1>--}}

{{--    <div class="max-w-md mx-auto">--}}
{{--        <div class="bg-white shadow-md rounded-lg overflow-hidden">--}}
{{--            <div class="grid grid-cols-1 md:grid-cols-2">--}}
{{--                <div class="p-4 flex justify-center items-center">--}}
{{--                    <img src="{{ $image->url }}" class="rounded-lg max-h-48 md:max-h-full" alt="{{ $image->title }}">--}}
{{--                </div>--}}
{{--                <div class="p-4">--}}
{{--                    <form method="POST" action="{{ route('albums.image.update', ['album' => $album->id, 'image' => $image->id]) }}">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>--}}
{{--                            <input type="text" name="title" id="title" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $image->title }}">--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Confirm Edit</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<x-app-layout>

    <div class="flex justify-center items-center h-screen">
        <div class="col-md-4">
            <div class="card mb-4 border-2 border-gray-200 rounded-lg shadow-md hover:border-blue-500 transition duration-300">
                <a href="{{ $image->url }}" target="_blank">
                    <img src="{{ $image->url }}" class="card-img-top rounded-t-lg object-cover h-80 w-full mx-auto" alt="{{ $image->title }}">
                </a>
                <div class="card-body p-4 bg-gray-100">
                    <div class="flex justify-between">
                        <form method="POST" action="{{ route('albums.image.update', ['album' => $album->id, 'image' => $image->id]) }}">
                            @csrf
                            @method('PUT')
                            <input value="{{$image->title}}" name="title" class="card-title text-xl font-semibold mb-2"/>
                            <x-button class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600 transition duration-300">Update</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
