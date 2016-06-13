<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PayPal;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Product;
use App\payment_detail;
use Illuminate\Support\Facades\Auth;



class PaypalController extends Controller
{

    private $_apiContext;

    public function __construct()
    {

        $paypal = new \Netshell\Paypal\Paypal;
        $this->_apiContext = $paypal->ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret')
        );

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    /**
     * Cart view
     *
     * @return mixed
     */

    public function cart()
    {
        
        $cart = Cart::instance('shopping')->content();
        $count = Cart::instance('shopping')->count();
        $total = Cart::instance('shopping')->total();
        return view('cart.cart', compact('cart', 'total', 'count'));
    }

    /**
     * Add to cart by given request
     *
     * @param Request $request
     */
    public function addToCrat (Request $request)
    {

        Cart::instance('shopping')->add(['id' => $request['id'], 'name' => $request['title'], 'qty' => 1, 'price' => $request['price']]);
    }

    /**
     * Delete cart
     *
     * @return mixed
     */
    public function destroyCart()
    {
        
        Cart::instance('shopping')->destroy();
        return redirect('/market');
    }

    /**
     * Remove products from card by given $request
     *
     * @param Request $request
     * @return mixed
     */
    public function removeFromCart (Request $request)
    {

        $rowId = $request['id'];
        $remove = Cart::instance('shopping')->remove($rowId);
        if ($remove === null) {
            return response()->json([
                     'success' => true,
                    'count' => Cart::instance('shopping')->count(),
                    'total' => Cart::instance('shopping')->total()]
            );
        };
    }


    public function getCheckout (Request $request)
    {

        $paypal = new \Netshell\Paypal\Paypal;

        $checkboxName = "checkbox_";
        $total = 0;
        if (count($request->all()) == 1) {
           return redirect('/market/cart')->with('errorSelectProducts', 'Please select  products from cart which you wont order');
        } else{

            foreach ($request->all() as $key => $value) {

                $check = strripos($key, $checkboxName);
                if ($check !== false) {

                    $selectedProducts = Cart::instance('shopping')->search(array('rowid' => $value));
                    $item = Cart::instance('shopping')->get($selectedProducts[0]);
                    $item['name'] = $paypal->item();
                    $item['name']->setName($item['name'])->setCurrency('USD')->setQuantity($item['qty'])->setPrice($item['price']);
                    $total += $item['qty'] * $item['price'];

                }
            }
        }

        $payer = $paypal->Payer();
        $payer->setPaymentMethod('paypal');

        $amount = $paypal->Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($total);
        
        $transaction = $paypal->Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Ordered products');

        $redirectUrls = $paypal->RedirectUrls();
        $redirectUrls->setReturnUrl(route('getDone'));
        $redirectUrls->setCancelUrl(route('getCancel'));

        $payment = $paypal->Payment();
        $payment->setPayer($payer);
        $payment->setIntent('sale');
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;
        return redirect()->to($redirectUrl);

    }

    public function getDone (Request $request)
    {
        
        $paypal = new \Netshell\Paypal\Paypal;
        $id = $request['paymentId'];
        $token = $request['token'];
        $payerId = $request['PayerID'];
        $payment = $paypal->getById($id, $this->_apiContext);//payment details

        $paymentDetail = new payment_detail();
        $paymentDetail->user_id = Auth::user()->id;
        $paymentDetail->payer_id = $payerId;
        $paymentDetail->payment_id = $id;
        $paymentDetail->_token = $token;
        $paymentDetail->save();

        $paymentExecution = $paypal->PaymentExecution();//payment
        $paymentExecution->setPayerId($payerId);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
        //Cart::instance('shopping')->destroy();
        return redirect('/market/cart');
    }

    public function getCancel ()
    {

        dd('Cancel');
        return redirect('/market')->with('paymentFalse', 'Payment false please try again later');
    }
    
}
