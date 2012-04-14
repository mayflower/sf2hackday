<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

use InvalidArgumentException;

class CommandChain implements CommandInterface
{
    private $commands = array();

    private $executed = array();

    public function addCommand(CommandInterface $command)
    {
        $this->commands[] = $commands;
    }

    public function execute(ParametersInterface $parameters)
    {

        foreach ($this->commands as $command) {
            $parameters = $command->execute($parameters);
            self::verifyParameters($parameters);

            $this->executed[] = $command;
        }
    }

    public function rollback(ParametersInterface $parameters)
    {
        foreach (array_reverse($this->executed) as $key => $command) {
            $parameters = $command->rollback($parameters);
            static::verifyParameters($parameters);
            unset($this->executed[$key]);
        }
    }

    private static function verifyParameters(ParametersInterface $parameters)
    {
        if (!$parameters instanceof ParametersInterface) {
            throw new InvalidArgumentException(
                sprintf(
                    'Command "%s" returned parameters of invalid type "%s"',
                    get_class($command),
                    get_class($parameters)
                )
            );
        }
    }
}