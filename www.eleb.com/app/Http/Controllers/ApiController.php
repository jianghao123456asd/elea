<?php

namespace App\Http\Controllers;
use App\Models\Addresse;
use App\Models\carts;
use App\Models\Order;
use App\Models\Order_details;
use Illuminate\Support\Facades\Redis;
use Monolog\Handler\IFTTTHandler;
use Psy\Test\Input\CodeArgumentTest;
use Qcloud\Sms\SmsSingleSender;
use App\Models\Member;
use App\Models\menu;
use App\Models\menu_categorie;
use App\Models\Menu_categories;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //
     public function businessList(Request $request){
         $keyword=$request->keywrod;
         $shops=shop::where('status',1)->get();
         if ($keyword){
                  $shops= shop::where('shop_name','like',"%$keyword%")->where('status',1)->get();
                  }
         return $shops;
     }
     public function businessphp(){
         $id = $_GET['id'];
//        dd($id);
         $shop = Shop::find($id);
        $menucategories = Menu_categories::where('shop_id','=',$id)->get();
         foreach ($menucategories as $menucategory){
             $menucategory['goods_list'] = Menu::where('category_id','=',$menucategory->id)->get();
             foreach ($menucategory['goods_list'] as $goods){
                 $goods['goods_id']=$goods->id;
             }
         }
         $shop['commodity'] = $menucategories;

         return $shop;


}
    public function sms(Request $request){
        // 短信应用SDK AppID
        $appid =1400188022; // 1400开头
       $tel=$request->tel;
// 短信应用SDK AppKey
        $appkey = "a9fcf0ffcac8c1ec6a794e06735034ec";

// 需要发送短信的手机号码
        $phoneNumber = $tel;

// 短信模板ID，需要在短信应用中申请
        $templateId = 285217;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "kxy的园地"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [mt_rand(1000,9999),5];
       Redis::set($phoneNumber,$params[0],500);
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信



            var_dump($result);
        } catch(\Exception $e) {
               var_dump($e);
        }

    }


    public function regist(Request $request){
//     $sms=Redis::get($request->tel);
           $tel=$request->tel;
        $con=Member::where('tel',$tel)->get();
        $name=$request->username;
        $name1=Member::where('username',$name)->get();
           if (count($con)!=0) {
               return ['status'=>'false','message'=>'手机号码已被注册'];

           }elseif (count($name1)!=0){
               return ['status'=>'false','message'=>'用户名已存在'];
           }
        $sms=Redis::get($request->tel);
         if ($request->sms==$sms){

             $member=new Member();
             $member->username=$request->username;
             $member->password=Hash::make($request->password);
             $member->tel=$request->tel;
             $member->save();
             return ['status'=>'true','message'=>'注册成功'];

         }else{
             return ['status'=>'false','message'=>'验证码错误'];


         }






        }
        public function loginCheck(Request $request){

            if(Auth::attempt([
                'username'=>$request->name,
                'password'=>$request->password
            ],$request->has('rememberMe'))){
                $result = ['status'=>'true','message'=>"登录成功",'user_id'=>auth()->user()->id,
                    'username'=>auth()->user()->username];
                return  $result;

            }else{
                return ['status'=>'false','message'=>'验证码错误'];
            }

        }
         public function addAddress(Request $request){
                   //auth()->user()->id

               $addresse=new Addresse();
               $addresse->user_id=auth()->user()->id;
               $addresse->provence=$request->provence;
               $addresse->city=$request->city;
               $addresse->area=$request->area;
               $addresse->detail_address=$request->detail_address;
               $addresse->tel=$request->tel;
               $addresse->name=$request->name;
               $addresse->save();
                return ['status'=>'true','message'=>'添加成功'];
         }
         public function addressList(){

             $Addresse=Addresse::where('user_id',auth()->user()->id)->get();
          return $Addresse;
         }
         public function  address(Request $request){
           $addresse=Addresse::find($request->id);
           return $addresse;
         }
         public function editAddress(Request $request){
//             $id=$request->id;
                $addresse=Addresse::find($request->id);
                $addresse->name=$request->name;
                $addresse->city=$request->city;
                $addresse->area=$request->area;
                $addresse->detail_address=$request->detail_address;
             $addresse->tel=$request->tel;
             $addresse->name=$request->name;
             $addresse->save();
             return ['status'=>'true','message'=>'修改成功'];
         }
         public function addCart(Request $request){
              $goods_id=$request->goodsList;
              $goodscount=$request->goodsCount;
             for ($i=0;$i<count($goods_id);$i++){
                 $carts= new carts();
                 $carts->user_id=auth()->user()->id;
                 $carts->goods_id=$goods_id[$i];
                 $carts->amount=$goodscount[$i];
                 $carts->save();
                 }
             return ['status'=>'true','message'=>'添加成功'];

         }
         public function cart(Request $request){

             $cate = carts::where('user_id','=',auth()->user()->id)->get();
             $totalCost =0;
             foreach($cate as $cat){
                 $data = Menu::find($cat->goods_id);

                 $cat['goods_name'] = $data->goods_name;
                 $cat['goods_img'] = $data->goods_img;
                 $cat['goods_price'] = $data->goods_price;
                 $totalCost += $cat->amount * $cat->goods_price;
             }
             $datar['goods_list']=$cate;
             $datar['totalCost']=$totalCost;
             return $datar;
             }
         public function addorder(Request $request){
             DB::beginTransaction();
             try{
             $addresse=Addresse::find($request->address_id);
             $cate = carts::where('user_id','=',\auth()->user()->id)->get()->toArray();
             $totalCost=0;
             foreach ($cate as $cat){
             $goods=menu::find($cat['goods_id']);
             $cat['goods_price'] =$goods->goods_price;
             $totalCost += $cat['goods_price'] * $cat['amount'];
              }


             $goods_id=($cate[0]['goods_id']);
             $menu=Menu::where('id',$goods_id)->get()->toArray();

                       $shop_id=$menu[0]['shop_id'];

                       $order=new Order();
                       $order->user_id=\auth()->user()->id;
                       $order->shop_id	=$shop_id;
                       $order->sn=date('Ymd').mt_rand(10000000,99999999);
                       $order->province=$addresse->provence;
                       $order->city=$addresse->city;
                       $order->county=$addresse->area;
                       $order->address=$addresse->detail_address;
                       $order->tel=$addresse->tel;
                       $order->name=$addresse->name;
                       $order->total=$totalCost;
                       $order->status=0;
                       $order->out_trade_no=mt_rand(10000000,99999999);
                       $order->save();

                       foreach ($cate as $cat) {
                           $goods=menu::find($cat['goods_id']);
                       $order_details= new Order_details();
                       $order_details->order_id=$order->id;
                       $order_details->goods_id=$goods->id;
                       $order_details->amount=$cat['amount'];
                       $order_details->goods_name=$goods->goods_name;
                       $order_details->goods_img=$goods->goods_img;
                       $order_details->goods_price=$goods->goods_price;
                       $order_details->save();
                       }

                 DB::commit();
                 // 短信应用SDK AppID
                 $appid =1400188022; // 1400开头
                 $tel=15928830307;
// 短信应用SDK AppKey
                 $appkey = "a9fcf0ffcac8c1ec6a794e06735034ec";

// 需要发送短信的手机号码
                 $phoneNumber = $tel;

// 短信模板ID，需要在短信应用中申请
                 $templateId = 285217;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

                 $smsSign = "kxy的园地"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

                 try {
                     $ssender = new SmsSingleSender($appid, $appkey);
                     $params = [mt_rand(1000,9999),5];
                     Redis::set($phoneNumber,$params[0],500);
                     $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                         $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信


                 } catch(\Exception $e) {

                     var_dump($e);
                 }
                 $title = '饱了吗';
                 $content = '<p>	
重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
    你店铺已经产生订单</p>';
                 try{
                     \Illuminate\Support\Facades\Mail::send('youjian.yj',compact('title','content'),
                         function($message){
                             $to = '15928830307@163.com';
                             $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
                         });
                 }catch (Exception $e){
                     return '邮件发送失败';
//
                 }          $title = '饱了吗';
                 $content = '<p>	
重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
    你店铺已经产生订单</p>';
                 try{
                     \Illuminate\Support\Facades\Mail::send('youjian.yj',compact('title','content'),
                         function($message){
                             $to = '15928830307@163.com';
                             $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
                         });
                 }catch (Exception $e){
                     return '邮件发送失败';
//
                 }

                 return ["status"=> "true","message"=> "添加成功","order_id"=>$order->id];
             }catch(QueryException $exception){
                 DB::rollBack();
             }

//            $addresse=Addresse::where('id',$request->address_id)->get();
         }
         public function order(Request $request){

//          return $request->id;
         $order=Order::find($request->id);
       $shop=shop::find($order->shop_id);
        $goods= Order_details::where('order_id',$request->id)->get();
             $data=[
                 "id"=>$order->id,
                 "order_code"=>$order->sn,
                 "order_address"=>$order->address,
                 "order_birth_time"=>$order->created_at->toArray()['formatted'],
                 "shop_id"=>$order->shop_id,
                 "order_status" =>$order->status,
                 "order_price" =>$order->total
 
                 ];
              
               $data["goods_list"]=$goods;
             $cate = carts::where('user_id','=',\auth()->user()->id)->get()->toArray();
             $totalCost=0;
             foreach ($cate as $cat){
                 $goods=menu::find($cat['goods_id']);
                 $cat['goods_price'] =$goods->goods_price;
                 $totalCost += $cat['goods_price'] * $cat['amount'];
             }
             $data[]=['order_price'=>$totalCost,'order_address'=>$order->address];
               return $data;
                                     }

         public function changePassword(Request $request){
             $jiu=$request->oldPassword;
             $xin=$request->newPassword;
       if (Hash::check($jiu,\auth()->user()->password)) {

                 $m=Member::find(\auth()->user()->id);
                   $m->password=Hash::make($xin);
                   $m->save();
                    return ['status'=>'true','message'=>'修改成功'];
             }else{
           return ['status'=>'false','message'=>'旧密码错误'];
             }
             }
             public function forgetPassword(Request $request){
                 $sms=Redis::get($request->tel);
                   if ($sms==$request->sms){
                       $password=Hash::make($request->password);
                    Member::where('tel',$request->tel)->update(['password'=>$password]);
                       return ['status'=>'true','message'=>'修改成功'];
                   }else{
                       return ['status'=>'false','message'=>'修改失败'];
                   }
                     }
                     public function apiorderList(){
                         $orders = Order::where('user_id','=',62)->get();
                         $all =[];
                         foreach ($orders as $order){
                             $orderDetails = Order_details::where('order_id','=',$order->id)->get();
                             $status = "";
                             switch ($order->status){
                                 case -1:
                                     $status = "已取消";
                                     break;
                                 case 0:
                                     $status = "待支付";
                                     break;
                                 case 1:
                                     $status = "待发货";
                                     break;
                                 case 2:
                                     $status = "待确认";
                                     break;
                                 case 3:
                                     $status = "完成";
                                     break;
                             }
                             $data =[
                                 "id"=>$order->id,
                                 "order_code"=>$order->sn,
                                 "order_address"=>$order->address,
                                 "order_birth_time"=>$order->created_at->toArray()['formatted'],
                                 "shop_id"=>$order->shop_id,
                                 "order_status" =>$status,
                                 "order_price" =>$order->total
                             ];

                             foreach($orderDetails as $orderDetail){
                                 $shops = Shop::find(Menu::find(carts::where('user_id','=',62)->first()->goods_id)->shop_id);
                                 $orderDetail["amount"]=$orderDetail->amount;
                                 $orderDetail["goods_id"]=$orderDetail->goods_id;
                                 $orderDetail["goods_name"]=$orderDetail->goods_name;
                                 $orderDetail["goods_img"]=$orderDetail->goods_img;
                                 $orderDetail["goods_price"]=$orderDetail->goods_price;
                                 $data["shop_id"]=$shops->id;
                                 $data["shop_img"]=$shops->shop_img;
                                 $data["shop_name"]=$shops->shop_name;
                             }
                             $data["goods_list"] = $orderDetails;
                             $all[]=$data;
                         }
                         return $all;
// $all=[];
//                    $order=Order::where('user_id',62)->get();
//                      foreach ($order as $orde){
//                          $a=Order_details::where('order_id',$orde->id)->get();
//                          $shop=Shop::find($orde->shop_id);
//                          $data =[
//                              "id"=>$orde->id,
//                              "order_code"=>$orde->sn,
//                              "order_birth_time"=>$orde->created_at->toArray()['formatted'],
//                              "shop_id"=>$orde->shop_id,
//                              "order_status" =>$orde->status,
//                              "shop_name"=>$shop->shop_name,
//                              'shop_img'=>$shop->shop_img,
//                          ][['goods_list']]=$a;
//
//
//
////
//
//
////                              $goods = [
////                                  'goods_id' => $order_detail->goods_id,
////                                  'goods_name' => $order_detail->goods_name,
////                                  'goods_img' => $order_detail->goods_img,
////                                  'amount' => $order_detail->amount,
////                                  'goods_price' => $order_detail->goods_price
////                              ];
//
//
//                          }
//                         return $all[]=$data;
////                          $data['goods_list']=$goods;
////
////                          $all=$data;
////                         return $all;
//
//
//
//                     }




}
}

