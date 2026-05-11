@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<main class="page">

    {{-- ── Hero ── --}}
    <section class="ch-hero">
        {{-- Fondo animado --}}
        <div class="ch-bg"></div>
        <div class="ch-overlay"></div>
        <div class="ch-blob ch-blob-1"></div>
        <div class="ch-blob ch-blob-2"></div>

        <div class="ch-inner">
            {{-- Columna izquierda --}}
            <div class="ch-left">
                <span class="ch-eyebrow">
                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    Capacitaciones · Sector Alimentario
                </span>

                <h1 class="ch-title">
                    Fórmate con los <em>mejores expertos</em> en calidad alimentaria del Perú.
                </h1>

                <p class="ch-lead">
                    9 programas certificados en BPM, HACCP e ISO. Diseñados para técnicos, jefes de planta y emprendedores del sector alimentario. Aprende a tu ritmo, aplica desde el primer módulo.
                </p>

                {{-- Stats pills --}}
                <div class="ch-pills">
                    <span class="ch-pill">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        9 cursos certificados
                    </span>
                    <span class="ch-pill">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        4 a 12 semanas
                    </span>
                    <span class="ch-pill">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        100% online
                    </span>
                    <span class="ch-pill">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Desde S/ 280
                    </span>
                </div>

                <div class="ch-actions">
                    <a href="#catalogo" class="ch-btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                        Ver catálogo completo
                    </a>
                    <a href="{{ route('contacto') }}#contacto-formulario" class="ch-btn-outline">
                        Consultar matrícula
                    </a>
                </div>
            </div>

            {{-- Columna derecha: tarjeta destacada --}}
            <div class="ch-right">
                <div class="ch-card">
                    <div class="ch-card-img">
                        <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?auto=format&fit=crop&w=700&q=88" alt="Curso destacado">
                        <span class="ch-card-badge">Más popular</span>
                    </div>
                    <div class="ch-card-body">
                        <div class="ch-card-cat">Calidad · Certificación</div>
                        <div class="ch-card-title">BPM en Industria Alimentaria</div>
                        <div class="ch-card-meta">
                            <span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                8 semanas
                            </span>
                            <span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                Certificado
                            </span>
                            <span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                Nivel básico
                            </span>
                        </div>
                        <div class="ch-card-footer">
                            <div>
                                <div class="ch-card-price-lbl">Precio</div>
                                <div class="ch-card-price">S/ 350</div>
                            </div>
                            <button class="ch-card-btn" onclick="inscribir(this)" data-course="BPM en Industria Alimentaria" data-level="basico" data-price="350">
                                Inscribirme
                            </button>
                        </div>
                    </div>

                    {{-- Stats flotantes --}}
                    <div class="ch-float-stat ch-float-stat-1">
                        <svg width="14" height="14" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                        <span><strong>+200</strong> estudiantes</span>
                    </div>
                    <div class="ch-float-stat ch-float-stat-2">
                        <svg width="14" height="14" fill="#f59e0b" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <span><strong>4.9</strong> valoración</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="ch-scroll">
            <a href="#catalogo">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
            </a>
        </div>
    </section>

    {{-- ── Filtros ── --}}
    <section id="catalogo" class="section" style="padding-bottom:0">
        <div class="section-header">
            <p class="eyebrow">Catálogo</p>
            <h2 class="section-title">Programas especializados en alimentos.</h2>
            <p class="section-subtitle">Cada curso incluye materiales, certificado y acompañamiento técnico.</p>
        </div>

        <div class="curso-filters">
            <button class="filter-btn active" data-filter="all">Todos</button>
            <button class="filter-btn" data-filter="basico">Básico</button>
            <button class="filter-btn" data-filter="intermedio">Intermedio</button>
            <button class="filter-btn" data-filter="avanzado">Avanzado</button>
        </div>
    </section>

    {{-- ── Catálogo ── --}}
    <section class="section" style="padding-top:24px">
        <div class="cursos-grid">

            {{-- 1 --}}
            <article class="curso-card reveal" data-level="basico">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=480&h=260&fit=crop&auto=format"
                         alt="BPM en Industria Alimentaria" loading="lazy">
                    <span class="nivel-badge basico">Básico</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Calidad · Certificación</div>
                    <h3 class="curso-nombre">BPM en Industria Alimentaria</h3>
                    <p class="curso-resena">Domina las Buenas Prácticas de Manufactura aplicadas al procesamiento de alimentos. Aprenderás a identificar puntos críticos, documentar procesos y cumplir con la normativa sanitaria peruana.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            8 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 350</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 2 --}}
            <article class="curso-card reveal" data-level="intermedio">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=480&h=260&fit=crop&auto=format"
                         alt="Gestión de Calidad ISO 9001" loading="lazy">
                    <span class="nivel-badge intermedio">Intermedio</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Normas · ISO</div>
                    <h3 class="curso-nombre">Gestión de Calidad ISO 9001</h3>
                    <p class="curso-resena">Implementa sistemas de gestión de calidad en empresas del rubro alimentario. Incluye plantillas listas para usar, auditorías internas y cómo preparar tu empresa para una certificación real.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            10 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 450</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 3 --}}
            <article class="curso-card reveal" data-level="avanzado">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=480&h=260&fit=crop&auto=format"
                         alt="Control Microbiológico" loading="lazy">
                    <span class="nivel-badge avanzado">Avanzado</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Laboratorio</div>
                    <h3 class="curso-nombre">Control Microbiológico en Alimentos</h3>
                    <p class="curso-resena">Técnicas y protocolos actualizados para el control microbiológico en plantas de alimentos. Análisis de coliformes, listeria, salmonella y criterios microbiológicos del MINSA/SENASA para alimentos procesados.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            6 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 380</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 4 --}}
            <article class="curso-card reveal" data-level="basico">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1559598467-f8b76c8155d0?w=480&h=260&fit=crop&auto=format"
                         alt="Procesamiento de Alimentos Artesanales" loading="lazy">
                    <span class="nivel-badge basico">Básico</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Producción · Alimentos</div>
                    <h3 class="curso-nombre">Procesamiento de Alimentos Artesanales</h3>
                    <p class="curso-resena">Aprende técnicas de procesamiento artesanal de alimentos, desde la selección de materias primas hasta el envasado final, con estándares de inocuidad para pequeña y mediana escala.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            5 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 280</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 5 --}}
            <article class="curso-card reveal" data-level="intermedio">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1488477181946-6428a0291777?w=480&h=260&fit=crop&auto=format"
                         alt="Elaboración de Alimentos Fermentados" loading="lazy">
                    <span class="nivel-badge intermedio">Intermedio</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Producción · Fermentados</div>
                    <h3 class="curso-nombre">Elaboración de Alimentos Fermentados</h3>
                    <p class="curso-resena">Producción de alimentos fermentados con control de cultivos iniciadores, parámetros de fermentación y vida útil. Incluye formulación, análisis sensorial y envasado correcto.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            6 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 320</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 6 --}}
            <article class="curso-card reveal" data-level="avanzado">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=480&h=260&fit=crop&auto=format"
                         alt="HACCP en Plantas de Alimentos" loading="lazy">
                    <span class="nivel-badge avanzado">Avanzado</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Inocuidad · HACCP</div>
                    <h3 class="curso-nombre">HACCP en Plantas de Alimentos</h3>
                    <p class="curso-resena">Diseño e implementación del sistema HACCP adaptado a la industria alimentaria peruana. Identificación de peligros físicos, químicos y biológicos, determinación de PCC y elaboración del plan HACCP completo.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            9 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 420</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 7 --}}
            <article class="curso-card reveal" data-level="basico">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?w=480&h=260&fit=crop&auto=format"
                         alt="Pasteurización y Tratamiento Térmico" loading="lazy">
                    <span class="nivel-badge basico">Básico</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Proceso · Térmica</div>
                    <h3 class="curso-nombre">Pasteurización y Tratamiento Térmico</h3>
                    <p class="curso-resena">Fundamentos y operación de tratamientos térmicos en líneas de alimentos procesados. Control de temperatura, validación de procesos y mantenimiento preventivo de equipos.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            4 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 290</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 8 --}}
            <article class="curso-card reveal" data-level="intermedio">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1576867757603-05b134ebc379?w=480&h=260&fit=crop&auto=format"
                         alt="Análisis Fisicoquímico de Alimentos" loading="lazy">
                    <span class="nivel-badge intermedio">Intermedio</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Laboratorio · Fisicoquímica</div>
                    <h3 class="curso-nombre">Análisis Fisicoquímico de Alimentos</h3>
                    <p class="curso-resena">Determinación de grasa, proteína, densidad, acidez, pH y sólidos totales en alimentos. Manejo de equipos de laboratorio e interpretación de resultados según normas NTP.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            7 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 360</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

            {{-- 9 --}}
            <article class="curso-card reveal" data-level="avanzado">
                <div class="curso-img">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=480&h=260&fit=crop&auto=format"
                         alt="Gestión de Inocuidad Alimentaria" loading="lazy">
                    <span class="nivel-badge avanzado">Avanzado</span>
                </div>
                <div class="curso-body">
                    <div class="curso-cat-tag">Gestión · Inocuidad</div>
                    <h3 class="curso-nombre">Gestión de Inocuidad Alimentaria ISO 22000</h3>
                    <p class="curso-resena">Implementación integral de la norma ISO 22000:2018 en empresas alimentarias. Integra BPM, HACCP y gestión de riesgos en un sistema robusto alineado a estándares internacionales. Ideal para responsables de calidad e inocuidad.</p>
                    <div class="curso-detalles">
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            12 semanas
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            Online
                        </span>
                        <span>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Certificado
                        </span>
                    </div>
                    <div class="curso-footer">
                        <div class="curso-precio">
                            <span class="precio-label">Precio</span>
                            <span class="precio-valor">S/ 480</span>
                        </div>
                        <button class="btn-inscribir" onclick="inscribir(this)">Inscribirme</button>
                    </div>
                </div>
            </article>

        </div>
    </section>

    {{-- ── Metodología ── --}}
    <section class="section alt">
        <div class="split">
            <div>
                <p class="eyebrow">Metodología</p>
                <h2 class="section-title">La clase se convierte en acción.</h2>
                <p class="section-subtitle">El participante no solo ve contenido: entiende qué debe revisar, documentar y mejorar en su planta.</p>
            </div>
            <div class="feature-panel reveal">
                <ul class="list-clean">
                    <li>Sesiones breves con objetivos por módulo.</li>
                    <li>Casos aplicados a plantas y negocios alimentarios.</li>
                    <li>Materiales descargables para el equipo.</li>
                    <li>Orientación final para aplicar lo aprendido.</li>
                </ul>
            </div>
        </div>
    </section>

