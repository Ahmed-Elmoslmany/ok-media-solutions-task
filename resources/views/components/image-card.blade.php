<div class="col-md-4">
    <div class="card mb-4 border-2 border-gray-200 rounded-lg shadow-md hover:border-blue-500 transition duration-300">
        <a href="{{ $image->url }}" target="_blank">
            <img src="{{ $image->url }}" class="card-img-top rounded-t-lg object-cover h-48 w-full"
                alt="{{ $image->title }}">
        </a>
        <div class="card-body p-4 bg-gray-100">
            <h5 class="card-title text-xl font-semibold mb-2">{{ $image->title }}</h5>
            <div class="flex justify-between">
                <a href="{{ route('albums.image.edit', [$albumId, $image->id]) }}">
                    <x-button
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300">Edit</x-button>
                </a>
                <form method="POST" action="{{ route('image.destroy', [$albumId, $image->id]) }}">
                    @csrf
                    @method('DELETE')
                    <x-button
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-300">Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</div>