<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\GoodsSales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;

class GoodsSalesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesList = GoodsSales::with('detail.image_src', 'detail.goods', 'detail.skus.sku')->get();
//        var_dump($salesList->toArray());exit;
        return view('admin.shop.sales.index', ['salesList' => $salesList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //判断goods_detail_id是否存在
        $sales = GoodsSales::where('goods_detail_id', '=', $request->goods_detail_id)->first();
        if ($sales) {
            return redirect()->action(
                'Admin\GoodsSalesController@edit', ['id' => $sales->id]
            );
        }
        return view('admin.shop.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'goods_detail_id' => 'required|exists:goods_details,id',
            'discount' => 'required|min:0',
            'is_sale' => 'required',
            'stock' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $sale = GoodsSales::create($data);
        return $this->jsonSuccessResponse();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sales = GoodsSales::findOrFail($id);
        return view('admin.shop.sales.edit', ['sales' => $sales]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'goods_detail_id' => 'required|exists:goods_details,id',
            'discount' => 'required|min:0',
            'is_sale' => 'required',
            'stock' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $sales = GoodsSales::findOrFail($id);
        $sales->fill($data)->save();
        return $this->jsonSuccessResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function timeUpdate(Request $request)
    {

        GoodsSales::cacheSoldBeganAt($request->began_at);
        GoodsSales::cacheSoldEndedAt($request->ended_at);
        return $this->jsonSuccessResponse();

//        $beganAt = strtotime($request->began_at);
//        $endedAt = strtotime($request->ended_at);
//        var_dump($beganAt);
//        $path = base_path('.env');
//        if (file_exists($path)) {
//            //判断SOLD_AT是否存在
//            var_dump(env('SOLD_BEGAN_AT'));
//            if (!env('SOLD_BEGAN_AT')) {
//                $str = "\r\n\r\nSOLD_BEGAN_AT=" . $beganAt;
//                file_put_contents($path, $str, FILE_APPEND);
//            } else {
//                file_put_contents($path, str_replace(
//                    'SOLD_BEGAN_AT=' . env('SOLD_BEGAN_AT'), 'SOLD_BEGAN_AT=' . $beganAt, file_get_contents($path)
//                ));
//            }
//
//            if (!env('SOLD_ENDED_AT')) {
//                $str = "\r\nSOLD_ENDED_AT=" . $endedAt;
//                file_put_contents($path, $str, FILE_APPEND);
//            } else {
//                file_put_contents($path, str_replace(
//                    'SOLD_ENDED_AT=' . env('SOLD_ENDED_AT'), 'SOLD_ENDED_AT=' . $endedAt, file_get_contents($path)
//                ));
//            }
//
//            return $this->jsonSuccessResponse();
//        }
//        return $this->jsonFailResponse('找不到.env文件');
    }

}
