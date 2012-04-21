<?php
namespace LogTweets\Component\Service\Command;

use InvalidArgumentException;

class InputArgumentBag
{
    private $arguments = array();

    public function set($name, $object)
    {
        if (array_key_exists($name, $this->arguments)) {
            throw new InvalidArgumentException(sprintf('Input argument "%s" is already set', $name));
        }

        $this->arguments[$name] = $object;
    }

    public function get($name, $type = null)
    {
        if (!array_key_exists($name, $this->arguments)) {
            throw new InvalidArgumentException(sprintf('Input argument "%s" does not exist', $name));
        }

        if (!$this->isOfType($name, $type)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Input argument "%s" is not of type "%s" but of type "%s"',
                    $name,
                    $type,
                    $this->getType($this->arguments[$name])
                )
            );
        }

        return $this->arguments[$name];
    }

    private function isOfType($name, $type = null)
    {
        if ($type === null) {
            return true;
        }

        if (is_object($this->arguments[$name])) {
            return $this->arguments[$name] instanceof $type;
        }

        return gettype($this->arguments[$name]) === $type;
    }

    private function getType($value)
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }
}