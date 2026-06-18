@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<main class="page">
    <section class="chc-hero">
        {{-- Fondo decorativo --}}
        <div class="chc-blob chc-blob-1"></div>
        <div class="chc-blob chc-blob-2"></div>
        <div class="chc-dots"></div>

        <div class="chc-inner">

            {{-- Columna izquierda: texto --}}
            <div class="chc-left">
                <div class="rv-wrap">
                    <span class="chc-eyebrow rv rv-d1">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Soporte &amp; Contacto
                    </span>
                </div>

                <div class="rv-wrap">
                    <h1 class="chc-title rv rv-d2">Estamos aquí para guiarte en cada paso.</h1>
                </div>

                <p class="chc-lead curtain-text">
                    Podemos orientarte sobre cursos, asesorías, diagnóstico de planta o seguimiento de calidad alimentaria. Te respondemos con una ruta clara.
                </p>

                <div class="chc-actions rv rv-d4">
                    <a href="#contacto-formulario" class="chc-btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Enviar consulta
                    </a>
                    <a href="{{ route('cursos') }}" class="chc-btn-outline">Ver cursos</a>
                </div>

                {{-- Trust pills --}}
                <div class="chc-trust">
                    <span class="chc-trust-pill">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Respuesta &lt; 24 h
                    </span>
                    <span class="chc-trust-pill">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Atención personalizada
                    </span>
                    <span class="chc-trust-pill">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Lun–Vie 8am–6pm
                    </span>
                </div>
            </div>

            {{-- Columna derecha: tarjetas de contacto --}}
            <div class="chc-right">

                {{-- Tarjeta principal: tiempo de respuesta --}}
                <div class="chc-card chc-card-response">
                    <div class="chc-card-icon-wrap">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="chc-response-body">
                        <div class="chc-response-value">&lt; 24 h</div>
                        <div class="chc-response-label">Tiempo promedio de respuesta</div>
                    </div>
                    <div class="chc-online-dot">
                        <span></span>En línea
                    </div>
                </div>

                {{-- Tarjeta: vías de contacto --}}
                <div class="chc-card chc-card-methods">
                    <div class="chc-methods-title">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12"/><path d="M1.63 3.4 2 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.7a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.27 16"/></svg>
                        Contacto directo
                    </div>
                    <a href="https://wa.me/51987654321" target="_blank" rel="noopener" class="chc-method-link chc-method-wa">
                        <div class="chc-method-icon chc-icon-wa">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                        </div>
                        <div>
                            <span class="chc-method-name">WhatsApp</span>
                            <span class="chc-method-val">+51 987 654 321</span>
                        </div>
                        <svg class="chc-method-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="mailto:contacto@jmjsalimentos.pe" class="chc-method-link chc-method-mail">
                        <div class="chc-method-icon chc-icon-mail">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <span class="chc-method-name">Correo</span>
                            <span class="chc-method-val">contacto@jmjsalimentos.pe</span>
                        </div>
                        <svg class="chc-method-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                {{-- Fila inferior: ubicación + horario --}}
                <div class="chc-cards-row">
                    <div class="chc-card chc-card-sm">
                        <div class="chc-sm-icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="chc-sm-label">Ubicación</div>
                            <div class="chc-sm-val">Huancayo, Junín</div>
                        </div>
                    </div>
                    <div class="chc-card chc-card-sm">
                        <div class="chc-sm-icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div class="chc-sm-label">Atención</div>
                            <div class="chc-sm-val">Lun–Vie · 8am–6pm</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="contacto-formulario" class="cf-section contact-anchor">
        <div class="cf-blob cf-blob-1"></div>
        <div class="cf-blob cf-blob-2"></div>

        <div class="cf-grid">

            {{-- ── Panel de información ── --}}
            <div class="cf-info reveal">
                <div class="cf-info-tag">Contáctanos</div>
                <h2 class="cf-info-title">¿En qué podemos ayudarte?</h2>
                <p class="cf-info-lead">Respondemos con orientación clara y personalizada en menos de 24 horas.</p>

                <div class="cf-items">
                    <div class="cf-item">
                        <div class="cf-item-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div class="cf-item-text">
                            <strong>Ubicación</strong>
                            <span>Huancayo, Junín, Perú</span>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-item-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.7a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.27 16z"/></svg>
                        </div>
                        <div class="cf-item-text">
                            <strong>WhatsApp</strong>
                            <span>+51 987 654 321</span>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-item-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div class="cf-item-text">
                            <strong>Correo</strong>
                            <span>contacto@jmjsalimentos.pe</span>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-item-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div class="cf-item-text">
                            <strong>Horario</strong>
                            <span>Lunes a viernes, 8:00 a.m. a 6:00 p.m.</span>
                        </div>
                    </div>
                </div>

                <div class="cf-guarantee">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Respuesta garantizada en menos de 24 h
                </div>
            </div>

            {{-- ── Panel de formulario ── --}}
            <div class="cf-form reveal">
                <div class="cf-form-header">
                    <h3>Envíanos tu consulta</h3>
                    <p>Cuéntanos qué necesitas y encontraremos la mejor solución para ti.</p>
                </div>

                <form id="form-contacto" novalidate>
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <div class="cf-input-wrap">
                        <svg class="cf-input-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input id="nombre" name="nombre" type="text" placeholder="Tu nombre completo">
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <div class="cf-input-wrap">
                        <svg class="cf-input-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input id="correo" name="correo" type="email" placeholder="correo@empresa.com">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label-row">
                        <div class="label-icon">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <label for="tema">Tema de consulta</label>
                    </div>
                    <select id="tema">
                        <option value="" disabled selected>Selecciona un tema…</option>
                        <option value="cursos">🎓 Inscripción a un curso</option>
                        <option value="asesoria">🔬 Asesoría técnica</option>
                        <option value="diagnostico">🏭 Diagnóstico de planta</option>
                        <option value="calidad">✅ Gestión de calidad</option>
                        <option value="empresa">👥 Capacitación para empresa</option>
                        <option value="otro">💬 Otro</option>
                    </select>
                </div>

                <div class="form-group" id="grupo-curso">
                    <div class="label-row">
                        <div class="label-icon">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <label for="curso">Curso de interés</label>
                        <span class="curso-badge-count">
                            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            9 disponibles
                        </span>
                    </div>
                    <div class="curso-select-wrap">
                        <select id="curso">
                            <option value="" disabled selected>Selecciona el curso…</option>
                            <optgroup label="— Básico">
                                <option>BPM en Industria Alimentaria — S/ 350</option>
                                <option>Procesamiento de Alimentos Artesanales — S/ 280</option>
                                <option>Pasteurización y Tratamiento Térmico — S/ 290</option>
                            </optgroup>
                            <optgroup label="— Intermedio">
                                <option>Gestión de Calidad ISO 9001 — S/ 450</option>
                                <option>Elaboración de Alimentos Fermentados — S/ 320</option>
                                <option>Análisis Fisicoquímico de Alimentos — S/ 360</option>
                            </optgroup>
                            <optgroup label="— Avanzado">
                                <option>Control Microbiológico en Alimentos — S/ 380</option>
                                <option>HACCP en Plantas de Alimentos — S/ 420</option>
                                <option>Gestión de Inocuidad Alimentaria ISO 22000 — S/ 480</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" placeholder="Cuéntanos en qué podemos ayudarte"></textarea>
                </div>

                <button type="submit" id="btn-enviar" class="cf-btn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Enviar mensaje
                </button>
                </form>
            </div>

        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
