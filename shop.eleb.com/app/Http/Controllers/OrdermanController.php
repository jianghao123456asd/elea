<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\menu;
use App\Models\Order;
use App\Models\order_detail;
use Illuminate\Http\Request;

class OrdermanController extends Controller
{
    //
    public function index()
    {
        $orders = Order::where('shop_id', auth()->user()->shop_id)->get();
//        var_dump($orders);
        return view('order.index', compact('orders'));
    }

    public function fahuo($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        return redirect()->route('Ordermans.index')->with('info', '发货成功');
    }

    public function show($id)
    {
        $or = Order::find($id);
        return view('order.show', compact('or'));
    }

    public function stop($id)
    {
        $order = Order::find($id);
        if ($order->status == 0) {
            $order->status = -1;
            $order->save();
            return redirect()->route('Ordermans.index')->with('info', '取消成功');
        } else {
            return redirect()->route('Ordermans.index')->with('danger', '已发货不能取消');
        }
    }

    public function cha()
    {

    }

    public function tj()
    {
        $order = Order::where('shop_id', auth()->user()->shop_id)->get();
//      var_dump($order);
        $zhou = [];
//       echo date("Y-m-d",strtotime(" +1 day"));
        $zhou = [];

        for ($i = 7; $i > 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i day"));
            $or = Order::where('created_at', 'like', "%$date%")->get()->toArray();
            $count = count($or);
            $zhou += [$date => $count];
        }

//             var_dump($zhou);exit;
        return view('order.yizhou', compact('zhou'));
    }

    public function yue()
    {
        $yue = [];
        $cont = 0;
        for ($i = 3; $i > 0; $i--) {
            $date = date('Y-m', strtotime("-$i month "));
            $or = Order::where('created_at', 'like', "%$date%")->where('shop_id', auth()->user()->shop_id)->get()->toArray();
            $cont += count($or);

//               echo $count;
            $yue += [$date => count($or)];
        }


        return view('order.yue', compact('yue', 'cont'));
    }

    public function cptj()
    {
        $or = Order::where('shop_id', auth()->user()->id);
        $menu = menu::where('shop_id', auth()->user()->id);
        foreach ($or as $o) {

        }

    }

    public function menu()
    {
        $shop_id = Auth::user()->shop_id;
        $shi = date('Y-m-d', strtotime("-6 day"));
        $shi2 = date('Y-m-d 23:59:59 ');
        $sql = "SELECT order_details.goods_name as goods_name,date(orders.created_at) as date,sum(order_details.amount) as total
FROM order_details 
JOIN orders ON order_details.order_id = orders.id
WHERE orders.created_at BETWEEN '{$shi}' AND '{$shi2}' AND orders.shop_id=$shop_id
GROUP BY date,name";
        $rows = DB::select($sql);
//         var_dump($rows);exit;
        $result = [];
        //获取当前商家的菜品列表
        $menus = menu::where('shop_id', $shop_id)->select(['id', 'goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        $menus = $keyed->all();
//         dd($menus);
        $week = [];
        for ($i = 0; $i < 7; $i++) {
            $week[] = date('Y-m-d', strtotime("-{$i} day"));
        }
        foreach ($menus as $name) {
            foreach ($week as $day) {
                $result[$name][$day] = 0;
            }
        }
//         dd($result);
        foreach ($rows as $row) {

            $result[$row->goods_name][$row->date] = $row->total;
        }


//         dd($result);
        $series = [];
        foreach ($result as $id => $data) {
            $serie = [
                'name' => $id,
                'type' => 'line',
                //'stack'=> '销量',
                'data' => array_values($data)
            ];
            $series[] = $serie;
        }
//dd($series);


        return view('order.caizhou', compact('series', 'week'));
    }

    public function menyue()
    {
        $shop_id = Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00', strtotime('-3 month'));
        $time_end = date('Y-m-d 23:59:59');
        $sql = "SELECT
	DATE(orders.created_at) AS date,order_details.goods_id,
	SUM(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	 orders.created_at >= '{$time_start}' AND orders.created_at <= '{$time_end}'
AND shop_id = {$shop_id}
GROUP BY
	DATE(orders.created_at),order_details.goods_id";
        $rows = DB::select($sql);
        //构造7天统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
//        $keyword =0;
        $menus = $keyed->all();


            for ($i=0;$i<3;$i++){
                $week[] = date('Y-m',strtotime("-{$i} month"));

        }

        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }

        foreach ($rows as $row){

                $time = strtotime($row->date);
                $dater = date('Y-m',$time);
                $result[$row->goods_id][$dater]+=$row->total;



        }

        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                //'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }
//        dd($series);
            return view('order.caiyue', compact('series', 'week','menus'));

        }

    }

