<?php
/**
 * User: woodylan
 * Date: 2020/3/15
 * Time: 10:02
 */

namespace Woodylan\Websocket;

class WsServer
{
    use Request;

    const API_URL_SEND_TO_REGISTER = '/api/register'; //注册系统
    const API_URL_SEND_TO_CLIENT = '/api/send_to_client'; //发送给指定clientId
    const API_URL_SEND_TO_CLIENTS = '/api/send_to_clients'; //发送给指定clientIds
    const API_URL_BIND_TO_GROUP = '/api/bind_to_group'; //绑定clientId到指定分组
    const API_URL_SEND_TO_GROUP = '/api/send_to_group'; //发送给指定分组
    const API_URL_GET_ONLINE_LIST = '/api/get_online_list'; //获取在线客户端列表
    const API_URL_CLOSE_CLIENT = '/api/close_client'; //主动关闭连接

    /**
     * WsServer constructor.
     *
     * @param string $host 域名
     * @param string $port 端口号
     */
    public function __construct(string $host, string $port)
    {
        $this->_host = $host;
        $this->_port = $port;
    }

    /**
     * 注册系统
     *
     * @param string $systemId 系统ID
     * @return array|mixed
     */
    public function register(string $systemId)
    {
        return $this->_request(self::API_URL_SEND_TO_REGISTER, $this->_buildParam(
            [
                'systemId' => $systemId,
            ]
        ), '', true);
    }

    /**
     * 发送给指定clientId
     *
     * @param string       $systemId   系统ID
     * @param string       $clientId   连接ID
     * @param string       $sendUserId 发送者用户ID
     * @param int          $code       自定义code
     * @param string       $msg        自定义message
     * @param string|array $data       自定义返回内容
     * @return array|mixed
     */
    public function sendToClientId(string $systemId, string $clientId, string $sendUserId, int $code, string $msg, $data)
    {
        return $this->_request(self::API_URL_SEND_TO_CLIENT, $this->_buildParam(
            [
                'clientId'   => $clientId,
                'sendUserId' => $sendUserId,
                'code'       => $code,
                'msg'        => $msg,
                'data'       => is_string($data) ? $data : json_encode($data),
            ]
        ), $systemId, true);
    }

    /**
     * 发送给指定clientIds
     *
     * @param string       $systemId   系统ID
     * @param array        $clientIds  连接ID列表
     * @param string       $sendUserId 发送者用户ID
     * @param int          $code       自定义code
     * @param string       $msg        自定义message
     * @param string|array $data       自定义返回内容
     * @return array|mixed
     */
    public function sendToClientIds(string $systemId, array $clientIds, string $sendUserId, int $code, string $msg, $data)
    {
        return $this->_request(self::API_URL_SEND_TO_CLIENTS, $this->_buildParam(
            [
                'clientIds'  => $clientIds,
                'sendUserId' => $sendUserId,
                'code'       => $code,
                'msg'        => $msg,
                'data'       => is_string($data) ? $data : json_encode($data),
            ]
        ), $systemId, true);
    }

    /**
     * 绑定clientId到分组
     *
     * @param string $systemId  系统ID
     * @param string $groupName 分组名称
     * @param string $clientId  连接ID
     * @param string $userId    业务系统的用户ID
     * @param string $extend    业务系统的扩展字段
     * @return array|mixed
     */
    public function bindToGroup(string $systemId, string $groupName, string $clientId, string $userId = '', string $extend = '')
    {
        return $this->_request(self::API_URL_BIND_TO_GROUP, $this->_buildParam(
            [
                'groupName' => $groupName,
                'clientId'  => $clientId,
                'userId'    => $userId,
                'extend'    => $extend,
            ]
        ), $systemId, true);
    }

    /**
     * 发送消息给指定分组
     *
     * @param string       $systemId   系统ID
     * @param string       $groupName  分组名称
     * @param string       $sendUserId 发送者用户ID
     * @param int          $code       自定义code
     * @param string       $msg        自定义message
     * @param string|array $data       自定义返回内容
     * @return array|mixed
     */
    public function sendToGroup(string $systemId, string $groupName, string $sendUserId, int $code, string $msg, $data)
    {
        return $this->_request(self::API_URL_SEND_TO_GROUP, $this->_buildParam(
            [
                'groupName'  => $groupName,
                'sendUserId' => $sendUserId,
                'code'       => $code,
                'msg'        => $msg,
                'data'       => is_string($data) ? $data : json_encode($data),
            ]
        ), $systemId, true);
    }

    /**
     * 获取在线客户端列表
     *
     * @param string $systemId  系统ID
     * @param string $groupName 分组名称
     * @return array|mixed
     */
    public function getOnlineList(string $systemId, string $groupName = '')
    {
        return $this->_request(self::API_URL_GET_ONLINE_LIST, $this->_buildParam(
            [
                'groupName' => $groupName,
            ]
        ), $systemId, true);
    }

    /**
     * 主动关闭连接
     *
     * @param string $systemId 系统ID
     * @param string $clientId 连接ID
     * @return array|mixed
     */
    public function closeClient(string $systemId, string $clientId)
    {
        return $this->_request(self::API_URL_CLOSE_CLIENT, $this->_buildParam(
            [
                'clientId' => $clientId,
            ]
        ), $systemId, true);
    }
}