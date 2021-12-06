<?php

namespace App\Http\Controllers;

use App\Models\GeneralOrder;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Cart;

class OrderController extends Controller
{
    public function pay(Request $request){
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6818638913728658-111915-f59959c665c36fc670182cc053de26a7-1022381915");

        $response = json_decode($response);

        $idusuario = auth()->user()->id;
        $fecha_compra = $response->date_created;
        $monto_total = $response->transaction_amount;
        $codigo_compra = $response->order->id;
        $productos = $response->additional_info->items;

        $general_order = new GeneralOrder();
        $general_order->id_usuario = $idusuario;
        $general_order->fecha_compra = $fecha_compra;
        $general_order->monto_total = $monto_total;
        $general_order->codigo_compra = $codigo_compra;
        $general_order->save();

        foreach ($productos as $prod) {
            $product_order = new ProductOrder();
            $product_order->id_producto = (int)$prod->id;
            $product_order->id_orden_general = $general_order->id;
            $product_order->precio = (float)$prod->unit_price;
            $product_order->cantidad = (int)$prod->quantity;
            $aux = (float)$prod->unit_price * (float)$prod->quantity;
            $product_order->subtotal = $aux;
            $product_order->save();
        }

        // dump($response);
        // dd($idusuario);
        Cart::instance('cart')->destroy();
        return redirect()->route('vistaCatalogo');
    }
}
