<div class="card">
    <div class="card-header">
        Editar datos parametricos
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Nombre Empresa</label>
                <input type="text" class="form-control" wire:model.defer="nombre_empresa">
                @error('nombre_empresa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>RUC</label>
                <input type="text" class="form-control" wire:model.defer="ruc">
                @error('ruc') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Salario minimo</label>
                <input type="text" class="form-control" wire:model.defer="salario_minimo">
                @error('salario_minimo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Max Salario Minimo para Cobrar Bonificación Familiar</label>
                <input type="text" class="form-control" wire:model.defer="max_salario_minimo_bonif_familiar">
                @error('max_salario_minimo_bonif_familiar') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Porcentaje Bonificación Familiar</label>
                <input type="text" class="form-control" wire:model.defer="porcentaje_bonificacion_familiar">
                @error('porcentaje_bonificacion_familiar') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>C&oacute;digo para salario base</label>
                <select id="id_salario_base" wire:model="id_salario_base" class="form-select">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach($lista_conceptos as $concepto)
                        <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }}</option>
                    @endforeach
                </select>
                @error('id_salario_base') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>C&oacute;digo para bonificaci&oacute;n familiar</label>
                <select id="id_bonificacion_familiar" wire:model="id_bonificacion_familiar" class="form-select">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach($lista_conceptos as $concepto)
                        <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }}</option>
                    @endforeach
                </select>
                @error('id_bonificacion_familiar') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>C&oacute;digo para I.P.S.</label>
                <select id="id_ips" wire:model="id_ips" class="form-select">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach($lista_conceptos as $concepto)
                        <option value="{{ $concepto->id_concepto }}">{{ $concepto->nombre_concepto }}</option>
                    @endforeach
                </select>
                @error('id_ips') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
</div>