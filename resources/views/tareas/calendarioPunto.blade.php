@extends('layouts.app')

@section('title', 'Calendario de Tareas')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
<style>
    .calendario-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: #1b4282;
    }

    .btn-back {
        background: #607d8b;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(96, 125, 139, 0.3);
    }

    .btn-back:hover {
        background: #546e7a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(96, 125, 139, 0.4);
        color: white;
    }

    .legend-container {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #555;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }

    /* Estilos del calendario */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }

    .fc {
        font-family: inherit;
    }

    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #1b4282 !important;
    }

    .fc-button {
        background: #1b4282 !important;
        border: none !important;
        padding: 8px 16px !important;
        font-weight: 600 !important;
        text-transform: capitalize !important;
        box-shadow: 0 2px 8px rgba(27, 66, 130, 0.3) !important;
        transition: all 0.3s ease !important;
    }

    .fc-button:hover {
        background: #2c5aa0 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(27, 66, 130, 0.4) !important;
    }

    .fc-button:focus {
        box-shadow: 0 0 0 3px rgba(27, 66, 130, 0.2) !important;
    }

    .fc-button-active {
        background: #0d2142 !important;
    }

    .fc-daygrid-day {
        transition: background-color 0.2s ease;
    }

    .fc-daygrid-day:hover {
        background-color: #f8f9fa;
    }

    .fc-day-today {
        background-color: rgba(27, 66, 130, 0.08) !important;
    }

    .fc-event {
        background: white !important;
        border: none !important;
        border-left: 4px solid !important;
        padding: 4px 8px !important;
        margin: 2px 0 !important;
        border-radius: 4px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        font-weight: 500 !important;
        font-size: 0.85rem !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
    }

    .fc-event:hover {
        transform: translateX(2px) !important;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15) !important;
    }

    .fc-event-time {
        display: none !important;
    }

    .fc-event-title {
        color: #2c3e50 !important;
        font-weight: 600 !important;
    }

    .fc-daygrid-event-dot {
        display: none !important;
    }

    .fc-event-title {
        font-weight: 600 !important;
    }

    .fc-list-event-time {
        display: none !important;
    }

    /* Modal de detalles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        backdrop-filter: blur(4px);
    }

    .modal-overlay.active {
        display: block;
    }

    .modal-content {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }

    .modal-content.active {
        display: block;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -48%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    .modal-header {
        background: #1b4282;
        color: white;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: start;
    }

    .modal-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
        flex: 1;
    }

    .modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .detail-section {
        margin-bottom: 1.5rem;
    }

    .detail-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 0.8rem;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .section-title i {
        color: #1b4282;
        font-size: 0.85rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }

    .detail-icon {
        color: #1b4282;
        font-size: 16px;
        width: 20px;
        text-align: center;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }

    .detail-value {
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .estado-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .estado-cancelada {
        background: #f5afafff;
        color: #d90606ff;
    }
    .estado-pendiente {
        background: #fef3c7;
        color: #d97706;
    }

    .estado-en_progreso {
        background: #dbeafe;
        color: #2563eb;
    }

    .estado-completada {
        background: #d1fae5;
        color: #059669;
    }

    .usuarios-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .usuario-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e8eef3;
        color: #1b4282;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid #c5d5e4;
    }

    .usuario-chip i {
        font-size: 0.75rem;
    }

    .no-data {
        color: #999;
        font-style: italic;
        font-size: 0.9rem;
    }

    .btn-edit-modal {
        width: 100%;
        background: #1b4282;
        color: white;
        padding: 0.75rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        margin-top: 1rem;
    }

    .btn-edit-modal:hover {
        background: #2c5aa0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(27, 66, 130, 0.3);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .calendario-container {
            padding: 1rem;
        }

        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .fc-toolbar {
            flex-direction: column !important;
            gap: 10px !important;
        }

        .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
        }

        .fc-header-toolbar {
            margin-bottom: 1rem !important;
        }

        .fc-toolbar-title {
            font-size: 1.2rem !important;
        }

        .fc-button {
            padding: 6px 12px !important;
            font-size: 0.85rem !important;
        }

        .legend-container {
            gap: 1rem;
        }

        .legend-item {
            font-size: 0.8rem;
        }

        .legend-color {
            width: 16px;
            height: 16px;
        }

        .fc-event {
            font-size: 0.75rem !important;
            padding: 4px 6px !important;
        }

        .fc-daygrid-day-number {
            font-size: 0.9rem !important;
        }

        .modal-content {
            width: 95%;
            max-height: 90vh;
        }

        .modal-title {
            font-size: 1.1rem;
        }

        .detail-item {
            padding: 0.6rem;
        }
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 1.4rem;
        }

        .calendario-container {
            padding: 0.75rem;
        }

        .legend-container {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .fc-toolbar-title {
            font-size: 1rem !important;
        }

        .fc-button {
            padding: 5px 10px !important;
            font-size: 0.8rem !important;
        }

        .fc-event {
            font-size: 0.7rem !important;
            padding: 3px 5px !important;
            gap: 4px !important;
        }

        .fc-daygrid-day-frame {
            min-height: 60px !important;
        }

        .fc-daygrid-more-link {
            font-size: 0.7rem !important;
            padding: 2px 6px !important;
        }

        .modal-header {
            padding: 1rem;
        }

        .modal-body {
            padding: 1rem;
        }

        .detail-section {
            margin-bottom: 1rem;
        }
    }

    /* Ajustes adicionales para vista de lista en móvil */
    @media (max-width: 768px) {
        .fc-list-event {
            flex-wrap: wrap !important;
        }

        .fc-list-event-title {
            font-size: 0.85rem !important;
        }

        .fc-list-day-cushion {
            padding: 8px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-calendar-alt"></i>
        Calendario de tareas para {{ $puntoVenta->nombre }}
    </h1>
    <a href="{{ route('puntos-venta.tareas.index', $puntoVenta) }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="calendario-container">
    <div class="legend-container">
         <div class="legend-item">
            <div class="legend-color" style="background: #f50b0bff;"></div>
            <span>Cancelada</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background: #f59e0b;"></div>
            <span>Pendiente</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background: #3b82f6;"></div>
            <span>En Progreso</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background: #10b981;"></div>
            <span>Completada</span>
        </div>
    </div>

    <div id="calendar"></div>
</div>

<!-- Modal de detalles -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal()"></div>
<div class="modal-content" id="modalContent">
    <div class="modal-header">
        <h3 class="modal-title" id="modalTitle"></h3>
        <button class="modal-close" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body" id="modalBody">
        <!-- Se llenará dinámicamente -->
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/es.global.min.js"></script>

<script>
let calendar;

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            list: 'Lista'
        },
        displayEventTime: false,
        allDaySlot: true,
        height: 'auto',
        contentHeight: 'auto',
        aspectRatio: 1.8,
        dayMaxEvents: 3,
        moreLinkClick: 'popover',
        moreLinkContent: function(args) {
            return `+${args.num} más`;
        },
        events: '{{ route("puntos-venta.calendario.data", $puntoVenta) }}',
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            showEventDetails(info.event);
        },
        eventDidMount: function(info) {
            const estado = info.event.extendedProps.estado;
            const puntoVenta = info.event.extendedProps.punto_venta || '';
            
            let color = '#6b7280';
            switch(estado) {
                case 'pendiente':
                    color = '#f59e0b';
                    break;
                case 'en_progreso':
                    color = '#3b82f6';
                    break;
                case 'completada':
                    color = '#10b981';
                    break;
                case 'cancelada':
                    color = '#b91010ff';
                    break;
            }
            
            // Crear el circulo de color
            const dot = document.createElement('span');
            dot.style.cssText = `
                width: 10px;
                height: 10px;
                background-color: ${color};
                border-radius: 50%;
                display: inline-block;
                flex-shrink: 0;
                margin-right: 6px;
            `;
            
            // Buscar el contenedor del título
            const titleEl = info.el.querySelector('.fc-event-title');
            if (titleEl) {
                // Limpiar contenido existente
                const originalTitle = info.event.title;
                titleEl.innerHTML = '';
                
                // Agregar circulo
                titleEl.appendChild(dot);
                
                // Agregar título
                const titleText = document.createElement('span');
                titleText.textContent = originalTitle;
                titleText.style.fontWeight = '600';
                titleEl.appendChild(titleText);
                
                // Agregar punto de venta si existe
                if (puntoVenta) {
                    const pvText = document.createElement('span');
                    pvText.textContent = ` • ${puntoVenta}`;
                    pvText.style.cssText = 'color: #6b7280; font-weight: 500; font-size: 0.8rem;';
                    titleEl.appendChild(pvText);
                }
            }
        },
        eventMouseEnter: function(info) {
            info.el.style.filter = 'brightness(0.98)';
        },
        eventMouseLeave: function(info) {
            info.el.style.filter = 'brightness(1)';
        }
    });
    
    calendar.render();
});

