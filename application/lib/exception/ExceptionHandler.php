<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 下午10:18
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    //HTTP状态码
    private $code = 400;

    // 错误具体信息
    private $msg = 'error param';

    //自定义错误码
    private $errorCode = 10000;

    public function render(Exception $e)
    {

        if($e instanceof BaseException) {
            //自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            if(config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = 'Internal server error';
                $this->errorCode = 999;
                $this->record($e);
            }
        }

        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function record(Exception $e)
    {
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}