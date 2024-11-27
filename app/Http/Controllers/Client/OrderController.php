<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showCheckout(User $user)
    {
        $addressDefautl = $user->defaultAddress;
        $allAddresses = $user->addresses;
        $cartItems = $user->cart->cartItems()->with([
            'productVariant.product',
            'productVariant.attributes.attribute',
        ])->orderByDesc('id')->get();
        return view('client.checkout', compact('addressDefautl', 'allAddresses', 'cartItems'));
    }


    public function createOrder(Request $request){
        $request->validate([
            'address_id' => 'required',
            'payment_method' => 'required',
            'total_price' => 'required',
            'user_id' => 'required',
            'note' => 'nullable',
        ]);
        $paymentMethod = $request->input('payment_method');
        $data = [
            'address_id' => $request->input('address_id'),
            'total_price' => $request->input('total_price'),
            'user_id' => $request->input('user_id'),
            'note' => $request->input('note'),

        ];
        $cartItems = json_decode($request->input('cart_items'));
        $orderDetails = [];
        foreach($cartItems as $cartItem){
            $price = ProductVariant::query()->findOrFail($cartItem->product_variant_id)->getCurrentPrice();
            $orderDetails[] = [
                'seller_id' => $cartItem->product_variant->product->seller_id,
                'product_variant_id' => $cartItem->product_variant_id,
                'quantity' => $cartItem->quantity,
                'name' => $cartItem->product_variant->product->name,
                'image' => $cartItem->product_variant->image,
                'price' => $price,
            ];
        }
        switch ($paymentMethod) {
            case 'cash':{
                $data = array_merge($data,[
                    'payment_method_id' => 2,
                    'payment_status_id' => 1,
                    'order_status_id' => 1
                ]);
                $order = Order::create($data);
                foreach ($orderDetails as $orderDetail){
                    $order->orderDetails()->create($orderDetail);
                    $this->updateQuantityProductVariant($orderDetail['quantity'], $orderDetail['product_variant_id']);
                }
                Cart::query()->where('user_id', auth()->id())->delete();
                session()->put('order_id', $order->id);
                return redirect()->route('thank');
            }
            case 'payUrl':{

                $data = array_merge($data, [
                    'payment_method_id' => 1,
                    'payment_status_id' => 2,
                    'order_status_id' => 1
                ]);
                session(['orderDetails' => $orderDetails]);
                session(['order' => $data]);
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $data['total_price'];
                $orderId = time() . "";
                $redirectUrl = config('app.url') . '/order/check';
                $ipnUrl =  config('app.url') . '/order/check';
                $extraData = "";


                // $partnerCode = $partnerCode;
                // $accessKey = $_POST["accessKey"];
                $serectkey = $secretKey;

                $requestId = time() . "";
                $requestType = "payWithATM";
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = self::execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);
                if($jsonResult['resultCode'] === 0){
                    return redirect()->to($jsonResult['payUrl']);
                }else{
                    return back()->with('error', $jsonResult['message']);
                }
            }
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function checkOrderMomo(Request $request){
        $user = User::query()->find(auth()->id());
        if($request->input('resultCode') == 0){
            $order = Order::create(session('order'));
            foreach (session('orderDetails') as $orderDetail){
                $order->orderDetails()->create($orderDetail);
                $this->updateQuantityProductVariant($orderDetail['quantity'], $orderDetail['product_variant_id']);
            }
            session()->put('order_id', $order->id);
            session()->forget(['order', 'orderDetails']);
            Cart::query()->where('user_id', $user->id)->delete();
            return redirect()->route('thank');
        }
        return redirect()->route('checkout.show', $user)->with('error', $request->input('resultMessage'));
    }

    public function updateQuantityProductVariant($quantity, $productVariantId){
        $productVariant =  ProductVariant::query()->findOrFail($productVariantId);
        $newQuantity = $productVariant->stock_quantity - $quantity;

        $productVariant->update(['stock_quantity' => $newQuantity]);
    }



    public function thank()
    {
        if (session('order_id')){
            $order = Order::with(['orderDetails.productVariant.attributes.attribute', 'address.details', 'user', 'paymentStatus'])->find(session('order_id'));
            session()->forget('order_id');
            return view('client.thank', compact('order'));
        }
        return redirect('/');
    }
}
