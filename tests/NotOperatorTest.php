<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/20
 * Time: 17:21
 */
use PHPUnit\Framework\TestCase;
use Simaguo\JavascriptBitwiseOperators\Tool;

class NotOperatorTest extends TestCase
{
    private function v8NotOperator($b)
    {
        $v8 = new V8Js();
        $js = "~$b";
        return $v8->executeString($js);
    }

    public function testPositiveNumber()
    {
        for ($j = 0; $j <= 22; $j++) {
            $start = (pow(2, 31) - 1) * pow(2, $j) - 10;
            $end = (pow(2, 31) - 1) * pow(2, $j) + 10;
            for ($i = $start; $i <= $end; $i++) {
                $a = Tool::notOperator($i);
                $b = $this->v8NotOperator($i);
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
                $a = Tool::notOperator($i);
                $b = $this->v8NotOperator($i);
                $this->assertEquals($a, $b, $j . ':' . $i . ':' . $start);
            }
        }
    }

    public function testException()
    {
        $this->assertEquals(Tool::notOperator(pow(2, 53)), $this->v8NotOperator(pow(2, 53)));
        $this->assertEquals(Tool::notOperator(-pow(2, 53)), $this->v8NotOperator(-pow(2, 53)));

        if (!Tool::hasV8js()) {
            $this->expectException(RangeException::class);
        }
        Tool::notOperator(pow(2, 53) + 1);
        Tool::notOperator(-pow(2, 53) - 1);
    }
}