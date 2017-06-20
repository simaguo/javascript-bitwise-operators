<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/20
 * Time: 19:01
 */
use PHPUnit\Framework\TestCase;
use Simaguo\JavascriptBitwiseOperators\Tool;

class ShiftLeftOperatorTest extends TestCase
{
    private function v8ShiftLeftOperator($a,$b)
    {
        $v8 = new V8Js();
        $js = "$a << $b";
        return $v8->executeString($js);
    }

    public function testPositiveNumber()
    {
        for ($j = 0; $j <= 22; $j++) {
            $start = (pow(2, 31) - 1) * pow(2, $j) - 10;
            $end = (pow(2, 31) - 1) * pow(2, $j) + 10;
            for ($i = $start; $i <= $end; $i++) {
                $v = mt_rand(-1-pow(2,31),pow(2,31));
                //$v = mt_rand(0,pow(2,31));
                $a = Tool::shiftLeftOperator($i,$v);
                $b = $this->v8ShiftLeftOperator($i,$v);
                $this->assertEquals($a, $b, $j . ':' . $i . ':' . $v);
            }
        }

    }

    public function testNegativeNumber()
    {
        for ($j = 0; $j <= 22; $j++) {
            $start = (pow(2, 31) - 1) * pow(2, $j) - 10;
            $end = (pow(2, 31) - 1) * pow(2, $j) + 10;
            for ($i = -$start; $i >= -$end; $i--) {
                $v = mt_rand(-1-pow(2,31),pow(2,31));
                //$v = mt_rand(0,pow(2,31));
                $a = Tool::shiftLeftOperator($i,$v);
                $b = $this->v8ShiftLeftOperator($i,$v);
                $this->assertEquals($a, $b, $j . ':' . $i . ':' . $v);
            }
        }
    }

    public function testException()
    {
        $v = 1023;
        $this->assertEquals(Tool::shiftLeftOperator(pow(2, 53),$v), $this->v8ShiftLeftOperator(pow(2, 53),$v));
        $this->assertEquals(Tool::shiftLeftOperator(-pow(2, 53),$v), $this->v8ShiftLeftOperator(-pow(2, 53),$v));

        $this->expectException(RangeException::class);
        Tool::shiftLeftOperator(pow(2, 53) + 1,$v);
        Tool::shiftLeftOperator(-pow(2, 53) - 1,$v);
    }
}