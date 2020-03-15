# go-websocket 项目的PHP版SDK
go-websocket 项目地址：<https://github.com/woodylan/go-websocket>

## 安装

Composer

```shell
composer require woodylan/go-websocket-php-sdk
```



## 使用

```php
// 导入类
use Woodylan\Websocket\WsServer;
// 实例化
$wsServer = new WsServer('https://ws.example.com', '660');
// 例子 注册系统
$wsServer->register('xxxxx');
```



## 接口列表

1. 注册系统

   ```php
   $wsServer->register($systemId);
   ```

2. 发送给指定clientId

   ```php
   $wsServer->sendToClientId($systemId, $clientId, $sendUserId, $code, $msg, $data);
   ```

3. 发送给指定clientIds

   ```php
   $wsServer->sendToClientIds($systemId, $clientIds, $sendUserId, $code, $msg, $data);
   ```

4. 绑定clientId到分组

   ```php
   $wsServer->bindToGroup($systemId, $groupName, $clientId, $userId = '');
   ```

5. 发送消息给指定分组

   ```php
   $wsServer->sendToGroup($systemId, $groupName, $sendUserId, $code, $msg, $data);
   ```

6. 获取在线客户端列表

   ```php
   $wsServer->getOnlineList($systemId, $groupName = '');
   ```

