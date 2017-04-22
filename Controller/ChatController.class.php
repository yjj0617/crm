<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $time = date('Y-m-d H:i:s');
        echo iconv("utf-8","gb2312//IGNORE","User Connected，Passway ID: ({$conn->resourceId})".$time."\n");
        foreach ($this->clients as $client) {
            $client->send('{"type":"review","cmd":"reviewonlineU"}');
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        global $db;
        $numRecv = count($this->clients) - 1;
        $m = json_decode($msg);
        //判断消息类型
        echo('|--Type: '.$m->type."\n");
        if($m->type === 'creatsoc'){
            //创建或者更新通道
            $has = $db->get('chat_passageway','*',['AND'=>[
                    'utype' => $m->utype,
                    'uid' => $m->formUid
                ]]);
            if(!$has){
                $db->insert('chat_passageway',[
                    'utype' => $m->utype,
                    'uid' => $m->formUid,
                    'passageway' => $from->resourceId,
                    'creattime' => date('Y-m-d H:i:s')
                ]);
            }else{
                $db->update('chat_passageway',[
                    'passageway' => $from->resourceId,
                    'creattime' => date('Y-m-d H:i:s')
                ],['AND'=>[
                    'utype' => $m->utype,
                    'uid' => $m->formUid
                ]]);
            }
            echo iconv("utf-8","gb2312//IGNORE","|--User Passway {$m->formUid} is Uptate \n");

        }elseif($m->type === 'sengmsg'){

            echo sprintf(iconv("utf-8","gb2312//IGNORE",'|--User: %d Post Message: "%s" to %d User %s') . "\n"
                 , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
            

            if($m->targetUid > 0){
            //取出目标用户的通道ID--单发
                $tu = $db->get('chat_passageway','*',['AND'=>[
                        'utype' => $m->targetUtype,
                        'uid' => $m->targetUid
                    ]]);
                $tures = $tu['passageway'];
                
                foreach ($this->clients as $client) {
                    if ($from !== $client && $client->resourceId == $tures) {
                        $client->send($msg);
                    }
                }
               
            }else{
                //群发
                foreach ($this->clients as $client) {
                    $client->send($msg);
                }
            }
        }else{
            //其它消息不处理，如心跳等
        }
    }
    
    
    public function onClose(ConnectionInterface $conn) {
        global $db;
        // The connection is closed, remove it, as we can no longer send it messages
        foreach ($this->clients as $client) {
            $client->send('{"type":"review","cmd":"reviewonlineU"}');
        }
        $db->update('chat_passageway',[
                    'passageway' => NULL
                ],['passageway' => $conn->resourceId]);
        $this->clients->detach($conn);
         $time = date('Y-m-d H:i:s');
        echo iconv("utf-8","gb2312//IGNORE","Passway: {$conn->resourceId} Unconnected ".$time."\n");
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        global $db;
        foreach ($this->clients as $client) {
            $client->send('{"type":"review","cmd":"reviewonlineU"}');
        }
        $db->update('chat_passageway',[
                    'passageway' => NULL
                ],['passageway' => $conn->resourceId]);
        echo iconv("utf-8","gb2312//IGNORE","A error at: {$e->getMessage()}\n");
        $conn->close();
    }
}