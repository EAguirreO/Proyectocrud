<div>
    <div class="px-2">
        <div class="mb-3">
            <label class="form-label" for="direccion">Dirección:</label>
            <input class="form-control" id="direccion" type="text" wire:model.defer="direccion" placeholder="Dirección">
            @error($direccion)
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="referencia">Referencia:</label>
            <input class="form-control" id="referencia" type="text" wire:model.defer="referencia" placeholder="Referencia">
            @error($referencia)
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <div style="width: 30%">
                <label class="form-label" for="departamento">Departamento:</label>
                <select id="departamento" wire:model="selectedDepartamento" class="form-select">
                    <option value="" selected>Departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div style="width: 30%;">
                <label class="form-label" for="provincia">Provincia:</label>
                @if (!is_null($selectedDepartamento))
                <select id=provincia wire:model="selectedProvincia" class="form-select">
                    <option value="" selected>Provincia</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                    @endforeach
                </select>
                @endif
            </div>
            <div style="width: 30%;">
                <label class="form-label" for="distrito">Distrito:</label>
                @if(!is_null($selectedProvincia))
                <select id="distrito" wire:model="selectedDistrito" class="form-select">
                    <option value="" selected>Distrito</option>
                    @foreach ($distritos as $distrito)
                        <option value="{{$distrito->id}}">{{$distrito->nombre}}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>
        <button class="btn btn-success" wire:click="save" wire:loading.attr="disabled" wire:target="save">Continuar</button>
    </div>
</div>