/* ═══════════════════════════════════════
   HERO DE CONTACTO
═══════════════════════════════════════ */
.chc-hero {
    position: relative;
    background: linear-gradient(135deg, #040d1f 0%, #071730 45%, #0a1f5c 100%);
    padding: calc(76px + 72px) clamp(18px, 5vw, 64px) 90px;
    overflow: hidden;
    color: #fff;
}

/* Blobs decorativos */
.chc-blob {
    position: absolute; border-radius: 50%;
    filter: blur(110px); pointer-events: none; opacity: .28;
}
.chc-blob-1 { width: 580px; height: 580px; background: #0ea5e9; top: -200px; right: -100px; }
.chc-blob-2 { width: 440px; height: 440px; background: #6366f1; bottom: -160px; left: -80px; }

/* Grid de puntos decorativo */
.chc-dots {
    position: absolute; inset: 0; pointer-events: none; opacity: .07;
    background-image: radial-gradient(circle, #7dd3fc 1px, transparent 1px);
    background-size: 36px 36px;
}

/* Layout interior */
.chc-inner {
    position: relative; z-index: 2;
    max-width: 1180px; margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;
}

/* ── Columna izquierda ── */
.chc-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(14,165,233,.18);
    border: 1px solid rgba(14,165,233,.35);
    color: #7dd3fc;
    font-size: 11.5px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 6px 16px; border-radius: 30px;
    margin-bottom: 20px;
}
.chc-title {
    font-family: 'Noto Serif', serif;
    font-size: clamp(30px, 3.8vw, 52px);
    font-weight: 700; color: #fff;
    line-height: 1.13; margin-bottom: 20px;
    letter-spacing: -.3px;
}
.chc-lead {
    font-size: 16.5px; color: rgba(255,255,255,.72);
    line-height: 1.72; margin-bottom: 32px; max-width: 520px;
}
.chc-actions {
    display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 36px;
}
.chc-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, #0284c7, #075985);
    color: #fff; font-size: 14.5px; font-weight: 700;
    padding: 13px 26px; border-radius: 12px; text-decoration: none;
    box-shadow: 0 8px 24px rgba(2,132,199,.4);
    transition: transform .2s, box-shadow .2s;
}
.chc-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(2,132,199,.5); }
.chc-btn-outline {
    display: inline-flex; align-items: center;
    border: 1.5px solid rgba(255,255,255,.35); color: #fff;
    font-size: 14.5px; font-weight: 600;
    padding: 13px 26px; border-radius: 12px; text-decoration: none;
    transition: background .2s, border-color .2s;
    backdrop-filter: blur(4px);
}
.chc-btn-outline:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.6); }
.chc-trust {
    display: flex; flex-wrap: wrap; gap: 10px;
}
.chc-trust-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.12);
    color: rgba(255,255,255,.75);
    font-size: 12px; font-weight: 600;
    padding: 6px 14px; border-radius: 20px;
}
.chc-trust-pill svg { color: #7dd3fc; }

/* ── Columna derecha: tarjetas ── */
.chc-right { display: flex; flex-direction: column; gap: 16px; }

.chc-card {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 24px 28px;
    transition: background .2s, border-color .2s;
}
.chc-card:hover { background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.2); }

