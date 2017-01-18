<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\GoodsSales;
use App\Models\GoodsSku;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodsList = Goods::with('banner_src')->get()->each(function ($goods) {
            $goods->banner_src->url = Image::baseUrl($goods->banner_src->name);
        });
        return view('admin.shop.goods.index', ['goodsList' => $goodsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skus = GoodsSku::tree();
        return view('admin.shop.goods.create', ['skus' => $skus]);
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
        $data = $request->all();
        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
            'sku_top_id' => 'required|min:1|exists:goods_skus,id,pid,0',
            'banner' => 'required|exists:images,id',
            'details' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
//        Goods::creat
        try {
            \DB::transaction(function () use ($data) {
                $goods = Goods::create($data);
                foreach ($data['details'] as $detail) {
                    $goodsDetail = $goods->details()->create($detail);
                    $temp = [];
                    foreach (explode(',', $detail['sku_id_str']) as $sku_id) {
                        $temp[] = ['sku_id' => $sku_id];
                    }
                    $goodsDetail->skus()->createMany($temp);
                }
//            $goods->details()->createMany($data['details']);
            });
        } catch (\Exception $e) {
            return $this->jsonFailResponse('插入数据库失败');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tree = GoodsSku::tree();
        $goods = Goods::with('details.skus.sku')->with('details.image_src')->with('banner_src')->findOrFail($id);

        $goods->banner_src->url = Image::baseUrl($goods->banner_src->name);
        $goods_sku_ids = $goods->details->pluck('skus')->collapse()->pluck('sku_id')->unique()->toArray();
        $skus = new GoodsSku();
        foreach ($tree as $sku) {
            if ($sku['id'] == $goods->sku_top_id) {
                $skus = $sku->childs;
            }
        }
        return view('admin.shop.goods.edit', [
            'tree' => $tree,
            'goods' => $goods,
            'skus' => $skus,
            'goods_sku_ids' => $goods_sku_ids
        ]);
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
        $data = $request->all();
        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
            'sku_top_id' => 'required|min:1|exists:goods_skus,id,pid,0',
            'banner' => 'required|exists:images,id',
            'details' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        try {
            \DB::transaction(function () use ($id, $data) {
//            $goods = new Goods();
                $goods = Goods::findOrFail($id);
                $goods = $goods->fill($data)->save();
                foreach ($data['details'] as $detail) {
                    //判断是否存在id
                    if ($detail['id']) {
                        $goodsDetail = GoodsDetail::findOrFail($detail['id']);
                        $goodsDetail->fill($detail)->save();
                    } else {
                        $goodsDetail = $goods->details()->create($detail);
                        $temp = [];
                        foreach (explode(',', $detail['sku_id_str']) as $sku_id) {
                            $temp[] = ['sku_id' => $sku_id];
                        }
                        $goodsDetail->skus()->createMany($temp);
                    }
                }
            });
        } catch (\Exception $e) {
            return $this->jsonFailResponse('插入数据库失败');
        }
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

    public function sellChange(Request $request, $id)
    {
        $sales = Goods::findOrFail($id);
        $sales->is_sale = $request->is_sale;
        $sales->save();
        return $this->jsonSuccessResponse();
    }
}
