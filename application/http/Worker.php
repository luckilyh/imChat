<?php
namespace app\http;

use \GatewayWorker\Lib\Gateway;
use think\facade\Cache;

class Worker
{
    // 当有客户端连接时，将client_id返回，让mvc框架判断当前uid并执行绑定
    public static function onWebSocketConnect($client_id,$data)
    {
        $token = $data['get']['token'];
        $key = config('chat.key');
        $id = decrypt($token,$key);
        Gateway::bindUid($client_id,$id);
    }

    // GatewayWorker建议不做任何业务逻辑，onMessage留空即可
    public static function onMessage($client_id, $data)
    {
        $redis = Cache::store('redis')->handler();
        $data = json_decode($data,true);
        $time = time()*1000;
        $form_id = $data['data']['mine']['id'];
        $to_id = $data['data']['to']['id'];
        $info = [];
        $info['username'] = $data['data']['mine']['username'];
        $info['avatar'] = $data['data']['mine']['avatar'];
        $info['id'] = $form_id;
        $info['type'] = $data['data']['to']['type'];
        $info['mine'] = false;
        $info['fromid'] = $data['data']['mine']['id'];
        $info['timestamp'] = $time;

        //存聊天记录入redis
        $arr = [$form_id,$to_id];
        sort($arr);
        $record = $data['data']['mine'];
        unset($record['mine']);
        $record['timestamp'] = $time;

        $redis->rPush("chat:{$arr[0]}:{$arr[1]}", json_encode($record));

        if ($data['type'] == 'textMessage'){
            $info['content'] = $data['data']['mine']['content'];
        }
        Gateway::sendToUid($to_id, json_encode($info));
    }
    
}