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
                                    Descripción
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subcategoría
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acción
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($productos as $item)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->descripcion }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $auxsubcategoria::find($item->subcategoria)->nombre }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ $item->estado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{-- @livewire('edit-category', ['category' => $categoria], key($categoria->id)) --}}
                                        
                                        <a class="btn btn-green" wire:click="edit({{ $item }})">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-red" wire:click="$emit('deleteProduct',{{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>            
                                        
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a style="cursor: pointer" wire:click="verImagen({{$item}})"><img style="height: 39px" src="{{asset($item->imagen)}}" alt=""></a>
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($productos->hasPages())
                        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                            {{ $productos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar producto
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Subcategoría" />
                <select wire:model.defer="subcat" class="form-control">
                    @foreach ($subcategorias as $subcategoria)    
                    <option value="{{$subcategoria->id}}">{{$subcategoria->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="subcat" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Nombre del producto" />
                <x-jet-input type="text" wire:model.defer="product.nombre" class="w-full"/>
                <x-jet-input-error for="product.nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción del producto" />
                <x-jet-input type="text" wire:model.defer="product.descripcion" class="w-full"/>
                <x-jet-input-error for="product.descripcion" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Stock del producto" />
                <x-jet-input type="number" wire:model.defer="product.stock" class="w-full" min="0" step="1"/>
                <x-jet-input-error for="producto.stock" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Precio del producto" />
                <x-jet-input type="number" wire:model.defer="product.precio" class="w-full" min="0"/>
                <x-jet-input-error for="producto.precio" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Estado del producto" />
                <select name="estado" class="form-control" wire:model="product.estado">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen principal" />
                <input type="file" wire:model="imageProduct" id="{{$identificador}}">
                <x-jet-input-error for="imageProduct" />
                <br>
                <div wire:loading wire:target="imageProduct">
                    <span>Subiendo imagen</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($imageProduct)
                    <img width="100" src="{{$imageProduct->temporaryUrl()}}">
                @else
                    <img width="100" src="{{asset($product->imagen)}}">
                @endif
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen 2" />
                <input type="file" wire:model="imageProduct_1" id="{{$identificador_1}}">
                <x-jet-input-error for="imageProduct_1" />
                <br>
                <div wire:loading wire:target="imageProduct_1">
                    <span>Subiendo imagen</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($imageProduct_1)
                    <img width="100" src="{{$imageProduct_1->temporaryUrl()}}">
                @else
                    <img width="100" src="{{asset($product->imagen1)}}">
                @endif
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen 3" />
                <input type="file" wire:model="imageProduct_2" id="{{$identificador_2}}">
                <x-jet-input-error for="imageProduct_2" />
                <br>
                <div wire:loading wire:target="imageProduct_2">
                    <span>Subiendo imagen</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($imageProduct_2)
                    <img width="100" src="{{$imageProduct_2->temporaryUrl()}}">
                @else
                    <img width="100" src="{{asset($product->imagen2)}}">
                @endif
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen 4" />
                <input type="file" wire:model="imageProduct_3" id="{{$identificador_3}}">
                <x-jet-input-error for="imageProduct_3" />
                <br>
                <div wire:loading wire:target="imageProduct_3">
                    <span>Subiendo imagen</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($imageProduct_3)
                    <img width="100" src="{{$imageProduct_3->temporaryUrl()}}">
                @else
                    <img width="100" src="{{asset($product->imagen3)}}">
                @endif
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen 5" />
                <input type="file" wire:model="imageProduct_4" id="{{$identificador_4}}">
                <x-jet-input-error for="imageProduct_4" />
                <br>
                <div wire:loading wire:target="imageProduct_4">
                    <span>Subiendo imagen</span>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($imageProduct_4)
                    <img width="100" src="{{$imageProduct_4->temporaryUrl()}}">
                @else
                    <img width="100" src="{{asset($product->imagen4)}}">
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save, imageProduct">
                Guardar
            </x-jet-danger-button>
            <x-jet-secondary-button wire:click="resetModal">
                Cancelar
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="open_imagen">
        <x-slot name="title">
            Imagen
        </x-slot>
        <x-slot name="content">
            <img class="mx-auto" src="{{asset($imagenProducto->imagen)}}" alt="">
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        {{-- <script src="sweetalert2.all.min.js"></script> --}}
        <script>
            Livewire.on('deleteProduct', productId => {
                Swal.fire({
                    title: 'Advertencia',
                    text: "El producto será eliminado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('productos', 'delete', productId);

                        Swal.fire(
                            'Éxito',
                            'Producto eliminado exitosamente',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>