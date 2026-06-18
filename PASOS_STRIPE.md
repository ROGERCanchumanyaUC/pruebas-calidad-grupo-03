# Configuración y pruebas de Stripe Checkout

Esta guía explica cómo activar y probar la pasarela de pago **Stripe Checkout**
integrada en `PaymentController` y `StripeService`.

## 1. Obtener las llaves de prueba de Stripe

1. Crea una cuenta gratuita en https://dashboard.stripe.com/register (o inicia
   sesión si ya tienes una).
2. Asegúrate de estar en **modo de prueba** (Test mode). El interruptor está
   en la esquina superior derecha del dashboard.
3. Ve a **Desarrolladores > Claves de API** (Developers > API keys):
   https://dashboard.stripe.com/test/apikeys
4. Copia:
   - **Publishable key** (`pk_test` + tu clave) → variable `STRIPE_KEY`.
   - **Secret key** (`sk_test` + tu clave) → variable `STRIPE_SECRET`.

   La `STRIPE_KEY` no la usa actualmente el backend (no hay Stripe Elements en
   el frontend porque usamos Stripe Checkout alojado), pero se recomienda
   configurarla igual para futuros usos.

## 2. Configurar el archivo `.env`

Edita tu `.env` (basado en `.env.example`) y completa:

```env
STRIPE_KEY=tu_publishable_key_de_stripe
STRIPE_SECRET=tu_secret_key_de_stripe
STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxxxxxxxxxxxxx
STRIPE_CURRENCY=pen
```

- `STRIPE_WEBHOOK_SECRET` se obtiene en el paso 4 (Stripe CLI) o, en
  producción, al crear el endpoint de webhook en el dashboard
  (**Desarrolladores > Webhooks**).
- `STRIPE_CURRENCY` es la moneda usada en `line_items` y en los cupones
  de Stripe (`pen` = soles peruanos). Cámbiala solo si tu cuenta de Stripe
  no soporta PEN; en ese caso usa `usd` u otra moneda soportada.

Después de editar `.env`, limpia la caché de configuración:

```bash
php artisan config:clear
```

> Si `STRIPE_SECRET` está vacío, `StripeService::isConfigured()` devuelve
> `false` y `PaymentController::process()` redirige al checkout con un
> mensaje amigable en lugar de fallar.

## 3. Probar un pago con la tarjeta de prueba

1. Inicia el servidor de desarrollo (`php artisan serve` o XAMPP/Apache).
2. Inicia sesión, agrega uno o más cursos al carrito y entra a `/checkout`.
3. Haz clic en **Pagar**. Esto envía un `POST` a `pago.procesar`, que crea
   una `Sale` en estado `pendiente` y te redirige a la página de pago alojada
   por Stripe (`checkout.stripe.com`).
4. En el formulario de Stripe usa una de las **tarjetas de prueba**:

   | Campo            | Valor                  |
   |------------------|------------------------|
   | Número de tarjeta| `4242 4242 4242 4242`  |
   | Fecha de vencimiento | Cualquier fecha futura (ej. `12/34`) |
   | CVC              | Cualquier 3 dígitos (ej. `123`) |
   | Nombre/País      | Cualquier valor        |

5. Al completar el pago, Stripe redirige a:
   - `pago.confirmar` (`success_url`) si el pago fue exitoso → el sistema
     verifica la sesión, marca la venta como `pagado`, crea/activa las
     inscripciones y redirige a `pago.exito`.
   - `pago.cancelado/{sale}` (`cancel_url`) si el usuario cancela → la venta
     se marca como `fallido` y el carrito se conserva para reintentar.

Otras tarjetas de prueba útiles (todas con cualquier fecha futura y CVC):

- `4000 0000 0000 9995` → pago rechazado (fondos insuficientes).
- `4000 0025 0000 3155` → requiere autenticación 3D Secure.

Más tarjetas: https://stripe.com/docs/testing

## 4. Probar el webhook localmente con Stripe CLI

El webhook (`POST /stripe/webhook`, ruta `stripe.webhook`) confirma el pago
de forma confiable incluso si el usuario cierra el navegador antes de volver
a `pago.confirmar`. Para probarlo en local necesitas la
[Stripe CLI](https://stripe.com/docs/stripe-cli):

1. Instala la Stripe CLI (Windows: `scoop install stripe` o descarga el
   binario desde https://github.com/stripe/stripe-cli/releases).
2. Inicia sesión:

   ```bash
   stripe login
   ```

3. Reenvía los eventos de webhook a tu servidor local:

   ```bash
   stripe listen --forward-to http://127.0.0.1:8000/stripe/webhook
   ```

   Ajusta el host/puerto si usas XAMPP en otra URL (por ejemplo
   `http://localhost/SOFTWARE_FINAL/public/stripe/webhook`).

4. La CLI imprimirá un secreto de firma temporal, por ejemplo:

   ```
   Ready! Your webhook signing secret is whsec_XXXXXXXXXXXXXXXXXXXXXXXX (^C to quit)
   ```

   Copia ese valor en `STRIPE_WEBHOOK_SECRET` dentro de `.env` y ejecuta de
   nuevo `php artisan config:clear`.

5. Con `stripe listen` corriendo, realiza un pago de prueba (paso 3). La CLI
   mostrará el evento `checkout.session.completed` reenviado a
   `/stripe/webhook` y la respuesta del servidor (`200 {"received":true}`).

6. También puedes disparar un evento de prueba manualmente sin completar un
   pago real:

   ```bash
   stripe trigger checkout.session.completed
   ```

   (Este evento de prueba no incluirá `metadata.sale_id` de una venta real,
   por lo que el controlador solo registrará un `Log::error` indicando que no
   encontró la venta; esto es esperado y sirve para validar que la firma se
   verifica correctamente.)

## 5. Notas de seguridad (PCI)

- El servidor **nunca** recibe ni almacena datos de tarjeta: todo el
  formulario de pago es alojado por Stripe (Stripe Checkout).
- La ruta `stripe/webhook` está exenta de CSRF (`bootstrap/app.php`) porque
  es una llamada servidor-a-servidor desde Stripe, pero su autenticidad se
  valida con `Stripe\Webhook::constructEvent()` usando `STRIPE_WEBHOOK_SECRET`.
- La confirmación de la venta (`confirmSale`) es **idempotente**: tanto el
  retorno del navegador (`pago.confirmar`) como el webhook pueden llamarla
  para la misma venta sin duplicar inscripciones ni contabilizar el cupón
  más de una vez.
