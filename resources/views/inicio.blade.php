@extends('layouts.app')

@section('title', 'Inicio')

@push('styles')
<style>
    .home-page .image-plant {
        background-image: url("{{ asset('img/planta-jmjs.png') }}");
        background-position: center;
    }

    .home-page .program-card {
        padding: 0;
    }

    .home-page .program-media {
        position: relative;
        height: 192px;
        overflow: hidden;
        border-bottom: 1px solid var(--line);
        background: var(--mint);
    }

    .home-page .program-media img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .home-page .program-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 10px;
        border-radius: var(--radius);
        color: var(--leaf-dark);
        background: var(--mint);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .home-page .program-body {
        padding: 24px;
    }

    .home-page .program-footer {
        margin-top: 20px;
        padding-top: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        border-top: 1px solid var(--line);
    }

    .home-page .program-price {
        color: var(--ink);
        font-size: 15px;
        font-weight: 700;
        white-space: nowrap;
    }

    .home-page .program-link {
        min-height: 42px;
        padding: 10px 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius);
        color: #fff;
        background: var(--leaf);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .18s ease, transform .18s ease;
    }

    .home-page .program-link:hover {
        color: #fff;
        background: var(--leaf-dark);
        transform: translateY(-2px);
    }

    .home-page .category-tabs {
        display: inline-flex;
        gap: 4px;
        padding: 4px;
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background: var(--mint);
    }

    .home-page .category-tabs button {
        min-height: 38px;
        padding: 10px 18px;
        border: 0;
        border-radius: var(--radius);
        color: var(--muted);
        background: transparent;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
    }

    .home-page .category-tabs button.is-active {
        color: var(--leaf-dark);
        background: #fff;
        box-shadow: 0 2px 8px rgba(24, 38, 33, 0.08);
    }

    @media (max-width: 700px) {
        .home-page .program-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .home-page .program-link {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<main class="page home-page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Formación alimentaria</p>
                <h1>Capacítate con expertos en calidad alimentaria.</h1>
                <p class="lead">
                    Accede a cursos y asesorías especializadas en BPM, inocuidad y gestión de calidad para mejorar los procesos de tu empresa.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('cursos') }}" class="btn-primary">Explorar catálogo</a>
                    <a href="{{ route('servicios') }}" class="btn-outline">Solicitar auditoría</a>
                </div>
            </div>

            <div class="hero-showcase">
                <div class="media-frame image-plant">
                    <div class="showcase-label">
                        <strong>JM y JS</strong>
                        <span>Producción láctea profesional y mejora continua.</span>
                    </div>
                </div>

                <div class="floating-note">
                    <strong>ISO 22000</strong>
                    <span>Rutas formativas para inocuidad y control de calidad.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section alt">
        <div class="section-header">
            <div>
                <p class="eyebrow">Catálogo</p>
                <h2 class="section-title">Programas de Formación</h2>
                <p class="section-subtitle">Capacitación certificada para el aseguramiento de la calidad.</p>
            </div>

            <div class="category-tabs" aria-label="Categorías">
                <button class="is-active" type="button">Cursos</button>
                <button type="button">Asesorías</button>
            </div>
        </div>

        <div class="grid grid-3">
            <article class="card program-card reveal">
                <div class="program-media">
                    <img
                        src="https://images.unsplash.com/photo-1581092162384-8987c1d64718?auto=format&fit=crop&w=900&q=82"
                        alt="Lista de verificación para implementación de BPM">
                    <span class="program-badge">Básico</span>
                </div>
                <div class="program-body">
                    <h3 class="card-title">Implementación de BPM en la Industria Alimentaria</h3>
                    <p>Domina los principios de las Buenas Prácticas de Manufactura para asegurar la inocuidad y calidad en todos los procesos.</p>
                    <div class="program-footer">
                        <span class="program-price">S/ 250.00</span>
                        <a class="program-link" href="{{ route('cursos') }}">Inscribirme</a>
                    </div>
                </div>
            </article>

            <article class="card program-card accent-sky reveal">
                <div class="program-media">
                    <img
                        src="https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=900&q=82"
                        alt="Laboratorio de control de inocuidad alimentaria">
                    <span class="program-badge">Avanzado</span>
                </div>
                <div class="program-body">
                    <h3 class="card-title">Sistema HACCP y Gestión de Riesgos</h3>
                    <p>Aprende a identificar, evaluar y controlar peligros significativos para la inocuidad según normativas internacionales.</p>
                    <div class="program-footer">
                        <span class="program-price">S/ 450.00</span>
                        <a class="program-link" href="{{ route('cursos') }}">Inscribirme</a>
                    </div>
                </div>
            </article>

            <article class="card program-card accent-gold reveal">
                <div class="program-media">
                    <img
                        src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=900&q=82"
                        alt="Profesionales revisando documentación de auditoría interna">
                    <span class="program-badge">Intermedio</span>
                </div>
                <div class="program-body">
                    <h3 class="card-title">Formación de Auditores Internos ISO 22000</h3>
                    <p>Desarrolla competencias para planificar y ejecutar auditorías internas efectivas en sistemas de gestión de inocuidad.</p>
                    <div class="program-footer">
                        <span class="program-price">S/ 380.00</span>
                        <a class="program-link" href="{{ route('cursos') }}">Inscribirme</a>
                    </div>
                </div>
            </article>
        </div>
    </section>
</main>
@endsection
