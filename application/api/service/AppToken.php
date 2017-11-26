<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/24 0024
 * Time: 下午 8:19
 */

namespace app\api\service;


use app\api\model\ThirdApp;
use app\exception\TokenException;

class AppToken extends BaseToken
{
    //第三方app登录检测并且缓存token
    public function getThirdAppTokenService($ac, $se)
    {
        $app = ThirdApp::check($ac, $se);
        if(!$app)
        {
            throw new TokenException([
                'msg' => '授权失败',
                'errorCode' => 10004
            ]);
        }
        else{
            $scope = $app->scope;
            $uid = $app->id;
            $values = [
                'scope' => $scope,
                'uid' => $uid
            ];
            $token = $this->saveToCache($values);
            return $token;
//            return '查询通过';
        }
    }

    //第三方app登录缓存token
    private function saveToCache($values){
        $token = self::prepare_Token_Key();
        $expire_in = config('wx_config.token_expire');
        $result = cache($token, json_encode($values), $expire_in);
        if(!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常,来自AppToken -- saveToCache',
                'errorCode' => 10005
            ]);
        }
        return $token;
    }
}