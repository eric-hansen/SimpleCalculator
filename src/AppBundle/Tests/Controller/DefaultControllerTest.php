<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private static $client;

    public static function setUpBeforeClass()
    {
        self::$client = static::createClient();
    }

    /**
     * @dataProvider calcDataProvider
     */
    public function testAddition($num1, $op, $num2, $expected)
    {
        $result = self::$client->request('GET', '/calc/' . $num1 . '/' . $op . '/' . $num2);

        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
        $this->assertEquals($expected, self::$client->getResponse()->getContent());
    }

    public function calcDataProvider()
    {
        return array(
            array('1', '+', '1', '2'),
            array('1', '-', '1', '0'),
            array('1', 'x', '5', '5'),
            array('10', 'd', '2', '5'),
            array('1', 'f', '1', '')
        );
    }
}
