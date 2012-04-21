<?php
namespace LogTweets\Component\Service\Command;

class CommandInterface
{
    public function execute(InputArgument $argument);

    public function rollback(InputArgument $argument);
}