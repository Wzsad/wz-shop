<?php

namespace App\Api\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use ReflectionClass;

class TestController extends BaseController
{
    /**
     * @SWG\Get(
     *     path="/api/test",
     *     description="返回测试内容",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"秘钥生成"},
     *     security={
     *     {"passport": {}},
     *     },
     *     summary="Get user",
     *     @SWG\Parameter(
     *         in="query",
     *         name="reason",
     *         type="string",
     *         description="拿数据的理由",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index(Request $request)
    {
        // $url  = 'https://free-ss.site/';
        // $opts = array('http'=>array('header'=>"User-Agent:MyAgent/1.0\r\n"));
        // $context = stream_context_create($opts);
        // $str = file_get_contents($url, false, $context);
        // dd($str);
        // die;
        $result['time']  = time();
        $result['value'] = md5($request['action'] . $request['userid'] . $request['apiPassword'] . time());
        return $this->response->array($result);
    }
    /**
     * oem访问秘钥
     * @Author   Wz
     * @DateTime 2019-11-02T15:09:26+0800
     * @param    Request                  $request [description]
     * @return   [type]                            [description]
     */
    public function indexkey(Request $request)
    {
        $result['time'] = time();
        $str            = $request['module'] . 'zkeys.api@2019' . $request['action'] . $request['userid'] . $request['apiPassword'] . time();
        $result['sign'] = md5($str);
        return $this->response->array($result);
    }
    /**
     * @Author    WangZe
     * @DateTime  2019-03-26
     * @copyright 获取当前IP地址
     * @license   [license]
     * @version   [version]
     * @return    [type]      [description]
     * @SWG\Get(
     *     path="/api/ip",
     *     description="返回ip范围",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"IP范围"},
     *     summary="IP",
     *     @SWG\Parameter(
     *         in="query",
     *         name="ip1",
     *         type="string",
     *         description="第一个IP地址",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="query",
     *         name="ip2",
     *         type="string",
     *         description="第二个IP地址",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function ip(Request $request)
    {
        $ip1 = $request->input('ip1');
        $ip2 = $request->input('ip2');

        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip    = sprintf('%u', ip2long($ip));
        $begin = sprintf('%u', ip2long('111.111.111.111'));
        $end   = sprintf('%u', ip2long('222.222.222.222'));
        if ($ip >= $begin && $ip <= $end) {
            echo '在区间范围内';
        } else {
            echo '不在区间范围';
        }
    }
    /**
     * @Author    WangZe
     * @DateTime  2019-03-26
     * @copyright 找出数组中不重复的值[1,2,3,3,2,1,5]
     * @license   [license]
     * @version   [version]
     * @param     string      $value [description]
     * @return    [type]             [description]
     * @SWG\Post(
     *     path="/api/norepeat",
     *     description="去数组中不重复的数",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"数组"},
     *     summary="Array",
     *     @SWG\Parameter(
     *         in="body",
     *         name="data",
     *         description="数组",
     *         required=true,
     *         @SWG\Schema(ref="#")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     )
     * )
     */
    public function norepeat(Request $request)
    {
        $arr = $request->input('data');
        if (is_array($arr) && !empty($arr)) {
            $data = [];
            foreach ($arr as $k => $v) {
                if (isset($data[$v])) {
                    $data[$v]++;
                } else {
                    $data[$v] = 1;
                }
            }
            $result = [];
            foreach ($data as $key => $value) {
                if ($value != 1) {
                    unset($data[$key]);
                } else {
                    $result[] = $key;
                }
            }
            echo (json_encode($result));
        } else {
            return false;
        }
    }

    /**
     *
     *
     * @SWG\GET(
     *     path="/api/json",
     *     description="测试使用的接口",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"返回数据"},
     *     summary="Array",
     *     @SWG\Parameter(
     *         in="body",
     *         name="data",
     *         description="数组",
     *         required=true,
     *         @SWG\Schema(ref="#")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="返回成功"
     *     )
     * )
     */
    public function apitest(Request $request)
    {
        $reflection = new ReflectionClass('StripeBiller');
    }
}
