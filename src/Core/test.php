<?php

class A {
    public $name = "Fitwings";

    function test() {
        var_dump($this);
    }
}

$a = new A();
$a->test();