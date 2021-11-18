<div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Categoría
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Orden
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($subcategorias as $item)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$auxcategoria::find($item->categoria)->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->orden }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" @class(['bg-green-100'=>$item->estado==='Activo', 'text-green-800'=>$item->estado==='Activo'])>
                                            {{ $item->estado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{-- @livewire('edit-category', ['category' => $categoria], key($categoria->id)) --}}
                                        <a class="btn btn-green" wire:click="edit({{ $item }})">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-red" wire:click="$emit('deleteSubcategory',{{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($subcategorias->hasPages())
                        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                            {{ $subcategorias->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar subcategoría
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Categoría" />
                <select wire:model.defer="cat" class="form-control">
                    @foreach ($categorias as $categoria)    
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre de la subcategoría" />
                <x-jet-input type="text" wire:model="subcategory.nombre" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Orden de la subcategoría" />
                <x-jet-input type="number" wire:model="subcategory.orden" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Estado de la subcategoría" />
                <select name="estado" class="form-control" wire:model="subcategory.estado">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save">
                Guardar
            </x-jet-danger-button>
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        {{-- <script src="sweetalert2.all.min.js"></script> --}}
        <script>
            Livewire.on('deleteSubcategory', subcategoryId => {
                Swal.fire({
                    title: 'Advertencia',
                    text: "La subcategoría será eliminada",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('subcategorias', 'delete', subcategoryId);

                        Swal.fire(
                            'Éxito',
                            'Subcategoría eliminada exitosamente',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush

</div>