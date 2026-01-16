<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Mantenimiento #{{ $reporte->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family:'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #1b4282 0%, #2c5aa0 100%);
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .header-logo {
            position: absolute;
            top: 15px;
            right: 20px;
            width: 80px;
            height: auto;
        }

        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
            color: #2c3e50
        }

        .company-info {
            font-size: 8px;
            opacity: 0.9;
            line-height: 1.3;
             color: #2c3e50
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0 5px 0;
             color: #2c3e50
        }

        .header-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .header-item {
            display: table-cell;
            padding: 5px;
            width: 25%;
             color: #2c3e50
        }

        .header-label {
            font-size: 8px;
            opacity: 0.9;
            margin-bottom: 2px;
             color: #2c3e50
        }

        .header-value {
            font-size: 11px;
            font-weight: bold;
             color: #2c3e50
        }

        .section-title {
            background: #f0f0f0;
            border-left: 4px solid #1b4282;
            padding: 8px 12px;
            margin: 15px 0 10px;
            font-size: 12px;
            font-weight: bold;
            color: #2c3e50;
        }

        .data-grid {
            display: table;
            width: 100%;
            margin-bottom: 12px;
        }

        .data-row {
            display: table-row;
        }

        .data-item {
            display: table-cell;
            padding: 8px;
            border: 1px solid #e0e0e0;
            background: #fafafa;
            width: 33.33%;
            vertical-align: top;
        }

        .data-label {
            font-size: 8px;
            color: #666;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .data-value {
            font-size: 10px;
            color: #2c3e50;
        }

        .text-block {
            border: 1px solid #e0e0e0;
            background: #fafafa;
            padding: 10px;
            margin-bottom: 12px;
        }

        .text-block-label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 9px;
            color: #555;
        }

        .text-block-content {
            font-size: 9px;
            line-height: 1.5;
            white-space: pre-wrap;
        }

        .checklist-group {
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            padding: 8px;
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .checklist-title {
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 10px;
            color: #2c3e50;
        }

        .checklist-items {
            display: table;
            width: 100%;
        }

        .check-row {
            display: table-row;
        }

        .check-item {
            display: table-cell;
            padding: 3px;
            font-size: 9px;
            width: 33.33%;
        }

        .check-icon {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #999;
            margin-right: 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 8px;
        }

        .check-icon.checked {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        .medicion-card {
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            padding: 8px;
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .medicion-card.valid {
            border-color: #28a745;
            border-left: 3px solid #28a745;
        }

        .medicion-card.invalid {
            border-color: #dc3545;
            border-left: 3px solid #dc3545;
        }

        .medicion-title {
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 10px;
        }

        .medicion-parametros {
            background: white;
            border: 1px solid #ddd;
            padding: 5px;
            margin-bottom: 6px;
            font-size: 8px;
        }

        .medicion-valores {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }

        .medicion-valor {
            display: table-cell;
            padding: 5px;
            background: white;
            border: 1px solid #ddd;
            width: 50%;
        }

        .medicion-valor-label {
            font-size: 8px;
            color: #666;
            margin-bottom: 2px;
        }

        .medicion-valor-value {
            font-size: 11px;
            font-weight: bold;
        }

        .medicion-analisis {
            background: white;
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 8px;
            line-height: 1.4;
        }

        .medicion-analisis.valid {
            border-color: #28a745;
            color: #155724;
        }

        .medicion-analisis.invalid {
            border-color: #dc3545;
            color: #721c24;
        }

        .usuarios-list {
            display: table;
            width: 100%;
            margin-bottom: 12px;
        }

        .usuario-row {
            display: table-row;
        }

        .usuario-item {
            display: table-cell;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            padding: 6px;
            width: 50%;
            font-size: 9px;
        }

        .firma-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .firma-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .firma-item {
            display: table-cell;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
            width: 50%;
        }

        .firma-image {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 8px;
            height: 70px;
            background: white;
        }

        .firma-image img {
            max-width: 100%;
            max-height: 60px;
        }

        .firma-info {
            font-size: 9px;
        }

        .firma-nombre {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .images-section {
            margin-top: 20px;
            page-break-before: always;
        }

        .images-grid {
            display: table;
            width: 100%;
        }

        .image-row {
            display: table-row;
        }

        .image-item {
            display: table-cell;
            padding: 8px;
            text-align: center;
            width: 50%;
            vertical-align: top;
        }

        .image-container {
            border: 1px solid #dee2e6;
            padding: 6px;
            background: #fafafa;
        }

        .image-container img {
            max-width: 100%;
            max-height: 180px;
            display: block;
            margin: 0 auto;
        }

        .image-caption {
            font-size: 8px;
            color: #666;
            margin-top: 4px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #999;
            padding: 8px 0;
            border-top: 1px solid #ddd;
        }

        .page-number:after {
            content: counter(page);
        }

        .observaciones-firmas {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .observaciones-box {
            border: 1px solid #e0e0e0;
            background: #fafafa;
            padding: 10px;
            margin-bottom: 15px;
            min-height: 60px;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        @if(file_exists(public_path('/img/Logo.png')))
            <img src="{{ public_path('/img/Logo.png') }}" alt="Logo" class="header-logo">
        @endif
        
        <div class="company-name">DDI WASTE WATER TREATMENT COSTA RICA S.A</div>
        <div class="company-info">
            ÚLTIMA PARK II, OFIBODEGA 68, Escazú<br>
            Contacto: 8319-5146
        </div>
        
        <div class="header-title">REPORTE DE MANTENIMIENTO #{{ $reporte->id }}</div>
        
        <div class="header-grid">
            <div class="header-item">
                <div class="header-label">Punto de Venta</div>
                <div class="header-value">{{ $reporte->puntoVenta->nombre }}</div>
            </div>
            <div class="header-item">
                <div class="header-label">Tipo de Mantenimiento</div>
                <div class="header-value">{{ $reporte->tipoMantenimiento->nombre }}</div>
            </div>
            <div class="header-item">
                <div class="header-label">Fecha</div>
                <div class="header-value">{{ \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') }}</div>
            </div>
            <div class="header-item">
                <div class="header-label">Contrato</div>
                <div class="header-value">{{ $reporte->contrato }}</div>
            </div>
        </div>
    </div>

    <!-- Datos Generales -->
    <div class="section-title">Datos Generales del Mantenimiento</div>
    
    <div class="data-grid">
        <div class="data-row">
            <div class="data-item">
                <div class="data-label">Tipo de Planta</div>
                <div class="data-value">{{ $reporte->tipoPlanta }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Costo Total</div>
                <div class="data-value">{{ number_format($reporte->costoTotal, 2) }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Referencia</div>
                <div class="data-value">{{ $reporte->referencia ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <div class="text-block">
        <div class="text-block-label">Descripción del Mantenimiento</div>
        <div class="text-block-content">{{ $reporte->descripcion }}</div>
    </div>

    <!-- Datos del Equipo -->
    <div class="section-title">Datos del Equipo</div>
    
    <div class="data-grid">
        <div class="data-row">
            <div class="data-item">
                <div class="data-label">Marca</div>
                <div class="data-value">{{ $reporte->marca }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Modelo</div>
                <div class="data-value">{{ $reporte->modelo }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Serie</div>
                <div class="data-value">{{ $reporte->serie }}</div>
            </div>
        </div>
    </div>

    <!-- Checklist -->
    @if($reporte->checks && count($reporte->checks) > 0)
    <div class="section-title">Revisión de mantenimiento</div>
    
    @foreach($reporte->checks as $grupo => $items)
        <div class="checklist-group">
            <div class="checklist-title">{{ Str::headline($grupo) }}</div>
            <div class="checklist-items">
                @php
                    $itemsArray = is_array($items) ? $items : (is_object($items) ? (array)$items : []);
                    $chunks = array_chunk($itemsArray, 3, true);
                @endphp
                @foreach($chunks as $chunk)
                    <div class="check-row">
                        @foreach($chunk as $key => $value)
                            <div class="check-item">
                                <span class="check-icon {{ $value ? 'checked' : '' }}">{{ $value ? 'X' : '' }}</span>
                                {{ config("reportes.checks.{$grupo}.{$key}") }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @endif

    <!-- Mediciones -->
    @if($reporte->mediciones && count($reporte->mediciones) > 0)
    <div class="section-title">Mediciones y Ajustes (Verde indica que los valores se encuentran bien y el rojo lo contrario)</div>
    
    @foreach($reporte->mediciones as $medicion)
        @php
            $parametro = $medicion->ajusteParametro;
            $esValido = false;
            
            if ($parametro && $medicion->medicionFinal !== null) {
                if ($parametro->tipo === 'ENTRE') {
                    $esValido = $medicion->medicionFinal >= $parametro->primerValor && 
                               $medicion->medicionFinal <= $parametro->segundoValor;
                } elseif ($parametro->tipo === 'MAYOR_QUE') {
                    $esValido = $medicion->medicionFinal > $parametro->primerValor;
                } elseif ($parametro->tipo === 'MENOR_QUE') {
                    $esValido = $medicion->medicionFinal < $parametro->primerValor;
                }
            }
        @endphp
        
        <div class="medicion-card {{ $esValido ? 'valid' : 'invalid' }}">
            <div class="medicion-title">
                {{ $parametro->nombre ?? 'Parámetro Desconocido' }}
            </div>
            
            @if($parametro)
            <div class="medicion-parametros">
                <strong>Parámetros:</strong>
                @if($parametro->tipo === 'ENTRE')
                    Entre {{ $parametro->primerValor }} y {{ $parametro->segundoValor }}
                @elseif($parametro->tipo === 'MAYOR_QUE')
                    Mayor que {{ $parametro->primerValor }}
                @else
                    Menor que {{ $parametro->primerValor }}
                @endif
            </div>
            @endif
            
            <div class="medicion-valores">
                <div class="medicion-valor">
                    <div class="medicion-valor-label">Medición Inicial</div>
                    <div class="medicion-valor-value">{{ $medicion->medicionInicial ?? 'N/A' }}</div>
                </div>
                <div class="medicion-valor">
                    <div class="medicion-valor-label">Medición Final</div>
                    <div class="medicion-valor-value">{{ $medicion->medicionFinal ?? 'N/A' }}</div>
                </div>
            </div>
            
            @if($medicion->analisisFuncionamiento)
            <div class="medicion-analisis {{ $esValido ? 'valid' : 'invalid' }}">
                {{ $medicion->analisisFuncionamiento }}
            </div>
            @endif
        </div>
    @endforeach
    @endif

    <!-- Horario -->
    <div class="section-title">Horario de Inspección</div>
    
    <div class="data-grid">
        <div class="data-row">
            <div class="data-item">
                <div class="data-label">Hora Inicial</div>
                <div class="data-value">{{ \Carbon\Carbon::parse($reporte->horaInicial)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Hora Final</div>
                <div class="data-value">{{ \Carbon\Carbon::parse($reporte->horaFinal)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="data-item">
                <div class="data-label">Duración</div>
                <div class="data-value">
                    @php
                        $inicio = \Carbon\Carbon::parse($reporte->horaInicial);
                        $fin = \Carbon\Carbon::parse($reporte->horaFinal);
                        $diff = $inicio->diff($fin);
                    @endphp
                    {{ $diff->h }}h {{ $diff->i }}min
                </div>
            </div>
        </div>
    </div>

    <!-- Usuarios -->
    @if($reporte->usuarios && count($reporte->usuarios) > 0)
    <div class="section-title">Usuarios de Inspección ({{ count($reporte->usuarios) }})</div>
    
    <div class="usuarios-list">
        @php
            $usuariosChunks = $reporte->usuarios->chunk(2);
        @endphp
        @foreach($usuariosChunks as $chunk)
            <div class="usuario-row">
                @foreach($chunk as $usuario)
                    <div class="usuario-item">
                        {{ $usuario->nombre }} {{ $usuario->primerApellido }}
                    </div>
                @endforeach
                @if($chunk->count() == 1)
                    <div class="usuario-item" style="border: none; background: transparent;"></div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- Recomendaciones -->
    <div class="section-title">Recomendaciones</div>
    <div class="text-block">
        <div class="text-block-content">{{ $reporte->recomendaciones }}</div>
    </div>

    <!-- Observaciones y Firmas -->
    <div class="observaciones-firmas">
        <!-- Observaciones -->
        @if($reporte->observaciones)
        <div class="section-title">Observaciones</div>
        <div class="observaciones-box">
            <div class="text-block-content">{{ $reporte->observaciones }}</div>
        </div>
        @endif

        <!-- Firmas -->
        @if($reporte->firmas && count($reporte->firmas) > 0)
        <div class="section-title">Firmas y Autorización</div>
        
        <div class="firma-grid">
            @foreach($reporte->firmas as $firma)
                <div class="firma-item">
                    <div class="firma-image">
                        @if($firma->firmaRuta && file_exists(public_path('storage/' . $firma->firmaRuta)))
                            <img src="{{ public_path('storage/' . $firma->firmaRuta) }}" alt="Firma">
                        @else
                            <div style="padding: 20px; color: #999;">_____________________</div>
                        @endif
                    </div>
                    <div class="firma-info">
                        <div class="firma-nombre">{{ $firma->nombreFirmante ?? 'Sin nombre' }}</div>
                        <div>Cédula: {{ $firma->cedulaFirmante ?? 'Sin cédula' }}</div>
                    </div>
                </div>
                @if($loop->odd && !$loop->last)
                @endif
            @endforeach
        </div>
        @endif
    </div>

    <!-- Imágenes (nueva página) -->
    @if($reporte->imagenes && count($reporte->imagenes) > 0)
    <div class="images-section">
        <div class="section-title">Evidencia Fotográfica ({{ count($reporte->imagenes) }})</div>
        
        <div class="images-grid">
            @foreach($reporte->imagenes->chunk(2) as $chunk)
                <div class="image-row">
                    @foreach($chunk as $imagen)
                        <div class="image-item">
                            <div class="image-container">
                                @if(file_exists(public_path('storage/' . $imagen->imagenRuta)))
                                    <img src="{{ public_path('storage/' . $imagen->imagenRuta) }}" alt="Imagen {{ $loop->parent->iteration * 2 - (2 - $loop->iteration) }}">
                                @else
                                    <div style="padding: 40px; color: #999; border: 1px dashed #ccc;">Imagen no disponible</div>
                                @endif
                                <div class="image-caption">Imagen {{ $loop->parent->iteration * 2 - (2 - $loop->iteration) }}</div>
                            </div>
                        </div>
                    @endforeach
                    @if($chunk->count() == 1)
                        <div class="image-item"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Pie de página -->
    <div class="footer">
        DDI WASTE WATER TREATMENT COSTA RICA S.A | ÚLTIMA PARK II, OFIBODEGA 68, Escazú | Contacto: 8319-5146 | Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} | Página <span class="page-number"></span>
    </div>
</body>
</html>