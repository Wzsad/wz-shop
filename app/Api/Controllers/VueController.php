<?php

/**
 *
 * User: wz
 * Date: 2020/8/3
 */

namespace App\Api\Controllers;


use Illuminate\Http\Request;

class VueController extends BaseController
{
    protected $token;
    protected $user;

    public function __construct()
    {
        $this->token = [
            'admin'  => ['token' => 'admin-token'],
            'editor' => ['token' => 'editor-token'],
        ];
        $this->user  = [
            'admin-token'  => [
                'roles'        => ['admin'],
                'introduction' => 'I am a super administrator',
                'avatar'       => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'name'         => 'Super Admin',
            ],
            'editor-token' => [
                'roles'        => ['editor'],
                'introduction' => 'I am an editor',
                'avatar'       => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'name'         => 'Normal Editor',
            ],
        ];
    }

    /**
     * @SWG\Post(
     *     path="/api/vue-element-admin/user/login",
     *     description="Vue 登陆",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Vue-api"},
     *     security={
     *     {"passport": {}},
     *     },
     *     summary="Login",
     *     @SWG\Parameter(
     *         in="query",
     *         name="username",
     *         type="string",
     *         description="用户名",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="query",
     *         name="password",
     *         type="string",
     *         description="密码",
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
    public function login(Request $request)
    {
        $password = $request['password'];
        $username = $request['username'];
        $token = $this->token['admin'];
        if ($username && $this->token[$username]) {
            $token = $this->token[$username];
        }
        return [
            'code' => 20000,
            'data' => $token,
        ];
    }
}
