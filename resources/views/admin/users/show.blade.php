<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-blue-200 dark:border-slate-700">
                <div class="p-6 text-blue-900 dark:text-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Detail Pengguna: {{ $user->name }}</h3>
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <strong>Nama:</strong> {{ $user->name }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div>
                            <strong>Password:</strong> ********
                        </div>
                        <div>
                            <strong>Role:</strong> {{ $user->getRoleNames()->first() }}
                        </div>
                        <div>
                            <strong>Dibuat Pada:</strong> {{ $user->created_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <strong>Diupdate Pada:</strong> {{ $user->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
