<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\DiscountSales;
use Illuminate\Http\Request;

class DiscountSalesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesList = DiscountSales::get();
        return view('admin.shop.sales.index', ['salesList' => $salesList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'began_at' => 'required|before:' . $request->ended_at,
            'ended_at' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        //判断是否存在该期间的活动
        try {
            DiscountSales::soldAtExit($data['began_at'], $data['ended_at']);
        } catch (\Exception $e) {
            DiscountSales::create($data);
            return $this->jsonSuccessResponse();
        }
        return $this->jsonFailResponse('活动时间段冲突');
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
        $sales = DiscountSales::findOrFail($id);
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
            'is_sale' => 'required',
            'began_at' => 'required|before:' . $request->ended_at,
            'ended_at' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        //判断是否存在该期间的活动
        $sales = DiscountSales::findOrFail($id);
        try {
            DiscountSales::soldAtExitExcept($data['began_at'], $data['ended_at'], $id);
        } catch (\Exception $e) {
            if ($request->is_sale == 1 && !$sales->canSell()) {
                return $this->jsonFailResponse('上架前先确认有上架的商品');
            }
            $sales->fill($data)->save();
            return $this->jsonSuccessResponse();
        }
        return $this->jsonFailResponse('活动时间段冲突');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiscountSales::destroy($id);
        return $this->jsonSuccessResponse();
    }

    public function sell(Request $request, $id)
    {
        $sales = DiscountSales::findOrFail($id);
        //判断活动是否有商品
        if ($request->is_sale == 1 && !$sales->canSell()) {
            return $this->jsonFailResponse('请先上架促销的商品');
        }
        $sales->is_sale = $request->is_sale;
        $sales->save();
        return $this->jsonSuccessResponse();
    }

    public function details($id)
    {
        $salesList = DiscountSales::orderBy('id', 'ASC')->get();
        $sales = DiscountSales::findOrFail($id);
//        var_dump($sales->details()->with('goods_detail')->get()->toArray());
//        return;
        return view('admin.shop.sales.details', [
            'details' => $sales->details()->get(),
            'salesList' => $salesList,
            'id' => $id
        ]);
    }

}
