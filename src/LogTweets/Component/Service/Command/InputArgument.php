<?php
namespace LogTweets\Component\Service\Command;

use InvalidArgumentException;

class InputArgument
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

        if ($type !== null && !$this->arguments[$name] instanceof $type) {
            throw new InvalidArgumentException(
                sprintf(
                    'Input argument "%s" is not of type "%s" but of type "%s"',
                    $name,
                    $type,
                    get_class($this->arguments[$name])

                )
            );
        }

        return $this->arguments[$name];
    }
}