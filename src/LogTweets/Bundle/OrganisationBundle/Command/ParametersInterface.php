<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

interface ParametersInterface
{
    public function get($name, $type = null);

    public function set($name, $value, $type = null);

    public function delete($name, $type = null);
}