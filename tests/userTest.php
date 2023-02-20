<?php

include(dirname(__FILE__)."/../app/user.php");

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetChildrenCountWithNoChildren()
    {
        $user = new User(1, "Alice");
        $this->assertSame(0, $user->getChildrenCount());
    }

    public function testGetChildrenCountWithOneChild()
    {
        $alice = new User(1, "Alice");
        $bob = new User(2, "Bob", $alice);
        $this->assertSame(1, $alice->getChildrenCount());
    }

    public function testGetChildrenCountWithGrandChildren()
    {
        $alice = new User(1, "Alice");
        $bob = new User(2, "Bob", $alice);
        $carol = new User(3, "Carol", $bob);
        $dave = new User(4, "Dave", $bob);
        $this->assertSame(3, $alice->getChildrenCount());
    }

    public function testGetLevelWithNoParent()
    {
        $alice = new User(1, "Alice");
        $this->assertSame(0, $alice->getLevel());
    }

    public function testGetLevelWithOneParent()
    {
        $alice = new User(1, "Alice");
        $bob = new User(2, "Bob", $alice);
        $this->assertSame(1, $bob->getLevel());
    }

    public function testPrintTree()
    {
        $alice = new User(1, "Alice");
        $bob = new User(2, "Bob", $alice);
        $carol = new User(3, "Carol", $bob);
        $dave = new User(4, "Dave", $bob);

        ob_start();
        $alice->printTree();
        $output = ob_get_contents();
        ob_end_clean();

        $expected = "|_Alice<br>|__ __Bob<br>|__ ___ __Dave<br>|__ ___ __Carol<br>";
        $this->assertSame($expected, $output);
    }
}

