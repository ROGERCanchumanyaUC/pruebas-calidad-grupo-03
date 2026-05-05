@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
<main class="page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Servicios</p>
                <h1>Asesoría técnica para ordenar procesos y cumplir estándares.</h1>
                <p class="lead">
                    Diagnóstico, documentación, capacitación y seguimiento para que la mejora no se quede en teoría.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('contacto') }}#contacto-formulario" class="btn-primary">Solicitar diagnóstico</a>
                    <a href="{{ route('calidad') }}" class="btn-outline">Ver enfoque de calidad</a>
                </div>
            </div>

            <div class="hero-showcase">
                <div class="media-frame image-process">
                    <div class="showcase-label">
                        <strong>Consultoría de campo</strong>
                        <span>Revisión técnica, plan de acción y acompañamiento.</span>
                    </div>
                </div>

                <div class="floating-note">
                    <strong>Plan claro</strong>
                    <span>Entregables, responsables y prioridades desde el inicio.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <p class="eyebrow">Soluciones</p>
            <h2 class="section-title">Servicios organizados por necesidad.</h2>
            <p class="section-subtitle">Cada tarjeta responde a una decisión que el cliente puede tomar sin perderse.</p>
        </div>

        <div class="grid grid-3">
            <article class="card reveal">
                <div class="card-kicker">Diagnóstico</div>
                <h3 class="serv-title">Auditoría de planta</h3>
                <p class="serv-desc">Evaluación de procesos productivos bajo criterios BPM, HACCP e ISO 9001.</p>
                <a href="#" class="serv-link" onclick="showToast('Solicitud enviada correctamente')">Solicitar</a>
            </article>

            <article class="card accent-gold reveal">
                <div class="card-kicker">Normativa</div>
                <h3 class="serv-title">Consultoría ISO</h3>
                <p class="serv-desc">Implementación y documentación de sistemas de gestión de calidad.</p>
                <a href="#" class="serv-link" onclick="showToast('Solicitud enviada correctamente')">Solicitar</a>
            </article>

            <article class="card accent-sky reveal">
                <div class="card-kicker">Equipo</div>
                <h3 class="serv-title">Capacitación in-company</h3>
                <p class="serv-desc">Programas internos adaptados al flujo de trabajo y necesidades del personal.</p>
                <a href="#" class="serv-link" onclick="showToast('Solicitud enviada correctamente')">Solicitar</a>
            </article>

            <article class="card accent-rose reveal">
                <div class="card-kicker">Documentación</div>
                <h3 class="serv-title">Manuales y procedimientos</h3>
                <p class="serv-desc">Elaboración de manuales HACCP, POE, POES y registros de calidad.</p>
                <a href="#" class="serv-link" onclick="showToast('Solicitud enviada correctamente')">Solicitar</a>
            </article>

            <article class="card reveal">
                <div class="card-kicker">Producto</div>
                <h3 class="serv-title">Análisis técnico</h3>
                <p class="serv-desc">Evaluación sensorial, fisicoquímica y microbiológica de productos lácteos.</p>
                <a href="#" class="serv-link" onclick="showToast('Solicitud enviada correctamente')">Solicitar</a>
            </article>

            <article class="card accent-gold reveal">
                <div class="card-kicker">Acompañamiento</div>
                <h3 class="serv-title">Soporte continuo</h3>
                <p class="serv-desc">Canal de consulta para resolver dudas durante la mejora del proceso.</p>
                <a href="#" class="serv-link" onclick="showToast('Abriendo canal de atención')">Contactar</a>
            </article>
        </div>
    </section>

    <section class="section deep">
        <div class="section-header">
            <p class="eyebrow">Proceso de trabajo</p>
            <h2 class="section-title">De la revisión al resultado, paso a paso.</h2>
        </div>

        <div class="steps">
            <article class="step reveal">
                <span class="step-number">1</span>
                <h3>Revisión inicial</h3>
                <p>Escuchamos el caso y revisamos el estado actual del proceso.</p>
            </article>

            <article class="step reveal">
                <span class="step-number">2</span>
                <h3>Plan de acción</h3>
                <p>Definimos entregables, tiempos y responsables de forma simple.</p>
            </article>

            <article class="step reveal">
                <span class="step-number">3</span>
                <h3>Implementación</h3>
                <p>Acompañamos la ejecución con recomendaciones concretas.</p>
            </article>
        </div>
    </section>
</main>
@endsection
