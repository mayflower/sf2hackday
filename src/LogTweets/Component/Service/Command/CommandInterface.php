<?php
namespace LogTweets\Component\Service\Command;

class CommandInterface
{
    public function execute(InputArgumentBag $argument);

    public function rollback(InputArgumentBag $argument);
}