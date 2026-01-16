<form method="POST"
      action="{{ isset($tarea) ? route('tareas.update', $tarea) : route('tareas.store') }}">
    @csrf
    @isset($tarea)
        @method('PUT')
    @endisset

    {{-- Punto de venta --}}
    <div class="mb-3">
        <label>Punto de venta</label>
        <select name="puntoVentaId" class="form-control">
            @foreach($puntosVenta as $pv)
                <option value="{{ $pv->id }}"
                    {{ old('puntoVentaId', $tarea->punto_venta_id ?? '') == $pv->id ? 'selected' : '' }}>
                    {{ $pv->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Nombre --}}
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control"
               value="{{ old('nombre', $tarea->nombre ?? '') }}">
    </div>

    {{-- Descripción --}}
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $tarea->descripcion ?? '') }}</textarea>
    </div>

    {{-- Frecuencia --}}
    <div class="mb-3">
        <label>Frecuencia</label>
        <select name="frecuencia" id="frecuencia" class="form-control">
            @foreach(['unica','diaria','semanal','quincenal','mensual'] as $freq)
                <option value="{{ $freq }}"
                    {{ old('frecuencia', $tarea->frecuencia ?? '') == $freq ? 'selected' : '' }}>
                    {{ ucfirst($freq) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Días de la semana --}}
    <div class="mb-3" id="dias-semana">
        <label>Días de la semana</label><br>
        @foreach([1=>'Lun',2=>'Mar',3=>'Mié',4=>'Jue',5=>'Vie',6=>'Sáb',7=>'Dom'] as $k=>$d)
            <label class="me-2">
                <input type="checkbox" name="dias_semana[]"
                       value="{{ $k }}"
                    {{ in_array($k, old('dias_semana', $tarea->dias_semana ?? [])) ? 'checked' : '' }}>
                {{ $d }}
            </label>
        @endforeach
    </div>

    {{-- Fecha inicio --}}
    <div class="mb-3">
        <label>Fecha inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
               value="{{ old('fecha_inicio', isset($tarea) ? $tarea->fecha_inicio->format('Y-m-d') : '') }}">
    </div>

    {{-- Fecha fin --}}
    <div class="mb-3" id="fecha-fin">
        <label>Fecha fin</label>
        <input type="date" name="fecha_fin" class="form-control"
               value="{{ old('fecha_fin', isset($tarea) && $tarea->fecha_fin ? $tarea->fecha_fin->format('Y-m-d') : '') }}">
    </div>

    {{-- Usuarios --}}
    <div class="mb-3">
        <label>Usuarios asignados</label>
        <select name="usuarios[]" class="form-control" multiple size="5">
            @foreach($usuarios as $u)
                <option value="{{ $u->id }}"
                    {{ in_array(
                        $u->id,
                        old('usuarios', isset($tarea) ? $tarea->usuarios->pluck('id')->toArray() : [])
                    ) ? 'selected' : '' }}>
                    {{ $u->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($tarea) ? 'Actualizar tarea' : 'Crear tarea' }}
    </button>
</form>

{{-- ================== JS ================== --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const frecuencia   = document.getElementById('frecuencia');
    const diasSemana   = document.getElementById('dias-semana');
    const fechaFin     = document.getElementById('fecha-fin');
    const fechaInicio  = document.getElementById('fecha_inicio');
    const checksDias   = document.querySelectorAll('input[name="dias_semana[]"]');

    const hoy = () => {
        const d = new Date();
        return d.toISOString().split('T')[0];
    };

    const proximoDiaSemana = (dia) => {
        const h = new Date();
        const actual = h.getDay() === 0 ? 7 : h.getDay();
        let diff = dia - actual;
        if (diff <= 0) diff += 7;
        h.setDate(h.getDate() + diff);
        return h.toISOString().split('T')[0];
    };

    function actualizarUI() {
        if (frecuencia.value === 'unica') {
            diasSemana.style.display = 'none';
            fechaFin.style.display = 'none';
            fechaInicio.value = fechaInicio.value || hoy();
        } else {
            diasSemana.style.display = 'block';
            fechaFin.style.display = 'block';
        }
    }

    checksDias.forEach(cb => {
        cb.addEventListener('change', () => {
            if (cb.checked) {
                fechaInicio.value = proximoDiaSemana(parseInt(cb.value));
            }
        });
    });

    frecuencia.addEventListener('change', actualizarUI);
    actualizarUI();
});
</script>
