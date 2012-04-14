<?php
namespace LogTweets\Bundle\OrganisationBundle\Command;

class AddMemberCommand implements CommandInterface
{
    public function execute(ParametersInterface $parameters)
    {
        $organisation = $parameters->get('organisation', 'LogTweets\Bundle\OrganisationBundle\Entity\Organisation');

        /* @var $organisation LogTweets\Bundle\OrganisationBundle\Entity\Organisation */
        $organisation->addMember($parameters->get('user'));
    }

    public function rollback(ParametersInterface $parameters)
    {
        $organisation = $parameters->get('organisation', 'LogTweets\Bundle\OrganisationBundle\Entity\Organisation');

        /* @var $organisation LogTweets\Bundle\OrganisationBundle\Entity\Organisation */
        $organisation->removeMember($parameters->get('user'));
    }
}