function showEventDetails(event) {
    const props = event.extendedProps;
    
    document.getElementById('modalTitle').textContent = event.title;
    
    let estadoClass = '';
    let estadoText = '';
    switch(props.estado) {
        case 'cancelada':
            estadoClass = 'estado-cancelada';
            estadoText = 'Cancelada';
            break;
        case 'pendiente':
            estadoClass = 'estado-pendiente';
            estadoText = 'Pendiente';
            break;
        case 'en_progreso':
            estadoClass = 'estado-en_progreso';
            estadoText = 'En Progreso';
            break;
        case 'completada':
            estadoClass = 'estado-completada';
            estadoText = 'Completada';
            break;
    }
    
    let usuariosHTML = '<div class="no-data">Sin usuarios asignados</div>';
    if (props.usuarios && props.usuarios.length > 0) {
        usuariosHTML = '<div class="usuarios-chips">';
        props.usuarios.forEach(usuario => {
            usuariosHTML += `
                <span class="usuario-chip">
                    <i class="fas fa-user"></i>
                 ${usuario.nombre} ${usuario.primerApellido}
                </span>
            `;
        });
        usuariosHTML += '</div>';
    }
    
    const modalBody = `
        <div class="detail-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i>
                Información General
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar detail-icon"></i>
                <div class="detail-content">
                    <div class="detail-label">Fecha</div>
                    <div class="detail-value">${formatDate(event.start)}</div>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-flag detail-icon"></i>
                <div class="detail-content">
                    <div class="detail-label">Estado</div>
                    <div class="detail-value">
                        <span class="estado-badge ${estadoClass}">${estadoText}</span>
                    </div>
                </div>
            </div>
        </div>

        ${props.descripcion ? `
        <div class="detail-section">
            <div class="section-title">
                <i class="fas fa-align-left"></i>
                Descripción
            </div>
            <div class="detail-item">
                <div class="detail-content">
                    <div class="detail-value">${props.descripcion}</div>
                </div>
            </div>
        </div>
        ` : ''}

        ${props.punto_venta || props.cliente ? `
        <div class="detail-section">
            <div class="section-title">
                <i class="fas fa-map-marker-alt"></i>
                Ubicación
            </div>
            ${props.punto_venta ? `
            <div class="detail-item">
                <i class="fas fa-store detail-icon"></i>
                <div class="detail-content">
                    <div class="detail-label">Punto de servicio</div>
                    <div class="detail-value">${props.punto_venta}</div>
                </div>
            </div>
            ` : ''}
            ${props.cliente ? `
            <div class="detail-item">
                <i class="fas fa-building detail-icon"></i>
                <div class="detail-content">
                    <div class="detail-label">Cliente</div>
                    <div class="detail-value">${props.cliente}</div>
                </div>
            </div>
            ` : ''}
        </div>
        ` : ''}

        ${props.proyecto ? `
        <div class="detail-section">
            <div class="section-title">
                <i class="fas fa-project-diagram"></i>
                Proyecto
            </div>
            <div class="detail-item">
                <div class="detail-content">
                    <div class="detail-value">${props.proyecto}</div>
                </div>
            </div>
        </div>
        ` : ''}

        <div class="detail-section">
            <div class="section-title">
                <i class="fas fa-users"></i>
                Usuarios Asignados
            </div>
            ${usuariosHTML}
        </div>

    `;
    
    document.getElementById('modalBody').innerHTML = modalBody;
    document.getElementById('modalOverlay').classList.add('active');
    document.getElementById('modalContent').classList.add('active');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.getElementById('modalContent').classList.remove('active');
}

function formatDate(date) {
    const d = new Date(date);
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    return d.toLocaleDateString('es-ES', options);
}

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection