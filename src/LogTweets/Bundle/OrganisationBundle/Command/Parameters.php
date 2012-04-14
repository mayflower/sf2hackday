<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

use UnderflowException;
use OverflowException;
use InvalidArgumentException;

class Parameters implements ParametersInterface
{
    private $parameters = array();

    public function get($name, $type = null)
    {
        static::verifyExistance($name);
        static::verifyType($this->parameters[$name], $type);

        return $this->parameters[$name];
    }

    public function set($name, $value, $type = null)
    {
        static::verifyType($value, $type);

        if (isset($this->parameters[$name])) {
            throw new UnderflowException(sprintf('Offset "%s" already defined', $offset));
        }

        $this->parameters[$name] = $value;
    }

    public function delete($name, $type = null)
    {
        static::verifyExistance($name);
        static::verifyType($value, $type);

        unset($this->parameters[$name]);
    }

    private static function verifyType($value, $type)
    {
        if ($type !== null && !$value instanceof $type) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expected "%s" to be of type "%s" but is of type "%s"',
                    $name,
                    $type,
                    get_class($value)
                )
            );
        }
    }

    private static function verifyExistance($name)
    {
        if (!isset($this->parameters[$name])) {
            throw new UnderflowException(sprintf('Undefined offset "%s"', $name));
        }
    }
}