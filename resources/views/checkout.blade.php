@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    body > #navbar,
    body > footer {
        display: none;
    }

    #ai-chat {
        position: relative;
        z-index: 100000;
        display: block !important;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .checkout-shell {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background: #eaf7ff;
        color: #0b2538;
        font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .checkout-header {
        position: sticky;
        top: 0;
        z-index: 50;
        width: 100%;
        padding: 16px clamp(18px, 5vw, 32px);
        border-bottom: 1px solid rgba(21, 101, 142, 0.16);
        background: rgba(248, 252, 255, 0.96);
        backdrop-filter: blur(14px);
    }

    .checkout-header-inner {
        width: min(1200px, 100%);
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .checkout-brand {
        color: #0b2538;
        font-size: 24px;
        font-weight: 800;
        line-height: 1.1;
    }

    .checkout-secure {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0284c7;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .checkout-main {
        width: min(1200px, 100%);
        margin: 0 auto;
        padding: 40px clamp(18px, 5vw, 32px) 64px;
        display: grid;
        grid-template-columns: minmax(0, 7fr) minmax(360px, 5fr);
        gap: 64px;
    }

    .checkout-column {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .checkout-title h1,
    .summary-title {
        margin: 0 0 8px;
        color: #0b2538;
        font-size: 24px;
        font-weight: 600;
        line-height: 1.3;
    }

    .checkout-title p {
        margin: 0;
        color: #587082;
        font-size: 14px;
        line-height: 1.5;
    }

    .payment-methods {
        display: grid;
        gap: 12px;
    }

    .payment-method {
        position: relative;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        border: 1px solid rgba(21, 101, 142, 0.16);
        border-radius: 8px;
        background: rgba(248, 252, 255, 0.96);
        cursor: pointer;
        transition: background-color .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .payment-method:hover,
    .payment-method.is-active {
        border-color: #0284c7;
        background: #f8fcff;
        box-shadow: 0 10px 24px rgba(2, 132, 199, .08);
    }

    .payment-method input {
        width: 20px;
        height: 20px;
        margin-top: 4px;
        accent-color: #0284c7;
    }

    .payment-method strong {
        display: block;
        margin-bottom: 4px;
        color: #0b2538;
        font-size: 16px;
        font-weight: 600;
    }

    .payment-method span {
        display: block;
        color: #587082;
        font-size: 14px;
    }

    .payment-method .material-symbols-outlined {
        margin-left: auto;
        color: #76777d;
    }

    .card-panel,
    .summary-card {
        border: 1px solid rgba(21, 101, 142, 0.16);
        border-radius: 8px;
        background: rgba(248, 252, 255, 0.96);
        box-shadow: 0 14px 34px rgba(24, 38, 33, 0.08);
    }

    .card-panel {
        padding: 24px;
        display: grid;
        gap: 24px;
    }

    .checkout-field {
        display: grid;
        gap: 4px;
    }

    .checkout-field label {
        color: #587082;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .checkout-field input {
        width: 100%;
        min-height: 48px;
        padding: 12px 14px;
        border: 1px solid rgba(21, 101, 142, 0.16);
        border-radius: 8px;
        color: #0b2538;
        background: #fff;
        font-size: 16px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .checkout-field input:focus {
        border-color: #0284c7;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
    }

    .input-icon {
        position: relative;
    }

    .input-icon input {
        padding-left: 42px;
    }

    .input-icon .material-symbols-outlined {
        position: absolute;
        left: 12px;
        top: 50%;
        color: #587082;
        font-size: 20px;
        transform: translateY(-50%);
    }

    .input-help {
        position: relative;
    }

    .input-help input {
        padding-right: 42px;
    }

    .input-help .material-symbols-outlined {
        position: absolute;
        right: 12px;
        top: 50%;
        color: #587082;
        font-size: 20px;
        transform: translateY(-50%);
    }

    .field-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .summary-wrap {
        position: relative;
    }

    .summary-card {
        position: sticky;
        top: 100px;
        overflow: hidden;
    }

    .summary-head,
    .summary-item,
    .summary-totals {
        padding: 24px;
    }

    .summary-head,
    .summary-item {
        border-bottom: 1px solid rgba(21, 101, 142, 0.16);
    }

    .summary-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }

    .summary-thumb {
        width: 64px;
        height: 64px;
        overflow: hidden;
        flex-shrink: 0;
        border: 1px solid rgba(21, 101, 142, 0.16);
        border-radius: 8px;
        background: #dff3ff;
    }

    .summary-thumb img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        filter: grayscale(.25);
        opacity: .88;
    }

    .summary-info {
        flex: 1;
        min-width: 0;
    }

    .summary-info strong {
        display: block;
        color: #0b2538;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.45;
    }

    .summary-info span {
        display: block;
        margin-top: 4px;
        color: #587082;
        font-size: 14px;
    }

    .summary-price,
    .summary-row span:last-child,
    .summary-total span:last-child {
        color: #0b2538;
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
    }

    .summary-price {
        font-size: 14px;
        font-weight: 700;
    }

    .summary-totals {
        display: grid;
        gap: 12px;
        background: #f8fcff;
    }

    .summary-row,
    .summary-total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .summary-row {
        color: #587082;
        font-size: 14px;
    }

    .summary-divider {
        height: 1px;
        margin: 4px 0;
        background: rgba(21, 101, 142, 0.16);
    }

    .summary-total {
        margin-bottom: 8px;
        color: #0b2538;
        font-size: 24px;
        font-weight: 600;
    }

    .pay-button {
        width: 100%;
        min-height: 54px;
        padding: 14px 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 0;
        border-radius: 8px;
        color: #fff;
        background: #0284c7;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
        transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
    }

    .pay-button:hover {
        background: #075985;
        transform: translateY(-2px);
        box-shadow: 0 16px 34px rgba(2, 132, 199, 0.2);
    }

    .secure-badges {
        margin-top: 16px;
        display: grid;
        justify-items: center;
        gap: 8px;
        color: #587082;
        text-align: center;
    }

    .secure-badge-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        opacity: .86;
    }

    .secure-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .secure-badges p {
        margin: 0;
        max-width: 420px;
        font-size: 12px;
        line-height: 1.45;
    }

    .checkout-back {
        margin-top: 20px;
        display: inline-flex;
        color: #075985;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .checkout-back:hover {
        text-decoration: underline;
    }

    @media (max-width: 980px) {
        .checkout-main {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .summary-card {
            position: static;
        }
    }

    @media (max-width: 620px) {
        .checkout-header-inner,
        .summary-item,
        .field-grid {
            align-items: stretch;
            grid-template-columns: 1fr;
        }

        .checkout-header-inner {
            flex-direction: column;
        }

        .summary-item {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="checkout-shell">
    <header class="checkout-header">
        <div class="checkout-header-inner">
            <div class="checkout-brand"></div>
            <div class="checkout-secure">
                <span class="material-symbols-outlined">lock</span>
                <span>Pago Seguro</span>
            </div>
        </div>
    </header>

    <main class="checkout-main">
        <section class="checkout-column" aria-labelledby="checkout-title">
            <div class="checkout-title">
                <h1 id="checkout-title">Detalles de Pago</h1>
                <p>Selecciona tu método de pago y completa la información requerida.</p>
            </div>

            <div class="payment-methods">
                <label class="payment-method is-active">
                    <input checked name="payment_method" type="radio">
                    <span>
                        <strong>Tarjeta de Crédito/Débito</strong>
                        <span>Aceptamos Visa, Mastercard, American Express.</span>
                    </span>
                    <span class="material-symbols-outlined">credit_card</span>
                </label>

                <label class="payment-method">
                    <input name="payment_method" type="radio">
                    <span>
                        <strong>Billetera Digital (Yape/Plin)</strong>
                        <span>Paga rápidamente escaneando el código QR.</span>
                    </span>
                    <span class="material-symbols-outlined">qr_code_scanner</span>
                </label>
            </div>

            <form class="card-panel">
                <div class="checkout-field">
                    <label for="card_name">Nombre en la Tarjeta</label>
                    <input id="card_name" type="text" placeholder="Ej. Maria Lopez" autocomplete="cc-name">
                </div>

                <div class="checkout-field">
                    <label for="card_number">Número de Tarjeta</label>
                    <div class="input-icon">
                        <input id="card_number" type="text" placeholder="0000 0000 0000 0000" autocomplete="cc-number">
                        <span class="material-symbols-outlined">credit_card</span>
                    </div>
                </div>

                <div class="field-grid">
                    <div class="checkout-field">
                        <label for="card_exp">Fecha Exp. (MM/AA)</label>
                        <input id="card_exp" type="text" placeholder="MM/AA" autocomplete="cc-exp">
                    </div>

                    <div class="checkout-field">
                        <label for="card_cvc">CVC / CVV</label>
                        <div class="input-help">
                            <input id="card_cvc" type="text" placeholder="123" autocomplete="cc-csc">
                            <span class="material-symbols-outlined" title="Código de 3 o 4 dígitos en el reverso de su tarjeta">help</span>
                        </div>
                    </div>
                </div>

                <a class="checkout-back" href="{{ route('login') }}">Volver al formulario</a>
            </form>
        </section>

        <aside class="summary-wrap" aria-labelledby="summary-title">
            <div class="summary-card">
                <div class="summary-head">
                    <h2 class="summary-title" id="summary-title">Resumen de Compra</h2>
                </div>

                <div class="summary-item">
                    <div class="summary-thumb">
                        <img
                            src="https://images.unsplash.com/photo-1581093588401-fbb62a02f120?auto=format&fit=crop&w=320&q=82"
                            alt="Laboratorio de calidad alimentaria">
                    </div>
                    <div class="summary-info">
                        <strong>Certificación en Gestión de Inocuidad Alimentaria ISO 22000</strong>
                        <span>Acceso ilimitado • 40 hrs</span>
                    </div>
                    <div class="summary-price">S/ 250.00</div>
                </div>

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>S/ 211.86</span>
                    </div>
                    <div class="summary-row">
                        <span>IGV (18%)</span>
                        <span>S/ 38.14</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>S/ 250.00</span>
                    </div>

                    <button class="pay-button" type="button" onclick="showToast('Pago procesado correctamente')">
                        <span class="material-symbols-outlined">check_circle</span>
                        Pagar S/ 250.00
                    </button>

                    <div class="secure-badges">
                        <div class="secure-badge-row">
                            <div class="secure-badge">
                                <span class="material-symbols-outlined">shield</span>
                                SSL Secure
                            </div>
                            <div class="secure-badge">
                                <span class="material-symbols-outlined">verified_user</span>
                                PCI Compliant
                            </div>
                        </div>
                        <p>Sus datos están protegidos. Cumplimos con altos estándares de seguridad y privacidad.</p>
                    </div>
                </div>
            </div>
        </aside>
    </main>
</div>
@endsection
