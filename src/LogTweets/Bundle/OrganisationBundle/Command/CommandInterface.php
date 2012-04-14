<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

interface CommandInterface
{
    public function execute(ParametersInterface $parameters);

    public function rollback(ParametersInterface $parameters);
}