</main>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
<style>
/* ══════════════ HERO CURSOS ══════════════ */
.ch-hero {
    position: relative;
    min-height: 92vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    background: #07172e;
}
.ch-bg {
    position: absolute; inset: 0;
    background-image: url("https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?auto=format&fit=crop&w=1600&q=80");
    background-size: cover; background-position: center;
    opacity: .12;
    will-change: transform;
    animation: ch-kb 18s ease-in-out infinite alternate;
}
@keyframes ch-kb {
    from { transform: scale(1); }
    to   { transform: scale(1.07) translate(-1%, .8%); }
}
.ch-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(115deg, rgba(5,15,50,.95) 0%, rgba(10,30,90,.78) 50%, rgba(14,165,233,.15) 100%);
}
.ch-blob {
    position: absolute; border-radius: 50%;
    filter: blur(100px); opacity: .2; pointer-events: none;
}
.ch-blob-1 { width: 560px; height: 560px; background: #2563eb; top: -160px; right: -100px; }
.ch-blob-2 { width: 400px; height: 400px; background: #0ea5e9; bottom: -100px; left: -80px; }

.ch-inner {
    position: relative; z-index: 2;
    max-width: 1280px; margin: 0 auto;
    padding: 80px 64px;
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 72px;
    align-items: center;
    width: 100%;
}

/* Eyebrow */
.ch-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(37,99,235,.25);
    border: 1px solid rgba(96,165,250,.4);
    color: #93c5fd;
    font-size: 12px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 6px 16px; border-radius: 30px;
    margin-bottom: 22px;
}

/* Título */
.ch-title {
    font-family: 'Noto Serif', serif;
    font-size: clamp(32px, 4vw, 54px);
    font-weight: 700; color: #fff;
    line-height: 1.13; margin-bottom: 20px;
    letter-spacing: -.4px;
}
.ch-title em { font-style: normal; color: #7dd3fc; }

.ch-lead {
    font-size: 16.5px; color: rgba(255,255,255,.72);
    line-height: 1.75; margin-bottom: 28px;
    max-width: 520px;
}

/* Pills stats */
.ch-pills {
    display: flex; flex-wrap: wrap; gap: 10px;
    margin-bottom: 32px;
}
.ch-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.14);
    color: rgba(255,255,255,.82);
    font-size: 12.5px; font-weight: 600;
    padding: 7px 14px; border-radius: 30px;
    backdrop-filter: blur(6px);
}
.ch-pill svg { color: #7dd3fc; flex-shrink: 0; }

/* Botones */
.ch-actions { display: flex; gap: 12px; flex-wrap: wrap; }
.ch-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #2563eb; color: #fff;
    padding: 13px 26px; border-radius: 10px;
    font-size: 14px; font-weight: 700; text-decoration: none;
    box-shadow: 0 12px 28px rgba(37,99,235,.4);
    transition: all .2s;
}
.ch-btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); }
.ch-btn-outline {
    display: inline-flex; align-items: center; gap: 8px;
    border: 1.5px solid rgba(255,255,255,.4); color: #fff;
    padding: 13px 26px; border-radius: 10px;
    font-size: 14px; font-weight: 600; text-decoration: none;
    backdrop-filter: blur(4px);
    transition: all .2s;
}
.ch-btn-outline:hover { background: rgba(255,255,255,.1); border-color: #fff; }

/* Card derecha */
.ch-card {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.13);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 32px 80px rgba(0,0,0,.4);
}
.ch-card-img { position: relative; height: 200px; overflow: hidden; }
.ch-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.ch-card:hover .ch-card-img img { transform: scale(1.05); }
.ch-card-img::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(7,23,46,.7));
}
.ch-card-badge {
    position: absolute; top: 14px; left: 14px; z-index: 1;
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #7c2d12;
    font-size: 10.5px; font-weight: 800;
    padding: 4px 12px; border-radius: 20px;
    text-transform: uppercase; letter-spacing: .5px;
}
.ch-card-body { padding: 20px 22px 22px; }
.ch-card-cat   { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #7dd3fc; margin-bottom: 6px; }
.ch-card-title { font-size: 17px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.3; }
.ch-card-meta  {
    display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px;
}
.ch-card-meta span {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11.5px; color: rgba(255,255,255,.6);
    background: rgba(255,255,255,.08);
    padding: 4px 10px; border-radius: 8px;
}
.ch-card-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 14px; border-top: 1px solid rgba(255,255,255,.1);
}
.ch-card-price-lbl { font-size: 10px; color: rgba(255,255,255,.45); }
.ch-card-price     { font-size: 24px; font-weight: 800; color: #fff; line-height: 1; }
.ch-card-btn {
    background: #2563eb; color: #fff;
    border: none; border-radius: 9px;
    padding: 10px 18px;
    font-size: 13px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: background .18s, transform .15s;
}
.ch-card-btn:hover { background: #1d4ed8; transform: scale(1.04); }

/* Stat flotantes */
.ch-float-stat {
    position: absolute;
    display: flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.95);
    border-radius: 10px; padding: 8px 14px;
    font-size: 12px; color: #0f172a;
    box-shadow: 0 8px 24px rgba(0,0,0,.2);
    white-space: nowrap;
    animation: ch-float 4s ease-in-out infinite alternate;
}
.ch-float-stat strong { font-weight: 800; }
.ch-float-stat-1 { top: 24px; right: -16px; animation-delay: 0s; }
.ch-float-stat-2 { bottom: 90px; right: -20px; animation-delay: 1.5s; }
@keyframes ch-float {
    from { transform: translateY(0); }
    to   { transform: translateY(-6px); }
}

/* Scroll indicator */
.ch-scroll {
    position: absolute; bottom: 28px; left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}
.ch-scroll a {
    display: flex; align-items: center; justify-content: center;
    width: 40px; height: 40px;
    border: 1.5px solid rgba(255,255,255,.3);
    border-radius: 50%; color: rgba(255,255,255,.7);
    animation: ch-bounce 2s ease-in-out infinite;
    transition: border-color .2s;
}
.ch-scroll a:hover { border-color: #fff; color: #fff; }
@keyframes ch-bounce {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(5px); }
}

/* Responsive */
@media (max-width: 960px) {
    .ch-inner { grid-template-columns: 1fr; padding: 60px 32px 80px; gap: 48px; }
    .ch-right { display: none; }
    .ch-hero  { min-height: 80vh; }
}
@media (max-width: 560px) {
    .ch-inner { padding: 50px 20px 70px; }
    .ch-pills { gap: 8px; }
}

/* ── Filtros ── */
.curso-filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 24px;
}
.filter-btn {
    padding: 8px 20px;
    border-radius: 30px;
    border: 1.5px solid #d1d5db;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    cursor: pointer;
    transition: all .2s;
}
.filter-btn:hover   { border-color: #38bdf8; color: #0284c7; background: #e0f2fe; }
.filter-btn.active  { background: #0284c7; border-color: #0284c7; color: #fff; font-weight: 600; }

/* ── Grid de cursos ── */
.cursos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 26px;
}

/* ── Tarjeta de curso ── */
.curso-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    display: flex;
    flex-direction: column;
    transition: transform .25s, box-shadow .25s;
}
.curso-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 32px rgba(0,0,0,.12);
}
.curso-card.hidden { display: none; }

