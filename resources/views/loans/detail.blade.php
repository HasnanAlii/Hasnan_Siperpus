<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th  scope="col">#</th>
                                <th  class="text-center" scope="col">ID Pinjaman</th>
                                <th  class="text-center" scope="col">Peminjam</th>
                                <th  class="text-center" scope="col">Judul Buku</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach($loanDetails as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-center">{{ $detail->loan_id }}</td>
                <td class="text-center">{{ $detail->user->name }}</td>
                <td class="text-center">{{ $detail->book->title }}</td>
                <td class="text-center">{{ $detail->is_return ? 'Dikembalikan' : 'Dipinjam' }}</td>
                @hasrole('mahasiswa')
                <td class="text-center">
                    {{-- <x-primary-button tag="a"
                    href="{{ route('loans.return', $detail->id) }}">kembalikan</x-primary-button> --}}
                    <x-primary-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm')"
                    x-on:click="$dispatch('set-action', '{{ route('loans.return', $detail->id) }}')">{{ __('kembalikan') }}</x-primary-button>
                </td>
                @endhasrole 
                @hasrole('pustakawan')
                <td class="text-center">
                    <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                    x-on:click="$dispatch('set-action', '{{ route('destroy', $detail->id) }}')">{{ __('Delete') }}</x-danger-button>
                </td>
                @endhasrole 
            </tr>
        @endforeach
                    </x-table>
                    <x-modal name="confirm"  focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('get')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda ingin mengembalikan Buku?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Pastikan untuk mengembalikannya sebelum 14 hari dari hari peminjaman buku') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-succes-button class="ml-3">
                                    {{ __('Kembalikan') }}
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





