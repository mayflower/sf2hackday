<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

use LogTweets\Bundle\OrganisationBundle\Entity\Organisation;

class CreateOrganisationCommand
{
    public function execute(Parameters $parameters)
    {
        $parameters->put('organisation', new Organisation($parameters->get('user')));

        return $parameters;
    }

    public function undo(Parameters $parameters)
    {
        $parameters->delete('organisation', 'LogTweets\Bundle\OrganisationBundle\Entity\Organisation');

        return $parameters;
    }
}