/* Imagen */
.curso-img {
    position: relative;
    height: 190px;
    overflow: hidden;
}
.curso-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s;
}
.curso-card:hover .curso-img img { transform: scale(1.05); }

/* Badge de nivel */
.nivel-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .4px;
    text-transform: uppercase;
}
.nivel-badge.basico     { background: #d1fae5; color: #065f46; }
.nivel-badge.intermedio { background: #fef3c7; color: #92400e; }
.nivel-badge.avanzado   { background: #fee2e2; color: #991b1b; }

/* Body */
.curso-body {
    padding: 18px 20px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.curso-cat-tag {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: #0284c7;
    margin-bottom: 6px;
}
.curso-nombre {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 10px;
    line-height: 1.35;
}
.curso-resena {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.65;
    margin-bottom: 14px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.curso-detalles {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
}
.curso-detalles span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #6b7280;
    background: #f3f4f6;
    padding: 4px 10px;
    border-radius: 8px;
}
.curso-detalles span svg { flex-shrink: 0; }

/* Footer precio + botón */
.curso-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid #f3f4f6;
    margin-top: auto;
}
.curso-precio { display: flex; flex-direction: column; }
.precio-label { font-size: 10.5px; color: #9ca3af; font-weight: 500; }
.precio-valor { font-size: 22px; font-weight: 800; color: #111827; line-height: 1.1; }

.btn-inscribir {
    display: inline-block;
    padding: 9px 20px;
    background: #0284c7;
    color: #fff;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
    box-shadow: 0 10px 22px rgba(2, 132, 199, 0.18);
    transition: background .2s, transform .15s, box-shadow .2s;
    white-space: nowrap;
}
.btn-inscribir:hover {
    background: #075985;
    box-shadow: 0 14px 28px rgba(2, 132, 199, 0.24);
    transform: scale(1.03);
}

@media (max-width: 640px) {
    .cursos-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@push('scripts')
<script>
// Filtros
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.curso-card').forEach(card => {
            card.classList.toggle('hidden', filter !== 'all' && card.dataset.level !== filter);
        });
    });
});

