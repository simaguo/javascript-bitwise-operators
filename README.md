In the 64-bit operating system, php to achieve javascript bitwise operation.

Installation
------------

    composer require simaguo/javascript-bitwise-operators

Usage
-----

    <?php
        use Simaguo\JavascriptBitwiseOperators\Tool;
        
        $a=1024;
        $b=2;
        Tool::andOperator($a, $b);//$a & $b
        Tool::notOperator($a);//~$a
        Tool::orOperator($a, $b);//$a | $b
        Tool::shiftLeftOperator($a, $b);//$a << $b
        Tool::shiftRightOperator($a, $b);//$a >> $b
        Tool::unSignedShiftRightOperator($a,$b);//$a >>> $b
        Tool::xorOperator($a,$b);//$a ^ $b