@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')
<main class="page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Nuestra empresa</p>
                <h1>Conocimiento técnico con una atención cercana.</h1>
                <p class="lead">
                    JM y JS Alimentos Lácteos acompaña a empresas y profesionales que quieren mejorar su calidad sin perder claridad en el proceso.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('servicios') }}" class="btn-primary">Conocer servicios</a>
                    <a href="{{ route('contacto') }}#contacto-formulario" class="btn-outline">Hablar con nosotros</a>
                </div>
            </div>

            <div class="hero-showcase">
                <div class="media-frame image-dairy-line">
                    <div class="showcase-label">
                        <strong>Especialistas en lácteos</strong>
                        <span>Formación, asesoría y mejora continua para el sector.</span>
                    </div>
                </div>

                <div class="floating-note">
                    <strong>Huancayo</strong>
                    <span>Trabajo técnico orientado al contexto peruano.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="grid grid-2">
            <article class="card reveal">
                <div class="card-kicker">Misión</div>
                <h2 class="card-title">Elevar la calidad productiva.</h2>
                <p>Ayudamos a que empresas y profesionales trabajen con procesos más ordenados, seguros y sostenibles.</p>
            </article>

            <article class="card accent-gold reveal">
                <div class="card-kicker">Visión</div>
                <h2 class="card-title">Ser referentes en calidad láctea.</h2>
                <p>Acercamos herramientas técnicas a más negocios del sector alimentario en el Perú.</p>
            </article>
        </div>
    </section>

    <section class="section alt">
        <div class="section-header">
            <p class="eyebrow">Forma de trabajo</p>
            <h2 class="section-title">Valores que el cliente puede notar.</h2>
        </div>

        <div class="grid grid-4">
            <article class="card reveal">
                <div class="card-kicker">01</div>
                <h3 class="card-title">Calidad</h3>
                <p>Criterios BPM e ISO adaptados al contexto real de cada cliente.</p>
            </article>

            <article class="card accent-gold reveal">
                <div class="card-kicker">02</div>
                <h3 class="card-title">Claridad</h3>
                <p>Explicaciones directas, sin lenguaje innecesariamente complejo.</p>
            </article>

            <article class="card accent-sky reveal">
                <div class="card-kicker">03</div>
                <h3 class="card-title">Cercanía</h3>
                <p>Acompañamiento antes, durante y después del servicio o curso.</p>
            </article>

            <article class="card accent-rose reveal">
                <div class="card-kicker">04</div>
                <h3 class="card-title">Mejora</h3>
                <p>Resultados medibles y recomendaciones concretas para avanzar.</p>
            </article>
        </div>
    </section>
</main>
@endsection
