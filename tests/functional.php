<?php
require('src/jimmy18dev/NativeDatetime/NativeDatetime.php');

use PHPUnit\Framework\TestCase;
use jimmy18dev\NativeDatetime\NativeDatetime;

class StackTest extends TestCase{

    public function testHi(){
        $this->assertSame('This NativeDatetime class', NativeDatetime::hi());
    }
    public function testShortdate(){
        $this->assertSame('18 ก.ย. 2561', NativeDatetime::dformat('2018-09-18'));
    }
}