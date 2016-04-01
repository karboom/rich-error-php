<?php

/**
 * Created by PhpStorm.
 * User: karboom
 * Date: 16-3-27
 * Time: 下午4:28
 */


namespace Karboom;
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class RichErrorTest extends \PHPUnit_Framework_TestCase
{
    /**@var $re RichError**/
    public $re;

    public function setUp()
    {
        $this->re = new RichError();
    }


    /**
     * @runInSeparateProcess
     */
    public function testOutput()
    {
        $this->re->err(40301);

        $json = ['code'=>40301, 'description'=>'用户名错误'];
        $this->expectOutputString(json_encode($json));
        $this->assertEquals(403, http_response_code());
    }
}