/* Tarjeta respuesta */
.chc-card-response {
    display: flex; align-items: center; gap: 18px;
}
.chc-card-icon-wrap {
    width: 52px; height: 52px; flex-shrink: 0;
    background: rgba(14,165,233,.18);
    border: 1px solid rgba(14,165,233,.3);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #7dd3fc;
}
.chc-response-body { flex: 1; }
.chc-response-value {
    font-size: 28px; font-weight: 800; color: #fff; line-height: 1;
}
.chc-response-label { font-size: 12.5px; color: rgba(255,255,255,.55); margin-top: 4px; }
.chc-online-dot {
    display: flex; align-items: center; gap: 7px;
    font-size: 12px; font-weight: 600; color: #86efac;
    background: rgba(34,197,94,.12);
    border: 1px solid rgba(34,197,94,.25);
    padding: 5px 12px; border-radius: 20px; white-space: nowrap;
}
.chc-online-dot span {
    width: 7px; height: 7px; border-radius: 50%;
    background: #4ade80;
    animation: chc-pulse 2s ease-in-out infinite;
    display: inline-block;
}
@keyframes chc-pulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%      { opacity: .4; transform: scale(.7); }
}

/* Tarjeta métodos */
.chc-methods-title {
    display: flex; align-items: center; gap: 7px;
    font-size: 11.5px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .8px; color: rgba(255,255,255,.5);
    margin-bottom: 16px;
}
.chc-method-link {
    display: flex; align-items: center; gap: 14px;
    padding: 12px 16px; border-radius: 12px;
    text-decoration: none; color: #fff;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.09);
    margin-bottom: 10px;
    transition: background .2s, border-color .2s, transform .15s;
}
.chc-method-link:last-child { margin-bottom: 0; }
.chc-method-link:hover { background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.22); transform: translateX(4px); }
.chc-method-icon {
    width: 38px; height: 38px; flex-shrink: 0;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.chc-icon-wa   { background: rgba(37,211,102,.2); color: #4ade80; }
.chc-icon-mail { background: rgba(2,132,199,.2);  color: #7dd3fc; }
.chc-method-name {
    display: block; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px; color: rgba(255,255,255,.5);
}
.chc-method-val { font-size: 13.5px; font-weight: 600; color: #fff; }
.chc-method-arrow { margin-left: auto; color: rgba(255,255,255,.3); flex-shrink: 0; }

/* Fila inferior: dos mini-tarjetas */
.chc-cards-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.chc-card-sm   { display: flex; align-items: center; gap: 14px; padding: 18px 20px; }
.chc-sm-icon {
    width: 38px; height: 38px; flex-shrink: 0;
    background: rgba(14,165,233,.15);
    border: 1px solid rgba(14,165,233,.25);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #7dd3fc;
}
.chc-sm-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: rgba(255,255,255,.45); margin-bottom: 3px; }
.chc-sm-val   { font-size: 13px; font-weight: 600; color: #fff; }

/* Responsive */
@media (max-width: 960px) {
    .chc-inner { grid-template-columns: 1fr; gap: 48px; }
    .chc-hero  { padding-bottom: 60px; }
}
@media (max-width: 580px) {
    .chc-cards-row { grid-template-columns: 1fr; }
    .chc-title { font-size: clamp(26px, 6vw, 36px); }
}

/* ── Select base (igual que inputs) ── */
.form-group select {
    width: 100%;
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 11px 40px 11px 14px;
    font-family: inherit;
    font-size: 15px;
    color: #1e293b;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%230284c7' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    line-height: 1.5;
}
.form-group select:focus {
    border-color: var(--leaf);
    box-shadow: 0 0 0 4px rgba(2,132,199,.12);
}
.form-group select option {
    color: #1e293b;
    font-size: 14px;
    padding: 8px;
}
.form-group select optgroup {
    font-weight: 700;
    color: var(--leaf-dark);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

/* ── Label con ícono ── */
.form-group .label-row {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 7px;
}
.form-group .label-row label {
    margin-bottom: 0;
}
.form-group .label-icon {
    width: 18px;
    height: 18px;
    border-radius: 5px;
    background: var(--mint);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.form-group .label-icon svg { color: var(--leaf); }

/* ── Grupo curso animado ── */
#grupo-curso {
    display: none;
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transition: max-height .38s cubic-bezier(.4,0,.2,1),
                opacity .28s ease,
                margin .28s ease;
    margin-top: 0;
}
#grupo-curso.abierto {
    display: block;
    max-height: 160px;
    opacity: 1;
    margin-top: 0;
}

/* Contenedor especial del selector de curso */
.curso-select-wrap {
    position: relative;
}
.curso-select-wrap::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, var(--leaf), var(--gold));
    border-radius: 4px 0 0 4px;
}
.curso-select-wrap select {
    padding-left: 18px;
    background-color: #f0f9ff;
    border-color: rgba(2,132,199,.3);
}
.curso-select-wrap select:focus {
    background-color: #fff;
}

/* Badge de cursos disponibles */
.curso-badge-count {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    color: var(--leaf);
    background: var(--mint);
    padding: 3px 9px;
    border-radius: 20px;
    margin-left: auto;
}

/* ═══════════════════════════════════════
   SECCIÓN DE CONTACTO — REDISEÑO
═══════════════════════════════════════ */
.cf-section {
    position: relative;
    padding: 90px clamp(18px, 5vw, 64px);
    overflow: hidden;
    background: linear-gradient(135deg, #040d1f 0%, #071730 40%, #0a1f5c 100%);
}
.cf-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(110px);
    pointer-events: none;
    opacity: .3;
}
.cf-blob-1 { width: 520px; height: 520px; background: #0ea5e9; top: -160px; right: -60px; }
.cf-blob-2 { width: 420px; height: 420px; background: #3b82f6; bottom: -130px; left: -80px; }

.cf-grid {
    position: relative; z-index: 2;
    max-width: 1160px; margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.45fr;
    gap: 28px;
    align-items: start;
}

/* ── Panel izquierdo: Información ── */
.cf-info {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 24px;
    padding: 40px 36px;
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    color: #fff;
    position: sticky;
    top: 100px;
}
.cf-info-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(14,165,233,.18);
    border: 1px solid rgba(14,165,233,.32);
    color: #7dd3fc;
    font-size: 11px; font-weight: 700;
    letter-spacing: 1.2px; text-transform: uppercase;
    padding: 5px 14px; border-radius: 20px;
    margin-bottom: 20px;
}
.cf-info-title {
    font-family: 'Noto Serif', serif;
    font-size: clamp(22px, 2.4vw, 30px);
    font-weight: 700; color: #fff;
    line-height: 1.2; margin-bottom: 12px;
}
.cf-info-lead {
    font-size: 14.5px; color: rgba(255,255,255,.60);
    line-height: 1.65; margin-bottom: 32px;
}
.cf-items { display: flex; flex-direction: column; }
.cf-item {
    display: flex; align-items: center; gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid rgba(255,255,255,.09);
    transition: background .2s;
}
.cf-item:last-child { border-bottom: none; }
.cf-item-icon {
    width: 44px; height: 44px; flex-shrink: 0;
    background: rgba(14,165,233,.15);
    border: 1px solid rgba(14,165,233,.28);
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    color: #7dd3fc;
    transition: background .2s, border-color .2s, transform .2s;
}
.cf-item:hover .cf-item-icon {
    background: rgba(14,165,233,.28);
    border-color: rgba(14,165,233,.5);
    transform: scale(1.08);
}
.cf-item-text strong {
    display: block;
    font-size: 11px; font-weight: 800; color: #93c5fd;
    text-transform: uppercase; letter-spacing: .8px; margin-bottom: 3px;
}
.cf-item-text span { font-size: 14.5px; color: rgba(255,255,255,.78); }
.cf-guarantee {
    display: flex; align-items: center; gap: 10px;
    margin-top: 26px; padding: 14px 18px;
    background: rgba(34,197,94,.1);
    border: 1px solid rgba(34,197,94,.22);
    border-radius: 12px;
    font-size: 13px; font-weight: 600; color: #86efac;
}

/* ── Panel derecho: Formulario ── */
.cf-form {
    background: #fff;
    border-radius: 24px;
    padding: 42px 40px;
    box-shadow: 0 40px 90px rgba(0,0,0,.30), 0 0 0 1px rgba(255,255,255,.06);
}
.cf-form-header { margin-bottom: 28px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9; }
.cf-form-header h3 {
    font-family: 'Noto Serif', serif;
    font-size: 22px; font-weight: 700;
    color: #0b2538; margin-bottom: 6px;
}
.cf-form-header p { font-size: 14px; color: #64748b; }

/* Inputs con icono */
.cf-input-wrap { position: relative; }
.cf-input-icon {
    position: absolute; left: 14px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8; pointer-events: none;
    transition: color .2s;
}
.cf-input-wrap input { padding-left: 42px !important; }
.cf-input-wrap:focus-within .cf-input-icon { color: #0284c7; }

/* Overrides para inputs dentro de cf-form */
.cf-form .form-group { margin-bottom: 18px; }
.cf-form .form-group label {
    font-size: 12.5px; font-weight: 800;
    color: #334155; letter-spacing: .4px;
    text-transform: uppercase; margin-bottom: 8px;
}
.cf-form .form-group input,
.cf-form .form-group textarea {
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    background: #f8fafc;
    font-size: 14.5px; color: #0b2538;
    transition: border-color .2s, box-shadow .2s, background .2s;
}
.cf-form .form-group input::placeholder,
.cf-form .form-group textarea::placeholder { color: #94a3b8; }
.cf-form .form-group input:focus,
.cf-form .form-group textarea:focus {
    border-color: #0284c7;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(2,132,199,.1);
}
.cf-form .form-group select {
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    background-color: #f8fafc;
    font-size: 14.5px; color: #0b2538;
}
.cf-form .form-group select:focus {
    border-color: #0284c7;
    box-shadow: 0 0 0 4px rgba(2,132,199,.1);
    background-color: #fff;
}
.cf-form .form-group textarea { min-height: 130px; }

/* Botón */
.cf-btn {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    padding: 15px 28px; margin-top: 6px;
    background: linear-gradient(135deg, #0284c7 0%, #075985 100%);
    color: #fff; font-size: 15px; font-weight: 700;
    border: none; border-radius: 12px; cursor: pointer;
    letter-spacing: .3px;
    box-shadow: 0 10px 28px rgba(2,132,199,.38);
    transition: transform .2s, box-shadow .2s, background .2s;
}
.cf-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(2,132,199,.48);
    background: linear-gradient(135deg, #0369a1 0%, #0c4a6e 100%);
}
.cf-btn:active { transform: translateY(0); }
.cf-btn:disabled { opacity: .6; cursor: not-allowed; transform: none; box-shadow: none; }

/* Responsive */
@media (max-width: 960px) {
    .cf-grid { grid-template-columns: 1fr; }
    .cf-info  { position: static; }
}
@media (max-width: 580px) {
    .cf-form  { padding: 28px 20px; }
    .cf-info  { padding: 28px 20px; }
    .cf-section { padding: 60px clamp(16px, 4vw, 32px); }
}
</style>
@endpush

@push('scripts')
<script>
/* ── Toggle curso select ── */
document.getElementById('tema').addEventListener('change', function () {
    const grupo = document.getElementById('grupo-curso');
    const curso = document.getElementById('curso');

    if (this.value === 'cursos') {
        grupo.style.display = 'block';
        void grupo.offsetHeight;
        grupo.classList.add('abierto');
    } else {
        grupo.classList.remove('abierto');
        setTimeout(() => { grupo.style.display = 'none'; curso.value = ''; }, 320);
    }
});

/* ── Envío AJAX ── */
document.getElementById('form-contacto').addEventListener('submit', async function (e) {
    e.preventDefault();

    const btn     = document.getElementById('btn-enviar');
    const nombre  = document.getElementById('nombre').value.trim();
    const correo  = document.getElementById('correo').value.trim();
    const tema    = document.getElementById('tema').value;
    const curso   = document.getElementById('curso').value;
    const mensaje = document.getElementById('mensaje').value.trim();

    // Validación básica frontend
    if (!nombre || !correo || !tema || !mensaje) {
        showToast('Por favor completa todos los campos.');
        return;
    }

    btn.disabled    = true;
    btn.textContent = 'Enviando…';

    try {
        const res = await fetch('{{ route("contacto.enviar") }}', {
            method:  'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept':       'application/json',
            },
            body: JSON.stringify({ nombre, correo, tema, curso: curso || null, mensaje }),
        });

        const data = await res.json();

        if (res.ok && data.ok) {
            showToast('✅ Mensaje enviado correctamente. Te responderemos pronto.');

            // Limpiar formulario
            document.getElementById('nombre').value  = '';
            document.getElementById('correo').value  = '';
            document.getElementById('tema').value    = '';
            document.getElementById('mensaje').value = '';
            document.getElementById('curso').value   = '';

            // Ocultar grupo curso
            const grupo = document.getElementById('grupo-curso');
            grupo.classList.remove('abierto');
            setTimeout(() => { grupo.style.display = 'none'; }, 320);
        } else {
            const errors = data.errors ? Object.values(data.errors).flat().join(' ') : 'Error al enviar.';
            showToast('❌ ' + errors);
        }
    } catch {
        showToast('❌ Error de conexión. Intenta de nuevo.');
    } finally {
        btn.disabled    = false;
        btn.textContent = 'Enviar mensaje';
    }
});
</script>
@endpush
