<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar categoría {{$category->nombre}}
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre de la categoría" />
                <x-jet-input type="text" wire:model="category.nombre" class="w-full"/>
                <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Orden de la categoría" />
                <x-jet-input type="number" wire:model="category.orden" class="w-full"/>
                <x-jet-input-error for="orden" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Estado de la categoría" />
                <select name="estado" class="form-control" wire:model="category.estado">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Guardar
            </x-jet-danger-button>
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
