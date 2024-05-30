@vite('resources/js/albums.js')
<tr>
    <td class="px-6 py-4 whitespace-nowrap">{{ $album->id }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        <a class="text-indigo-500 hover:text-indigo-700 font-semibold" href="{{ route('albums.show', $album->id) }}">

            {{ $album->title }}
        </a>

    </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
        <div class="flex justify-end space-x-2">
            <a href="{{ route('albums.edit', $album->id) }}"
                class="rounded py-2 px-4 font-bold text-indigo-600 hover:text-white hover:bg-indigo-700 active:bg-red-900 transition duration-300">Edit</a>
            <span class="text-gray-400">|</span>
            <x-button class="text-red-600 hover:text-white hover:bg-red-700 active:bg-red-900 transition duration-300"
                onclick="confirmDeleteAlbum({{ $album->id }})">Delete</x-button>


        </div>
    </td>

</tr>


<script>
    function confirmDeleteAlbum(albumId) {
        Swal.fire({
            title: 'What do you want to do?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Delete Album',
            denyButtonText: `Move Images to Another Album`,
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/albums/${albumId}`)
                    .then(response => {
                        window.location.href = '/albums';
                    })
                    .catch(error => {
                        console.error('There was an error deleting the album!', error);
                    });
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'Select the target album',
                    input: 'select',
                    inputOptions: {
                        @foreach ($albums as $album)
                            {{ $album->id }}: '{{ $album->title }}',
                        @endforeach
                    },
                    inputPlaceholder: 'Select an album',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'You need to select an album!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.patch(`/albums/${albumId}/move-images/${result.value}`)
                            .then(response => {
                                window.location.href = '/albums';
                            })
                            .catch(error => {
                                console.error('There was an error moving the images!', error);
                            });
                    }
                });
            }
        });
    }
</script>