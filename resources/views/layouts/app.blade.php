<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JM y JS Alimentos Lácteos') | JM y JS</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('styles')
</head>
<body>

<div id="ai-chat"></div>
@vite('resources/js/app.jsx')

<nav id="navbar">
  <a href="{{ route('inicio') }}" class="nav-logo">
    @php
      $brandLogo = file_exists(public_path('img/logo-jmjs.png')) ? asset('img/logo-jmjs.png') : null;
    @endphp

    @if ($brandLogo)
      <img class="logo-image" src="{{ $brandLogo }}" alt="JM y JS Alimentos Lacteos">
    @else
      <div class="logo-icon">JM</div>
      <div>
      <div class="logo-text">JM y JS</div>
      <div class="logo-sub">Alimentos Lácteos</div>
      </div>
    @endif
  </a>

  <div class="nav-links">
    <a href="{{ route('inicio') }}" class="{{ request()->routeIs('inicio') ? 'is-active' : '' }}">Inicio</a>
    <a href="{{ route('nosotros') }}" class="{{ request()->routeIs('nosotros') ? 'is-active' : '' }}">Nosotros</a>
    <a href="{{ route('cursos') }}" class="{{ request()->routeIs('cursos') ? 'is-active' : '' }}">Cursos</a>
    <a href="{{ route('servicios') }}" class="{{ request()->routeIs('servicios') ? 'is-active' : '' }}">Servicios</a>
    <a href="{{ route('calidad') }}" class="{{ request()->routeIs('calidad') ? 'is-active' : '' }}">Calidad</a>
    <a href="{{ route('contacto') }}#contacto-formulario" class="{{ request()->routeIs('contacto') ? 'is-active' : '' }}">Contacto</a>
    @auth
      <span class="nav-user">Hola, {{ \Illuminate\Support\Str::limit(auth()->user()->name, 18) }}</span>
      <form method="POST" action="{{ route('logout') }}" class="nav-form">
        @csrf
        <button type="submit" class="btn-nav nav-button">Salir</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="btn-nav {{ request()->routeIs('login') ? 'is-active' : '' }}">Login</a>
    @endauth
  </div>
</nav>

@yield('content')

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <strong>JM y JS Alimentos Lácteos</strong>
      <p>Expertos en calidad alimentaria, BPM e ISO para el sector lácteo peruano.</p>
    </div>

    <div class="footer-col">
      <h4>Plataforma</h4>
      <a href="{{ route('cursos') }}">Cursos</a>
      <a href="{{ route('servicios') }}">Servicios</a>
      <a href="{{ route('calidad') }}">Calidad</a>
    </div>

    <div class="footer-col">
      <h4>Empresa</h4>
      <a href="{{ route('nosotros') }}">Nosotros</a>
      <a href="{{ route('contacto') }}#contacto-formulario">Contacto</a>
    </div>
  </div>

  <div class="footer-bottom">
    <span>© 2026 JM y JS Alimentos Lácteos. Huancayo, Perú.</span>
  </div>
</footer>

<div class="toast" id="toast"><span id="toast-msg"></span></div>

<script>
window.addEventListener('scroll', () => {
    document.getElementById('navbar')?.classList.toggle('scrolled', window.scrollY > 20);
});

const obs = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting) entry.target.classList.add('visible');
    });
},{threshold:.1});

document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

function applyCurtainText(selector){
    const curtainTexts = document.querySelectorAll(selector);

    curtainTexts.forEach((textBlock) => {
        if (textBlock.dataset.curtainApplied === 'true') return;

        const text = textBlock.textContent;
        const chars = Array.from(text);
        const midpoint = (chars.length - 1) / 2;

        textBlock.dataset.curtainApplied = 'true';
        textBlock.classList.add('curtain-text');
        textBlock.setAttribute('aria-label', text.trim());
        textBlock.textContent = '';

        let charIndex = 0;

        text.match(/\S+|\s+/g)?.forEach((token) => {
            if (/^\s+$/.test(token)) {
                textBlock.appendChild(document.createTextNode(' '));
                charIndex += token.length;
                return;
            }

            const word = document.createElement('span');
            word.className = 'curtain-word';
            word.setAttribute('aria-hidden', 'true');

            Array.from(token).forEach((char) => {
                const span = document.createElement('span');
                const fromLeft = charIndex <= midpoint;
                const distance = Math.abs(charIndex - midpoint);
                const delay = Math.max(0, 560 - distance * 22);

                span.className = 'curtain-char';
                span.textContent = char;
                span.style.setProperty('--curtain-from', fromLeft ? '-72px' : '72px');
                span.style.setProperty('--curtain-delay', `${delay}ms`);

                word.appendChild(span);
                charIndex++;
            });

            textBlock.appendChild(word);
        });

        textBlock.classList.add('curtain-ready');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    applyCurtainText('.page > section:first-child .eyebrow, .page > section:first-child h1, .page > section:first-child .lead, .curtain-text');
});

function showToast(msg){
    const t = document.getElementById('toast');
    const m = document.getElementById('toast-msg');
    if(!t || !m) return;
    m.textContent = msg;
    t.classList.add('show');
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(()=>t.classList.remove('show'),3200);
}
</script>

@stack('scripts')
</body>
</html>
