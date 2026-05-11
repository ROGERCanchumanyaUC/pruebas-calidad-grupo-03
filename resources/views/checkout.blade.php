@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    body > #navbar, body > footer { display: none; }
    #ai-chat { position: relative; z-index: 100000; display: block !important; }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .checkout-shell {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background: #eaf7ff;
        color: #0b2538;
        font-family: "Poppins", system-ui, sans-serif;
    }

    .checkout-header {
        position: sticky; top: 0; z-index: 50; width: 100%;
        padding: 16px clamp(18px, 5vw, 32px);
        border-bottom: 1px solid rgba(21,101,142,.16);
        background: rgba(248,252,255,.96);
        backdrop-filter: blur(14px);
    }
    .checkout-header-inner {
        width: min(1200px,100%); margin: 0 auto;
        display: flex; align-items: center; justify-content: space-between; gap: 20px;
    }
    .checkout-brand {
        display: flex; align-items: center; gap: 10px;
        color: #0b2538; font-size: 18px; font-weight: 800;
        text-decoration: none;
    }
    .checkout-brand img { height: 36px; }
    .checkout-secure {
        display: inline-flex; align-items: center; gap: 8px;
        color: #0284c7; font-size: 12px; font-weight: 700;
        letter-spacing: .05em; text-transform: uppercase;
    }

    .checkout-main {
        width: min(1200px,100%); margin: 0 auto;
        padding: 40px clamp(18px,5vw,32px) 64px;
        display: grid;
        grid-template-columns: minmax(0,7fr) minmax(360px,5fr);
        gap: 64px;
    }
    .checkout-column { display: flex; flex-direction: column; gap: 32px; }

    .checkout-title h1 { margin: 0 0 6px; color: #0b2538; font-size: 24px; font-weight: 700; }
    .checkout-title p  { margin: 0; color: #587082; font-size: 14px; }

    /* Payment methods */
    .payment-methods { display: grid; gap: 12px; }
    .payment-method {
        position: relative; padding: 20px 24px;
        display: flex; align-items: flex-start; gap: 16px;
        border: 1px solid rgba(21,101,142,.16); border-radius: 10px;
        background: rgba(248,252,255,.96); cursor: pointer;
        transition: border-color .2s, box-shadow .2s;
    }
    .payment-method:hover,
    .payment-method.is-active { border-color: #0284c7; box-shadow: 0 8px 24px rgba(2,132,199,.1); }
    .payment-method input { width: 18px; height: 18px; margin-top: 3px; accent-color: #0284c7; }
    .payment-method strong { display: block; margin-bottom: 3px; color: #0b2538; font-size: 15px; font-weight: 600; }
    .payment-method > span { display: block; color: #587082; font-size: 13px; }
    .payment-method .material-symbols-outlined { margin-left: auto; color: #0284c7; font-size: 26px; }

    /* Card form */
    .card-panel {
        border: 1px solid rgba(21,101,142,.16); border-radius: 10px;
        background: rgba(248,252,255,.96); padding: 28px;
        box-shadow: 0 8px 24px rgba(24,38,33,.06);
        display: grid; gap: 20px;
    }
    .checkout-field { display: grid; gap: 5px; }
    .checkout-field label {
        color: #587082; font-size: 11px; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase;
    }
    .checkout-field input {
        width: 100%; min-height: 46px; padding: 11px 14px;
        border: 1px solid rgba(21,101,142,.18); border-radius: 8px;
        color: #0b2538; background: #fff; font-size: 15px; font-family: inherit;
        outline: none; transition: border-color .2s, box-shadow .2s;
    }
    .checkout-field input:focus { border-color: #0284c7; box-shadow: 0 0 0 4px rgba(2,132,199,.12); }
    .checkout-field input.is-invalid { border-color: #ef4444; }
    .field-error { color: #ef4444; font-size: 12px; margin-top: 3px; }

    .input-icon { position: relative; }
    .input-icon input { padding-left: 42px; }
    .input-icon .material-symbols-outlined { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #587082; font-size: 20px; }

    .input-help { position: relative; }
    .input-help input { padding-right: 42px; }
    .input-help .material-symbols-outlined { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #587082; font-size: 20px; }

    .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    /* Summary */
    .summary-wrap { position: relative; }
    .summary-card {
        position: sticky; top: 100px; overflow: hidden;
        border: 1px solid rgba(21,101,142,.16); border-radius: 12px;
        background: rgba(248,252,255,.96);
        box-shadow: 0 14px 34px rgba(24,38,33,.08);
    }
    .summary-title { margin: 0 0 4px; color: #0b2538; font-size: 20px; font-weight: 700; }
    .summary-head  { padding: 22px 24px; border-bottom: 1px solid rgba(21,101,142,.12); }
    .summary-head p { margin: 0; font-size: 13px; color: #587082; }

    /* Cart items */
    .cart-items { max-height: 320px; overflow-y: auto; }
    .cart-item {
        display: flex; gap: 14px; align-items: flex-start;
        padding: 16px 24px; border-bottom: 1px solid rgba(21,101,142,.08);
    }
    .cart-item:last-child { border-bottom: none; }
    .cart-thumb {
        width: 56px; height: 56px; border-radius: 8px;
        background: #dff3ff; overflow: hidden; flex-shrink: 0;
        border: 1px solid rgba(21,101,142,.12);
    }
    .cart-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .cart-info { flex: 1; min-width: 0; }
    .cart-info strong { display: block; font-size: 13.5px; font-weight: 600; color: #0b2538; line-height: 1.35; }
    .cart-info .cart-level { font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; display: inline-block; margin-top: 4px; }
    .cart-level.basico     { background: #dcfce7; color: #15803d; }
    .cart-level.intermedio { background: #fef3c7; color: #92400e; }
    .cart-level.avanzado   { background: #fee2e2; color: #991b1b; }
    .cart-price { font-size: 14px; font-weight: 700; color: #0b2538; white-space: nowrap; }
    .cart-remove {
        background: none; border: none; cursor: pointer; color: #94a3b8;
        font-size: 18px; padding: 0; line-height: 1; transition: color .15s;
    }
    .cart-remove:hover { color: #ef4444; }

    /* Empty cart */
    .cart-empty {
        padding: 40px 24px; text-align: center; color: #587082; font-size: 14px;
    }
    .cart-empty a { color: #0284c7; font-weight: 600; text-decoration: none; }

    /* Totals */
    .summary-totals { padding: 20px 24px; background: #f8fcff; display: grid; gap: 10px; }
    .summary-row, .summary-total {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .summary-row  { color: #587082; font-size: 13.5px; }
    .summary-divider { height: 1px; background: rgba(21,101,142,.12); margin: 4px 0; }
    .summary-total { color: #0b2538; font-size: 22px; font-weight: 700; margin-bottom: 4px; }

    /* Pay button */
    .pay-button {
        width: 100%; min-height: 52px; padding: 14px 20px;
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        border: none; border-radius: 10px; cursor: pointer;
        color: #fff; background: #0284c7;
        font-size: 13px; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        font-family: inherit;
        transition: background .2s, transform .2s, box-shadow .2s;
    }
    .pay-button:hover:not(:disabled) { background: #075985; transform: translateY(-2px); box-shadow: 0 16px 34px rgba(2,132,199,.22); }
    .pay-button:disabled { opacity: .55; cursor: not-allowed; }

    .secure-badges { margin-top: 14px; text-align: center; color: #587082; }
    .secure-badge-row { display: flex; align-items: center; justify-content: center; gap: 20px; margin-bottom: 8px; opacity: .8; }
    .secure-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 10px; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; }
    .secure-badges p { margin: 0; font-size: 11.5px; line-height: 1.5; max-width: 320px; margin: 0 auto; }

    .checkout-back { margin-top: 16px; display: inline-flex; color: #075985; font-size: 13.5px; font-weight: 600; text-decoration: none; }
    .checkout-back:hover { text-decoration: underline; }

    @media (max-width: 980px) {
        .checkout-main { grid-template-columns: 1fr; gap: 36px; }
        .summary-card  { position: static; }
    }
    @media (max-width: 560px) {
        .field-grid { grid-template-columns: 1fr; }
        .checkout-header-inner { flex-direction: column; }
    }
</style>
@endpush

@section('content')
<div class="checkout-shell">

    {{-- Header --}}
    <header class="checkout-header">
        <div class="checkout-header-inner">
            <a href="{{ route('cursos') }}" class="checkout-brand">
                @if (file_exists(public_path('img/logo-jmjs.png')))
                    <img src="{{ asset('img/logo-jmjs.png') }}" alt="JM y JS">
                @endif
                JM y JS Alimentos
            </a>
            <div class="checkout-secure">
                <span class="material-symbols-outlined">lock</span>
                Pago Seguro
            </div>
        </div>
    </header>

    <main class="checkout-main">

        {{-- Columna izquierda: pago --}}
        <section class="checkout-column">
            <div class="checkout-title">
                <h1>Detalles de Pago</h1>
                <p>Selecciona tu método de pago y completa la información para confirmar tu inscripción.</p>
            </div>

            @if (session('errors'))
                <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:8px;padding:14px 16px;color:#dc2626;font-size:13px;">
                    {{ session('errors')->first() }}
                </div>
            @endif

            {{-- Métodos de pago --}}
            <div class="payment-methods">
                <label class="payment-method is-active" id="pm-card">
                    <input checked name="payment_method" type="radio" value="card" onchange="toggleMethod('card')">
                    <span>
                        <strong>Tarjeta de Crédito / Débito</strong>
                        <span>Aceptamos Visa, Mastercard, American Express.</span>
                    </span>
                    <span class="material-symbols-outlined">credit_card</span>
                </label>
                <label class="payment-method" id="pm-wallet">
                    <input name="payment_method" type="radio" value="wallet" onchange="toggleMethod('wallet')">
                    <span>
                        <strong>Billetera Digital (Yape / Plin)</strong>
                        <span>Paga escaneando el código QR en la siguiente pantalla.</span>
                    </span>
                    <span class="material-symbols-outlined">qr_code_scanner</span>
                </label>
            </div>

            {{-- Formulario de tarjeta --}}
            @if (!empty($cart))
            <form id="payment-form" method="POST" action="{{ route('pago.procesar') }}">
                @csrf
                <div class="card-panel">
                    <div class="checkout-field">
                        <label for="card_name">Nombre en la Tarjeta</label>
                        <input id="card_name" name="card_name" type="text"
                               placeholder="Ej. Giancarlo Guerreros" autocomplete="cc-name"
                               value="{{ old('card_name') }}"
                               class="{{ $errors->has('card_name') ? 'is-invalid' : '' }}">
                        @error('card_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="checkout-field">
                        <label for="card_number">Número de Tarjeta</label>
                        <div class="input-icon">
                            <input id="card_number" name="card_number" type="text"
                                   placeholder="0000 0000 0000 0000" autocomplete="cc-number"
                                   maxlength="19"
                                   class="{{ $errors->has('card_number') ? 'is-invalid' : '' }}">
                            <span class="material-symbols-outlined">credit_card</span>
                        </div>
                        @error('card_number')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field-grid">
                        <div class="checkout-field">
                            <label for="card_exp">Expiración (MM/AA)</label>
                            <input id="card_exp" name="card_exp" type="text"
                                   placeholder="MM/AA" maxlength="5" autocomplete="cc-exp"
                                   class="{{ $errors->has('card_exp') ? 'is-invalid' : '' }}">
                            @error('card_exp')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="checkout-field">
                            <label for="card_cvc">CVC / CVV</label>
                            <div class="input-help">
                                <input id="card_cvc" name="card_cvc" type="text"
                                       placeholder="123" maxlength="4" autocomplete="cc-csc"
                                       class="{{ $errors->has('card_cvc') ? 'is-invalid' : '' }}">
                                <span class="material-symbols-outlined" title="3 dígitos en el reverso">help</span>
                            </div>
                            @error('card_cvc')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </form>
            @endif

            <a class="checkout-back" href="{{ route('cursos') }}">← Volver a cursos</a>
        </section>

        {{-- Resumen --}}
        <aside class="summary-wrap">
            <div class="summary-card">
                <div class="summary-head">
                    <h2 class="summary-title">Resumen de Compra</h2>
                    <p>{{ count($cart) }} {{ count($cart) === 1 ? 'curso' : 'cursos' }} en tu carrito</p>
                </div>

                @if (empty($cart))
                    <div class="cart-empty">
                        <p>Tu carrito está vacío.</p>
                        <a href="{{ route('cursos') }}">Explorar cursos →</a>
                    </div>
                @else
                    <div class="cart-items" id="cart-items">
                        @foreach ($cart as $item)
                        <div class="cart-item" id="item-{{ md5($item['course_name']) }}">
                            <div class="cart-thumb">
                                <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?w=120&h=120&fit=crop" alt="">
                            </div>
                            <div class="cart-info">
                                <strong>{{ $item['course_name'] }}</strong>
                                <span class="cart-level {{ strtolower($item['level']) }}">{{ ucfirst($item['level']) }}</span>
                            </div>
                            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">
                                <span class="cart-price">S/ {{ number_format($item['price'], 0) }}</span>
                                <button class="cart-remove" title="Quitar"
                                        onclick="removeItem('{{ addslashes($item['course_name']) }}', '{{ md5($item['course_name']) }}')">
                                    ✕
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @php
                        $subtotal = collect($cart)->sum('price');
                        $igv      = $subtotal * 0.18;
                        $total    = $subtotal;
                        $sinIgv   = $subtotal / 1.18;
                        $soloIgv  = $subtotal - $sinIgv;
                    @endphp

                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Subtotal (sin IGV)</span>
                            <span>S/ {{ number_format($sinIgv, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>IGV (18%)</span>
                            <span>S/ {{ number_format($soloIgv, 2) }}</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>S/ {{ number_format($total, 2) }}</span>
                        </div>

                        <button class="pay-button" type="submit" form="payment-form" id="pay-btn">
                            <span class="material-symbols-outlined">check_circle</span>
                            Pagar S/ {{ number_format($total, 2) }}
                        </button>

                        <div class="secure-badges">
                            <div class="secure-badge-row">
                                <div class="secure-badge">
                                    <span class="material-symbols-outlined">shield</span> SSL Secure
                                </div>
                                <div class="secure-badge">
                                    <span class="material-symbols-outlined">verified_user</span> PCI Compliant
                                </div>
                            </div>
                            <p>Sus datos están protegidos con los más altos estándares de seguridad.</p>
                        </div>
                    </div>
                @endif
            </div>
        </aside>

    </main>
</div>
@endsection

@push('scripts')
<script>
// Toggle método de pago
function toggleMethod(method) {
    document.getElementById('pm-card').classList.toggle('is-active', method === 'card');
    document.getElementById('pm-wallet').classList.toggle('is-active', method === 'wallet');
}

// Formato tarjeta
document.getElementById('card_number')?.addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim().slice(0, 19);
});
document.getElementById('card_exp')?.addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').replace(/(\d{2})(\d)/, '$1/$2').slice(0, 5);
});
document.getElementById('card_cvc')?.addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 4);
});

// Quitar item del carrito
async function removeItem(name, hash) {
    const res  = await fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ course_name: name }),
    });
    const data = await res.json();
    if (data.ok) {
        document.getElementById('item-' + hash)?.remove();
        if (data.count === 0) location.reload();
        // Actualiza badge del navbar
        document.querySelectorAll('.cart-count').forEach(el => el.textContent = data.count > 0 ? data.count : '');
    }
}

// Deshabilitar botón al enviar
document.getElementById('payment-form')?.addEventListener('submit', function () {
    const btn = document.getElementById('pay-btn');
    if (btn) { btn.disabled = true; btn.innerHTML = '<span class="material-symbols-outlined">hourglass_top</span> Procesando…'; }
});
</script>
@endpush
