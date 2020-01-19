<?php
/*
 * @Description:
 * @Version: 2.0
 * @Autor: Wz
 * @Date: 2019-04-26 09:12:46
 * @LastEditors  : Wz
 * @LastEditTime : 2020-01-19 15:29:36
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InvalidRequestException extends Exception
{
    public function __construct(string $message = '', int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            // json() 方法第二个参数就是 Http 返回码
            return response()->json(['msg' => $this->message], $this->code);
        }
        return view('pages.error', ['msg' => $this->message]);
    }
}
