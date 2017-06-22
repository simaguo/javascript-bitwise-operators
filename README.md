64位OS下，php实现JS的位操作。

安装
----

    composer require simaguo/javascript-bitwise-operators

使用
----

    use Simaguo\JavascriptBitwiseOperators\Tool;
    $a=1024;
    $b=2;
    Tool::andOperator($a, $b);//$a & $b
    Tool::notOperator($a);//~$a
    Tool::orOperator($a, $b);//$a | $b
    Tool::shiftLeftOperator($a, $b);//$a << $b
    Tool::shiftRightOperator($a, $b);//$a >> $b
    Tool::unSignedShiftRightOperator($a,$b);//$a >>> $b
    Tool::XorOperator($a,$b);////$a ^ $b