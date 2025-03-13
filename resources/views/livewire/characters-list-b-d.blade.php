<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button wire:click="$refresh" class="text-green-700 hover:text-green-900">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
    @endif
    <div class="mb-4 flex justify-between">
        <div class="flex gap-4">
            <a href="{{ route('welcome') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                Ver API
            </a>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especie
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($characters->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            No se encontraron personajes.
                        </td>
                    </tr>
                @else
                    @foreach ($characters as $character)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $character['id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $character['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $character['status'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $character['species'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="editDetails({{ $character['id'] }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- Add pagination links -->
        <div class="mt-4">
            {{ $characters->links() }}
        </div>

        <!-- Edit Modal -->
        @if ($editingCharacter)
            <div
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
                <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-xl font-bold">Editar Personaje</h2>
                        <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateCharacter">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" wire:model="editingCharacter.name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                <input type="text" wire:model="editingCharacter.status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Especie</label>
                                <input type="text" wire:model="editingCharacter.species"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo</label>
                                <input type="text" wire:model="editingCharacter.type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Género</label>
                                <input type="text" wire:model="editingCharacter.gender"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
