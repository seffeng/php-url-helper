<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2022 seffeng
 */
namespace Seffeng\UrlHelper\Traits;

use Seffeng\ArrHelper\Arr;

/**
 *
 * @author zxf
 * @date   2020年6月10日
 */
Trait UrlTrait
{
    /**
     * 解析URL
     * @author zxf
     * @date   2022年1月7日
     * @param string $url
     * @param int $component
     * @return string|boolean
     */
    public static function parseUrl(string $url, int $component = -1)
    {
        $parseUrl = parse_url($url, $component);
        if ($parseUrl) {
            $host = Arr::getValue($parseUrl, 'host', '');
            $port = Arr::getValue($parseUrl, 'port', '');
            $user = Arr::getValue($parseUrl, 'user', '');
            $pass = Arr::getValue($parseUrl, 'pass', '');
            $path = Arr::getValue($parseUrl, 'path', '');
            $query = Arr::getValue($parseUrl, 'query', '');
            $fragment = Arr::getValue($parseUrl, 'fragment', '');

            $url = '';
            $user && $url .= $user;
            $pass && $url .= ':' . $pass;
            $user && $url .= '@';
            $url .= $host;
            $port && $url .= ':' . $port;
            $path && $url .= $path;

            if ($query) {
                $queryArr = [];
                parse_str($query, $queryArr);
                ksort($queryArr);
                $url .= '?';
                $i = 0;
                foreach ($queryArr as $k => $q) {
                    $url .= ($i > 0 ? '&' : '') . $k . '=' . $q;
                    $i++;
                }
            }

            $fragment && $url .= '#' . $fragment;
            $parseUrl['url'] = $url;
            return $parseUrl;
        }
        return false;
    }

    /**
     * 客户端IP
     *
     * @author zxf
     * @date   2024-07-22
     * @return string
     */
    public static function getUserIp()
    {
        $ip = '0.0.0.0';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } elseif ($ip = getenv('HTTP_X_FORWARDED_FOR')) {
        } elseif ($ip = getenv('HTTP_CLIENT_IP')) {
        } elseif ($ip = getenv('REMOTE_ADDR')) {
        }
        return $ip;
    }
}
