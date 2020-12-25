<?php

namespace App\Http\Controllers;

use App\Classes\ShoppingCartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pago;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    public function pagoPaypal() {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $cantidad = $this->getTotalPayment();
        $amount = new Amount();
        $amount->setTotal($cantidad);
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/tienda')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $transaction = $payment->getTransactions();
        $amount = $transaction[0]->getAmount()->getTotal();
        $email= $payment->getPayer()->getPayerInfo()->getEmail();
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            //Insertar la orden de pago y la transacción
            $order = new Order();
            $order->id_client = session('id');
            $order->total = $amount;
            $order->status = "COMPLETADO";
            $order->save();

            $transactionBD = new \App\Models\Transaction();
            $transactionBD->id_order = $order->id;
            $transactionBD->id_client = session('id');
            $transactionBD->currency = $transaction[0]->getAmount()->currency;
            $transactionBD->status = "COMPLETADO";
            $transactionBD->total = $amount;
            $transactionBD->payment_method = "PAYPAL";
            $transactionBD->save();

            $this->createOrderDetails($order->id);

            $pago_id = $paymentId;
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.
            ID DEL PAGO: ' . $pago_id;

            //Se vacia el carrito tras realizar el pago
            $this->vaciarCarrito();
            return redirect('/tienda')->with('exito', $status);
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/tienda')->with('error', $status);
    }

    public function getTotalPayment() {
        $datos = session()->all();
        $totalPago = 0;
        foreach ($datos as $key => $cantidad) {
            if(substr($key, 0, 5) == 'PROD-') {
                $prodID = substr($key, 5);
                $producto = Product::where('id', $prodID)->first();

                $totalPago += $cantidad * $producto->price;
            }
        }
        return $totalPago;
    }

    public function vaciarCarrito() {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if(substr($producto, 0, 5) == 'PROD-') {
                session()->forget($producto);
            }
        }
    }

    public function createOrderDetails($orderID) {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if(substr($producto, 0, 5) == 'PROD-') {
                $prodID = substr($producto, 5);
                $infoProducto = Product::where('id', $prodID)->first();

                //Update stock
                $infoProducto->stock -= $cantidad;
                $infoProducto->save();

                $orderDetail = new OrderDetail();
                $orderDetail->id_order = $orderID;
                $orderDetail->id_product = $prodID;
                $orderDetail->price = $infoProducto->price;
                $orderDetail->quantity = $cantidad;
                $orderDetail->save();
            }
        }
    }
}
