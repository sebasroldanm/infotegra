<div>
    <div class="mb-4 flex justify-between">
        <div class="flex gap-4">
            <button wire:click="saveData" wire:loading.attr="disabled" class="px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 disabled:opacity-50 flex items-center gap-2">
                <span wire:loading.remove>Guardar en Base de Datos</span>
                <span wire:loading class="flex items-center gap-2">Guardar en Base de Datos</span>
            </button>
            <a href="{{ route('database') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                Ver Registros
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
                @foreach ($characters as $character)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $character['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $character['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $character['status'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $character['species'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="showDetails({{ $character['id'] }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Detalle
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Controls -->
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <button wire:click="prevPage"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md {{ !$infoApi['prev'] ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                    {{ !$infoApi['prev'] ? 'disabled' : '' }}>
                    Previous
                </button>
                <span class="text-gray-600">Page {{ $currentPage }} of {{ $infoApi['pages'] }}</span>
                <button wire:click="nextPage"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md {{ !$infoApi['next'] || $currentPage >= $maxPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                    {{ !$infoApi['next'] || $currentPage >= $maxPages ? 'disabled' : '' }}>
                    Next
                </button>
            </div>
            <div class="text-gray-600">
                Total Characters: {{ $infoApi['count'] }}
            </div>
        </div>
    </div>

    @if ($selectedCharacter)
        <div
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-xl max-w-md">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold">Character Details</h2>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
                <img src="{{ $selectedCharacter['image'] }}" alt="{{ $selectedCharacter['name'] }}"
                    class="w-full rounded-lg mb-4">
                <div class="space-y-2">
                    <p><strong>Type:</strong> {{ $selectedCharacter['type'] ?: 'N/A' }}</p>
                    <p><strong>Gender:</strong> {{ $selectedCharacter['gender'] }}</p>
                    <p><strong>Origin:</strong> {{ $selectedCharacter['origin']['name'] }}</p>
                    <p><strong>Origin URL:</strong> {{ $selectedCharacter['origin']['url'] }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
