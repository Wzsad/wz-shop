<?php
/**
 * 将处理所有来自自定义页面的逻辑
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	/**
	 * @Author    WangZe
	 * @DateTime  2019-03-30
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]      展示首页页面
	 */
    public function root()
    {
    	return view('pages.root');
    }
}
