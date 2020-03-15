<?php
/**
 * User: woodylan
 * Date: 2020/3/15
 * Time: 10:02
 */

namespace Woodylan\Websocket;


trait Request
{
    private $_host; // 域名
    private $_port; // 端口号

    protected function _request(string $uri, string $data, string $systemId, $post = false)
    {
        if ($post) {
            $url = $this->_host . ':' . $this->_port . $uri;
            $retData = $this->_httpPost($url, $data, $systemId);
        } else {
            if (is_array($data)) {
                $data = http_build_query($data);
            }
            $url = $this->_host . ':' . $this->_port . $uri . '?' . $data;
            $retData = $this->_httpGet($url);
        }

        if ($retData) {
            return json_decode($retData, true);
        } else {
            return [];
        }
    }

    protected function _buildParam()
    {
        $varArray = func_get_args();
        return json_encode($varArray[0] ?? []);
    }

    private function _httpGet($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $output = curl_exec($ch);
        return $output;
    }

    private function _httpPost(string $url, $data, string $systemId)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "SystemId: {$systemId}"
        ]);

        $output = curl_exec($ch);
        return $output;
    }
}