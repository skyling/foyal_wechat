<?php
/**
 * 请求客户端
 * Author: fren <frenlee@163.com>
 * Sence: 2015/10/2 21:28
 */

class Http {

    private $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Reserved for WebDAV advanced collections expired proposal',
        426 => 'Upgrade required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    );

    /**
     * GET请求
     * @param $url
     * @param array $headers
     * @return mixed
     */
    public function get($url, array $headers = array()){
        $request = array(
            'method' => 'GET',
            'url' => $url,
            'headers' => $headers,
            'body' => NULL,
        );
        return $this->send_request($request);
    }

    /**
     * POST请求
     * @param $url
     * @param $body
     * @param array $headers
     * @return mixed
     */
    public function post($url, $body, array $headers = array()){
        $request = array(
            'method' => 'POST',
            'url' => $url,
            'headers' => $headers,
            'body' => $body,
        );
        return $this->send_request($request);
    }

    /**
     * 用户表示
     */
    private function _user_agent()
    {
        $system_info = php_uname('s');
        $machine_info = php_uname('m');

        $env_info = "($system_info/$machine_info)";

        $php_ver = phpversion();
        $ua = "$env_info PHP/$php_ver";
        return $ua;
    }

    /**
     * 发送请求
     */
    private function send_request($request)
    {
        $t1 = microtime(true);
        $ch = curl_init();
        $options = array(
            CURLOPT_USERAGENT => $this->_user_agent(),
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_HEADER => TRUE,
            CURLOPT_NOBODY => FALSE,
            CURLOPT_CUSTOMREQUEST => $request['method'],
            CURLOPT_URL => $request['url']
        );

        if ( !empty($request['headers']) ) {
            $headers = array();
            foreach ( $request['headers'] as $key => $val ) {
                array_push( $headers, "$key:$val");
            }
            $options[CURLOPT_HTTPHEADER] = $headers;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        if( !empty($request['body']) ) {
            $options[CURLOPT_POSTFIELDS] = $request['body'];
        }
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $t2 = microtime(TRUE);
        $duration = round($t2-$t1, 3);
        $ret = curl_errno($ch);
        if($ret !== 0){
            $r = array(
                'statusCode' => $ret,
                'duration' => $duration,
                'headers' => array(),
                'body' => NULL,
                'error' => isset($this->statusTexts[$ret]) ? $this->statusTexts[$ret] : 'ERROR',
            );
            curl_close($ch);
            return $r;
        }

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = $this->parse_headers($result, 0, $header_size);
        $body = substr($result, $header_size);
        $r = array(
            'statusCode' => $code,
            'duration' => $duration,
            'headers' => $headers,
            'body' => $body,
            'error' => NULL,
        );
        curl_close($ch);
        return $r;
    }

    private function parse_headers($raw)
    {
        $headers = array();
        $header_lines = explode('\r\n', $raw);
        foreach($header_lines as $line){
            $header_line = trim($line);
            $kv = explode(':', $header_line);
            if(count($kv) > 1){
                $headers[$kv[0]] = trim($kv[1]);
            }
        }
        return $headers;
    }


}