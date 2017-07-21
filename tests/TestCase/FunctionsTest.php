<?php

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    protected function setUp()
    {
        putenv('hoge_value=hoge');

        putenv('true_value=true');
        putenv('false_value=false');

        putenv('0_value=0');
        putenv('1_value=1');
        putenv('2_value=2');
        putenv('3_value=3');

        putenv('array_value=hoge,fuga,foo');
        putenv('array_space_value=hoge, fuga, foo');
    }

    public function testenvb()
    {
        $this->assertTrue(envb('true_value'));
        $this->assertFalse(envb('false_value'));

        $this->assertNull(envb('dummy_value'));
        $this->assertNull(envb('hoge_value'));
        $this->assertNull(envb('0_value'));
        $this->assertNull(envb('1_value'));
    }

    public function testenva()
    {
        $this->assertEquals(enva('array_value'), ['hoge', 'fuga', 'foo']);
        $this->assertEquals(enva('array_space_value'), ['hoge', 'fuga', 'foo']);

        $this->assertNull(envb('dummy_value'));
        $this->assertEquals(enva('hoge_value'), ['hoge']);
        $this->assertEquals(enva('1_value'), ['1']);
    }

    public function testenvbWithDefaultValue()
    {
        $this->assertEquals(envb('dummy_value', 'phpdotenv'), 'phpdotenv');

        $this->assertTrue(envb('true_value', 'phpdotenv'));
        $this->assertFalse(envb('false_value', 'phpdotenv'));

        $this->assertEquals(envb('hoge_value', 'phpdotenv'), 'phpdotenv');
        $this->assertEquals(envb('0_value', 'phpdotenv'), 'phpdotenv');
        $this->assertEquals(envb('1_value', 'phpdotenv'), 'phpdotenv');
    }

    public function testenvaWithDefaultValue()
    {
        $this->assertEquals(envb('dummy_value', 'phpdotenv'), 'phpdotenv');

        $this->assertEquals(enva('array_value', ['phpdotenv']), ['hoge', 'fuga', 'foo']);
        $this->assertEquals(enva('array_value', 'phpdotenv'), ['hoge', 'fuga', 'foo']);

        $this->assertEquals(enva('hoge_value', 'fuga'), ['hoge']);
    }
}
