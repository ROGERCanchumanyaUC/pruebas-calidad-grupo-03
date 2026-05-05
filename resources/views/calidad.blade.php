@extends('layouts.app')

@section('title', 'Calidad')

@section('content')
<main class="page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Calidad</p>
                <h1>Estándares claros para trabajar con confianza.</h1>
                <p class="lead">
                    Presentamos la calidad como una guía práctica: seguridad, rendimiento, usabilidad y mejora continua.
                </p>
            </div>

            <aside class="info-panel">
                <h2>Enfoque</h2>
                <p>
                    Revisamos procesos, documentación e indicadores para encontrar mejoras aplicables y fáciles de mantener.
                </p>
            </aside>
        </div>
    </section>

    <section class="section">
        <div class="split">
            <div>
                <p class="eyebrow">Criterios</p>
                <h2 class="section-title">Qué revisamos en cada proyecto.</h2>
                <p class="section-subtitle">
                    La calidad se comunica en puntos simples para que el equipo entienda qué hacer y por qué importa.
                </p>
            </div>

            <ul class="quality-list">
                <li>Sistema diseñado bajo ISO/IEC 25010.</li>
                <li>Procesos alineados a buenas prácticas de manufactura.</li>
                <li>Transacciones y datos tratados con criterios de seguridad.</li>
                <li>Materiales claros para capacitación y seguimiento.</li>
                <li>Recomendaciones de mejora continua para el cliente.</li>
            </ul>
        </div>
    </section>

    <section class="section alt">
        <div class="section-header">
            <p class="eyebrow">Indicadores</p>
            <h2 class="section-title">Métricas fáciles de leer.</h2>
        </div>

        <div class="grid grid-2">
            <div class="info-panel reveal" style="padding: 3rem;">
                <h3>Calidad del sistema</h3>
                <div class="progress-list">
                    <div class="progress-row">
                        <div class="progress-label"><span>Seguridad</span><span>96%</span></div>
                        <div class="progress-track"><div class="progress-fill" style="width:96%"></div></div>
                    </div>
                    <div class="progress-row">
                        <div class="progress-label"><span>Rendimiento</span><span>92%</span></div>
                        <div class="progress-track"><div class="progress-fill" style="width:92%"></div></div>
                    </div>
                    <div class="progress-row">
                        <div class="progress-label"><span>Usabilidad</span><span>94%</span></div>
                        <div class="progress-track"><div class="progress-fill" style="width:94%"></div></div>
                    </div>
                    <div class="progress-row">
                        <div class="progress-label"><span>Satisfacción</span><span>98%</span></div>
                        <div class="progress-track"><div class="progress-fill" style="width:98%"></div></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-2" style="gap: 1.5rem;">
                <article class="metric reveal">
                    <strong>24/7</strong>
                    <span>Disponibilidad de atención digital</span>
                </article>
                <article class="metric reveal">
                    <strong>4</strong>
                    <span>Criterios centrales de evaluación</span>
                </article>
                <article class="metric reveal">
                    <strong>BPM</strong>
                    <span>Base para procesos seguros</span>
                </article>
                <article class="metric reveal">
                    <strong>ISO</strong>
                    <span>Referencia para gestión ordenada</span>
                </article>
            </div>
        </div>
    </section>
</main>
@endsection
