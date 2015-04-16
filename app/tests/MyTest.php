<?php
/**
 * Created by PhpStorm.
 * User: jiahu
 * Date: 2015/4/15
 * Time: 18:58
 */

class MyTest extends TestCase {

    public function testIndex()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
        $this->assertViewHas('articles');
        $this->assertViewHas('tags');
    }

    public function testNotFound()
    {
        $this->call('GET', 'test');
        $this->assertResponseStatus(404);
    }
}