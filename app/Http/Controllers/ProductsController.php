<?php
/*
 * @Description:
 * @Version: 2.0
 * @Autor: Wz
 * @Date: 2019-04-26 09:12:46
 * @LastEditors  : Wz
 * @LastEditTime : 2020-01-19 16:34:20
 */

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // 首页商品列表
    public function index(Request $request)
    {
        // 创建一个查询构造器
        $builder = Product::query()->where('on_sale', true);
        // 判断是否提交 search 参数,如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%' . $search . '%';
            // 模糊搜索商品标题、详情、SKU 标题、 SKU 描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }
        // 是否提交 order 参数,如果有就赋值给 $order 变量
        // order 参数用来控制商品的排序规则
        if ($order = $request->input('order', '')) {
            // 是否以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一, 说明是一个合法的排序只
                if (in_array($m[1], ['price', 'sold_count', 'rating']));{
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        $products = $builder->paginate(16);

        return view('products.index', [
            'products' => $products,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
            ],
        ]);
    }

    /**
     * @Author      WangZe
     * @DateTime    2019-04-08
     * @description 商品详情
     * @copyright   [copyright]
     * @license     [license]
     * @version     [version]
     * @param       Product       $id [description]
     * @return      [type]            [description]
     */
    public function show(Product $product, Request $request)
    {
        // $product = Product::find($request->product);
        // if (!$product) {
        //     throw new InvalidRequestException("商品不存在");
        // }
        // 商品还未上架抛出错误
        if (!$product->on_sale) {
            throw new InvalidRequestException("商品未上架");
        }

        return view("products.show", ['product' => $product]);
    }

}
