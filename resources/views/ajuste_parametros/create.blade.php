@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('styles')
<style>
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

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e0e0e0;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg,  #1b4282 0%,#5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
    }

    .btn-secondary {
        background: #f5f7fa;
        color: #555;
        border: 2px solid #e0e0e0;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
        border-color: #d0d0d0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')

<div class="form-container">
    <form method="POST" action="{{ route('ajuste_parametros.store') }}">
        @csrf

        @include('ajuste_parametros.partials.form')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Guardar parámetro
            </button>
            <a href="{{ route('ajuste_parametros.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection