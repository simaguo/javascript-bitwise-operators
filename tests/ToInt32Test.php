<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/17
 * Time: 10:25
 */
use PHPUnit\Framework\TestCase;
use Simaguo\JavascriptBitwiseOperators\Tool;

class ToInt32Test extends TestCase
{
    private function v8ToInt32($b)
    {
        $v8 = new V8Js();
        $js = "$b >> 0";
        return $v8->executeString($js);
    }

    public function testPositiveNumber()
    {
        for ($j = 0; $j <= 22; $j++) {
            $start = (pow(2, 31) - 1) * pow(2, $j) - 10;
            $end = (pow(2, 31) - 1) * pow(2, $j) + 10;
            for ($i = $start; $i <= $end; $i++) {
                $a = Tool::toInt32($i);
                $b = $this->v8ToInt32($i);
                $this->assertEquals($a, $b, $j . ':' . $i . ':' . $start);
            }
        }

    }

    public function testNegativeNumber()
    {
        for ($j = 0; $j <= 22; $j++) {
            $start = (pow(2, 31) - 1) * pow(2, $j) - 10;
            $end = (pow(2, 31) - 1) * pow(2, $j) + 10;
            for ($i = -$start; $i >= -$end; $i--) {
                $a = Tool::toInt32($i);
                $b = $this->v8ToInt32($i);
                $this->assertEquals($a, $b, $j . ':' . $i . ':' . $start);
            }
        }
    }

    public function testException()
    {
        $this->assertEquals(Tool::toInt32(pow(2, 53)), $this->v8ToInt32(pow(2, 53)));
        $this->assertEquals(Tool::toInt32(-pow(2, 53)), $this->v8ToInt32(-pow(2, 53)));

        $this->expectException(RangeException::class);
        Tool::toInt32(pow(2, 53) + 1);
        Tool::toInt32(-pow(2, 53) - 1);
    }
}