<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\DiscountSaleDetails;
use App\Models\DiscountSales;
use Illuminate\Http\Request;

class DiscountSaleDetailsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesList = DiscountSales::orderBy('id', 'DESC')->get();
        return view('admin.shop.sale_details.create', ['salesList' => $salesList]);
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
            'discount_sale_id' => 'required|exists:discount_sales,id',
            'goods_detail_id' => 'required|exists:goods_details,id',
            'discount' => 'required|min:0',
            'is_sale' => 'required',
            'stock' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $detail = DiscountSaleDetails::where('goods_detail_id', '=', $request->goods_detail_id)
            ->where('discount_sale_id', '=', $request->discount_sale_id)
            ->firstOrFail();
        if ($detail) {
            return $this->jsonFailResponse('第' . $request->discount_sale_id . '期已添加该商品');
        }
        $sale = DiscountSaleDetails::create($data);
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
        $salesList = DiscountSales::orderBy('id', 'DESC')->get();
        $detail = DiscountSaleDetails::findOrFail($id);
        return view('admin.shop.sale_details.edit', ['salesList' => $salesList, 'detail' => $detail]);
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
            'discount_sale_id' => 'required|exists:discount_sales,id',
            'goods_detail_id' => 'required|exists:goods_details,id',
            'discount' => 'required|min:0',
            'is_sale' => 'required',
            'stock' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $detail = DiscountSaleDetails::findOrFail($id);
        $detail->fill($data)->save();
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
        DiscountSaleDetails::destroy($id);
        return $this->jsonSuccessResponse();
    }

    public function sell(Request $request, $id)
    {
        $detail = DiscountSaleDetails::findOrFail($id);
        $detail->is_sale = $request->is_sale;
        $detail->save();
        return $this->jsonSuccessResponse();
    }
}
