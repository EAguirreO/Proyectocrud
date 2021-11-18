<div>
    <x-jet-danger-button wire:click="$set('open', true)" class="mb-4">
        Crear nuevo producto
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo producto
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Subcategoría" />
                <select wire:model.defer="subcat" class="form-control">
                    <option selected value="">Seleccionar</option>
                    @foreach ($subcategorias as $subcategoria)    
                    <option value="{{$subcategoria->id}}">{{$subcategoria->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="subcat" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Nombre del producto" />
                <x-jet-input type="text" wire:model.defer="nombre" class="w-full"/>
                <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción del producto" />
                <x-jet-input type="text" wire:model.defer="descripcion" class="w-full"/>
                <x-jet-input-error for="descripcion" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Stock del producto" />
                <x-jet-input type="number" wire:model.defer="stock" class="w-full" min="0" step="1"/>
                <x-jet-input-error for="stock" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Precio del producto" />
                <x-jet-input type="number" wire:model.defer="precio" class="w-full" min="0"/>
                <x-jet-input-error for="precio" />
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
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, imageProduct, imageProduct_1, imageProduct_2, imageProduct_3, imageProduct_4">
                Guardar
            </x-jet-danger-button>
            <x-jet-secondary-button wire:click="resetModal">
                Cancelar
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
