<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\GoodsSku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GoodsSkuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = GoodsSku::with('childs.childs')->get()->reject(function ($item) {
            return $item['pid'] > 0;
        })->toArray();
//        print_r($list);exit;
//        $list = GoodsSku::get()->toArray();
        return $this->jsonSuccessResponse(['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sku = new GoodsSku();
        $sku->name = $request->name;
        $sku->pid = $request->pid;
        $sku->save();
        print_r($request->all());
        exit;
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
        try {
            $sku = GoodsSku::findOrFail($id);
        } catch (\Exception $e) {
            return $this->jsonFailResponse('找不到有效记录');
        }
//        var_dump($sku);
        return $this->jsonSuccessResponse(['sku' => $sku->toArray()]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        try {
            $sku = GoodsSku::findOrFail($id);
        } catch (\Exception $e) {
            return $this->jsonFailResponse('找不到有效记录');
        }
        $sku->name = $request->name;
        $sku->pid = $request->pid;
        $sku->save();
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
        GoodsSku::destroy($id);
    }
}
