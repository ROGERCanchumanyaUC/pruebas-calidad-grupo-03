@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<main class="page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Capacitaciones</p>
                <h1>Cursos con enfoque práctico para equipos del sector lácteo.</h1>
                <p class="lead">
                    Aprendizaje claro, casos reales y criterios técnicos para aplicar desde el primer módulo.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('contacto') }}#contacto-formulario" class="btn-primary">Consultar matrícula</a>
                    <a href="{{ route('servicios') }}" class="btn-outline">Capacitación para empresa</a>
                </div>
            </div>

            <div class="hero-showcase">
                <div class="media-frame image-cheese">
                    <div class="showcase-label">
                        <strong>BPM en Industria Láctea</strong>
                        <span>La ruta más directa para fortalecer buenas prácticas.</span>
                    </div>
                </div>

                <div class="mini-dashboard">
                    <div class="dash-row"><span>Precio</span><strong>S/ 350</strong></div>
                    <div class="dash-row"><span>Duración</span><strong>8 semanas</strong></div>
                    <div class="dash-row"><span>Entrega</span><strong>Certificado</strong></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <p class="eyebrow">Catálogo</p>
            <h2 class="section-title">Programas pensados para aprender y ejecutar.</h2>
            <p class="section-subtitle">Cada curso ordena objetivos, duración y resultado esperado para que el cliente compare fácilmente.</p>
        </div>

        <div class="grid grid-3">
            <article class="card reveal">
                <div class="curso-cat">Calidad · Certificación</div>
                <h3 class="curso-title">BPM en Industria Láctea</h3>
                <p class="curso-desc">Buenas Prácticas de Manufactura aplicadas al procesamiento de leche y derivados.</p>
                <div class="curso-meta">
                    <span>8 semanas</span>
                    <span>Certificado</span>
                    <span>Online</span>
                </div>
                <div class="section-actions">
                    <button class="btn-add" onclick="showToast('Inscripción iniciada')">Inscribirme</button>
                </div>
            </article>

            <article class="card accent-gold reveal">
                <div class="curso-cat">Normas · ISO</div>
                <h3 class="curso-title">Gestión de Calidad ISO 9001</h3>
                <p class="curso-desc">Implementación de sistemas de gestión de calidad en empresas del rubro alimentario.</p>
                <div class="curso-meta">
                    <span>10 semanas</span>
                    <span>Plantillas</span>
                    <span>Online</span>
                </div>
                <div class="section-actions">
                    <button class="btn-add" onclick="showToast('Inscripción iniciada')">Inscribirme</button>
                </div>
            </article>

            <article class="card accent-rose reveal">
                <div class="curso-cat">Laboratorio</div>
                <h3 class="curso-title">Control Microbiológico</h3>
                <p class="curso-desc">Técnicas y protocolos para control microbiológico en plantas lácteas.</p>
                <div class="curso-meta">
                    <span>6 semanas</span>
                    <span>Protocolos</span>
                    <span>Online</span>
                </div>
                <div class="section-actions">
                    <button class="btn-add" onclick="showToast('Inscripción iniciada')">Inscribirme</button>
                </div>
            </article>
        </div>
    </section>

    <section class="section alt">
        <div class="split">
            <div>
                <p class="eyebrow">Metodología</p>
                <h2 class="section-title">La clase se convierte en acción.</h2>
                <p class="section-subtitle">El cliente no solo mira contenido: entiende qué debe revisar, documentar y mejorar.</p>
            </div>

            <div class="feature-panel reveal">
                <ul class="list-clean">
                    <li>Sesiones breves con objetivos por módulo.</li>
                    <li>Casos aplicados a plantas y negocios lácteos.</li>
                    <li>Materiales descargables para el equipo.</li>
                    <li>Orientación final para aplicar lo aprendido.</li>
                </ul>
            </div>
        </div>
    </section>
</main>
@endsection