// Agregar al carrito
async function inscribir(btn) {
    @guest
        window.location.href = '{{ route("login") }}';
        return;
    @endguest

    // Soporte para tarjeta del catálogo (DOM) y tarjeta del hero (data attrs)
    let name, level, price;
    if (btn.dataset.course) {
        name  = btn.dataset.course;
        level = btn.dataset.level;
        price = btn.dataset.price;
    } else {
        const card = btn.closest('.curso-card');
        name  = card.querySelector('.curso-nombre').textContent.trim();
        level = card.dataset.level;
        price = card.querySelector('.precio-valor').textContent.replace('S/ ', '').trim();
    }

    btn.disabled    = true;
    btn.textContent = 'Agregando…';

    try {
        const res  = await fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept':       'application/json',
            },
            body: JSON.stringify({ course_name: name, level, price }),
        });
        const data = await res.json();

        if (res.ok && data.ok) {
            btn.textContent      = '✓ En el carrito';
            btn.style.background = '#0284c7';
            // actualizar badge navbar
            const badge = document.getElementById('nav-cart-count');
            if (badge) {
                badge.textContent = data.count;
                badge.style.display = 'inline-flex';
                badge.style.transform = 'scale(1.3)';
                setTimeout(() => badge.style.transform = '', 300);
            }
            showToast('🛒 ' + data.msg + ' — <a href="{{ route("checkout") }}" style="color:#fff;font-weight:700;">Ir al carrito →</a>');
        } else {
            btn.disabled    = false;
            btn.textContent = 'Inscribirme';
            showToast('ℹ️ ' + (data.msg || 'No se pudo agregar.'));
        }
    } catch {
        btn.disabled    = false;
        btn.textContent = 'Inscribirme';
        showToast('❌ Error de conexión.');
    }
}
</script>
@endpush
