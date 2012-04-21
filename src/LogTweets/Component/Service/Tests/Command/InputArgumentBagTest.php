<?php
namespace LogTweets\Component\Tests\Service\Command;

use PHPUnit_Framework_TestCase as TestCase;
use LogTweets\Component\Service\Command\InputArgumentBag;
use stdClass;

class InputArgumentTest extends TestCase
{
    private $argument;

    public function setUp()
    {
        $this->argument = new InputArgumentBag();
    }

    public function testSettingAndGettingInputArgument()
    {
        $object = new stdClass();
        $this->argument->set('test', $object);
        $this->assertSame($object, $this->argument->get('test'));
    }

    public function testGetThrowsExceptionIfKeyNotFound()
    {
        $this->setExpectedException('InvalidArgumentException', 'Input argument "test" does not exist');
        $this->argument->get('test');
    }

    public function testGetThrowsExceptionIfUnexpectedType()
    {
        $this->argument->set('test', new stdClass());
        $this->setExpectedException('InvalidArgumentException', 'Input argument "test" is not of type "SomeClass"');
        $this->argument->get('test', 'SomeClass');
    }

    public function testSettingAndRetrievingPrimitiveType()
    {
        $value = 'HELLO WORLD';
        $this->assertNull($this->argument->set('test', $value));
        $this->assertSame($value, $this->argument->get('test'));
    }

    public function testRetrievingInvalidPrimitiveType()
    {
        $value = 'HELLO WORLD';
        $this->assertNull($this->argument->set('test', $value));
        $this->assertSame($value, $this->argument->get('test', 'string'));
    }

    public function testSettingAlreadyPresentArgumentIsNotAllowed()
    {
        $this->argument->set('test', new stdClass());

        $this->setExpectedException('InvalidArgumentException', 'Input argument "test" is already set');
        $this->argument->set('test', new stdClass());
    }
}
