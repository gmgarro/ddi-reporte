<?php

//aqui se ponen los checks que van relacionados al reporte de mantenimiento
return[
    'checks' =>[

        'actividadesOperacionPTAR'=>[
            'retirarSolidosGruesos' => 'Retirar sólidos gruesos retenidos en las rejillas',
            'retirarMaterialFlotante' => 'Retirar material flotante de sedimentadores o reactores biológico',
            'disposicionSolidosMaterialFlotante' => 'Disposición de sólidos y material flotante',
            'recirculacionLodosActivados' => 'Recirculación de lodos activados al reactor aerobico o bioselector',
            'recogerMaterialTrampasExtraerArenas' => 'Recoger material de las trampas flotantes y extraer arenas del fondo',
            'purgarSedimentadores' => 'Purgas los sedimentores (Reactor biológico) y enviar lodos a biodigestor',
            'aireacionReactoresAerobicos' => 'Aireación de los reactores aerobicos',
            'limpiezaMantenimientoTanqueBombeo' => 'Limpieza y mantenimiento del tanque de bombeo de aguas***',
        ],
        'actividadesMantenimientoElectromecanico'=>[
            'revisarNivelesAceiteBombas'=>'Revisar niveles de aceite en bombas',
            'revisionAceiteMotores'=>'Revisión de aceite en motores',
            'revisionSustitucionLucesPanelControl'=>'Revisión / Sustitución de luces en panel de control',
            'revisionVoltajeAmperajeEquipos'=>'Revisión de voltaje y amperaje en equipos',
            'revisionNivelRuidoEquipos'=>'Revisión de nivel de ruido en equipos',
            'revisionMotobombas' => 'Revisión de motobombas',
            'revisionCorreccionInstalacionElecPtar' => 'Revisión / Corrección de instalación eléctrica general de la PTAR',
            'revisionNivelesCorrosionTuberiasHG' => 'Revisión de niveles de corrosión en tuberías  HG',
        ],
        'actividadesControlOperacionalProcesos'=>[
            'medicionTempPhSSedCaudalEfluente' => 'Medición de TEMP, PH, SSed y Caudal en efluente',
            'medicionSSedTanqueAireacion' => 'Medición de SSed en tanque de aireación (Plantas aerobias)',
            'medicionOxigenoDisueltoTanqueAireacion' => 'Medición de oxígeno disuelto en tanque de aireación',
            'controlNivelLodoRa' => 'Control de nivel de lodo en RA',
        ],
        'otro' =>[
            'revisionSeedSalidaRa' => 'Revisión de SSed a la salida del RA',
            'tomaMuestrasQuimicas' => 'Toma de muestras para análisis fisicoquímicos (2 veces al año)',
        ],
    ],

];