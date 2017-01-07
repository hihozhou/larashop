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
        $skus = GoodsSku::with('childs.childs')->get()->reject(function ($item) {
            return $item['pid'] > 0;
        });
//        print_r($list);exit;
//        $list = GoodsSku::get()->toArray();
        return view('admin.sku.index', ['skus' => $skus]);
//        return $this->jsonSuccessResponse(['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sku.create');
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $sku = new GoodsSku();
        $sku->name = $request->name;
        $sku->pid = $request->pid;
        if (!$sku->save()) {
            return $this->jsonFailResponse('操作错误');
        }
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
        $sku = GoodsSku::findOrFail($id);
        return view('admin.sku.edit', ['sku' => $sku]);
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
        if (GoodsSku::destroy($id)) {
            return $this->jsonSuccessResponse();
        }
        return $this->jsonFailResponse('删除数据失败');
    }
}
