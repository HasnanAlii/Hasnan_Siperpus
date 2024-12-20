<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @hasrole('pustakawan') 
                    <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                    <x-primary-button tag="a" href="{{ route('book.print') }}">Print PDF</x-primary-button>

                    <x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank">Export
                        Excel</x-primary-button>
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'import-book')">{{ __('Import Excel') }}</x-primary-button>
                        @endhasrole 
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th class="text-center" scope="col">Judul</th>
                                <th class="text-center" scope="col">Penulis</th>
                                <th class="text-center" scope="col">Tahun</th>
                                <th class="text-center" scope="col">Penerbit</th>
                                <th class="text-center" scope="col">Kota</th>
                                <th class="text-center" scope="col">Cover</th>
                                <th class="text-center" scope="col">Kode Rak</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($books as $book)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $book->title }}</td>
                                <td class="text-center">{{ $book->author }}</td>
                                <td class="text-center">{{ $book->year }}</td>
                                <td class="text-center">{{ $book->publisher }}</td>
                                <td class="text-center">{{ $book->city }}</td>
                                <td>
                                    <img class="ml-10" src="{{ asset('storage/cover_buku/' . $book->cover) }}" width="100px" />
                                </td>
                                <td class="text-center">{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                                @hasrole('mahasiswa')
                                <td class="text-center">
                                    
                                {{-- <x-primary-button tag="a"
                                href="{{ route('books.borrow', $book->id) }}">Pinjam</x-primary-button> --}}
                                <x-primary-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-borrow')"
                                            x-on:click="$dispatch('set-action', '{{ route('books.borrow', $book->id) }}')">{{ __('Pinjam') }}</x-primary-button>

                                </td>
                                @endhasrole 
                                @hasrole('pustakawan') 
                                <td class="text-center">
                                    <x-primary-button tag="a"
                                            href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">{{ __('Delete') }}</x-danger-button>
                                </td>
                                @endhasrole
                            </tr>
                        @endforeach
                    </x-table>
                    <x-modal name="confirm-borrow"  focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('get')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin ingin meminjam Buku?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Anda dapat meminjam buku maksimal 14 hari, lebih dari itu maka akan di beri sanksi') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-succes-button class="ml-3">
                                    {{ __('Pinjam') }}
                                </x-succes-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="import-book" focusable maxWidth="xl">
                        <form method="post" action="{{ route('book.import') }}" class="p-6"
                            enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Import Data Buku') }}
                            </h2>
                            <div class="max-w-xl">
                                <x-input-label for="cover" class="sr-only" value="File Import" />
                                <x-file-input id="cover" name="file" class="mt-1 block w-full" required />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button class="h-9 mt-3" x-on:click="$dispatch('close')">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                                <x-primary-button class="ml-3">
                                    {{ __('Import') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
