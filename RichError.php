<?php

/**
 * Created by PhpStorm.
 * User: karboom
 * Date: 16-3-27
 * Time: 上午11:34
 */
namespace Karboom;

class RichError
{
    public $map;
    public $prefix;

    public function __construct($file = __DIR__ . '/default.yaml', $prefix = null) {
        $this->map = \Spyc::YAMLLoad($file);
        $this->prefix = $prefix;
    }

    public function err ($code) {
        if (!empty($this->map[$code])) {
            $description = $this->map[$code];
        } else {
            $description = '未知错误';
        }

        $status = $code/100;

        if (!empty($this->prefix)) {
            $code = $this->prefix . '-' . $code;
        }

        $body = array(
            'code' => $code,
            'description' => $description
        );

        http_response_code($status);
        http_response_code();
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode($body);
        exit;
    }
}