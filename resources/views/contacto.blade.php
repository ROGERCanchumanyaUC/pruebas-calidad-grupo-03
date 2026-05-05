@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<main class="page">
    <section class="page-hero">
        <div class="hero-grid">
            <div>
                <p class="eyebrow">Contacto</p>
                <h1>Cuéntanos qué necesitas y te guiamos al siguiente paso.</h1>
                <p class="lead">
                    Podemos orientarte sobre cursos, asesorías, diagnóstico de planta o seguimiento de calidad.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('cursos') }}" class="btn-outline">Ver cursos</a>
                    <a href="{{ route('servicios') }}" class="btn-outline">Ver servicios</a>
                </div>
            </div>

            <div class="hero-showcase">
                <div class="media-frame image-milk">
                    <div class="showcase-label">
                        <strong>Atención cercana</strong>
                        <span>Respondemos con una ruta clara según tu necesidad.</span>
                    </div>
                </div>

                <div class="floating-note">
                    <strong>24 h</strong>
                    <span>para recibir una primera orientación del equipo.</span>
                </div>
            </div>
        </div>
    </section>

    <section id="contacto-formulario" class="section contact-anchor">
        <div class="contact-grid">
            <div class="info-box reveal">
                <div class="contact-item">
                    <strong>Ubicación</strong>
                    Huancayo, Junín, Perú
                </div>
                <div class="contact-item">
                    <strong>WhatsApp</strong>
                    +51 987 654 321
                </div>
                <div class="contact-item">
                    <strong>Correo</strong>
                    contacto@jmjslacteos.pe
                </div>
                <div class="contact-item">
                    <strong>Horario</strong>
                    Lunes a viernes, 8:00 a.m. a 6:00 p.m.
                </div>
            </div>

            <div class="form-box reveal">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" placeholder="Tu nombre completo">
                </div>

                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input id="correo" type="email" placeholder="correo@empresa.com">
                </div>

                <div class="form-group">
                    <label for="tema">Tema</label>
                    <input id="tema" type="text" placeholder="Curso, asesoría o calidad">
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" placeholder="Cuéntanos en qué podemos ayudarte"></textarea>
                </div>

                <button class="btn-enviar" onclick="showToast('Mensaje enviado correctamente')">Enviar mensaje</button>
            </div>
        </div>
    </section>
</main>
@endsection
