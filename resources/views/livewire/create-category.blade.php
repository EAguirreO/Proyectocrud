<div>
    <x-jet-danger-button wire:click="$set('open', true)" class="mb-4">
        Crear nueva categoria
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nueva categoría
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre de la categoría" />
                <x-jet-input type="text" wire:model.defer="nombre" class="w-full"/>
                <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Orden de la categoría" />
                <x-jet-input type="number" wire:model.defer="orden" class="w-full"/>
                <x-jet-input-error for="orden" />
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
