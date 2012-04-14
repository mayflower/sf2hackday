<?php
namespace LogTweets\Bundle\OrganisationBundle\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use LogTweets\Bundle\OrganisationBundle\Command\CommandChain;
use LogTweets\Bundle\OrganisationBundle\Command\CreateOrganisationCommand;
use LogTweets\Bundle\OrganisationBundle\Command\AddMemberCommand;
use LogTweets\Bundle\OrganisationBundle\Command\Parameters;

class CreateOrganisationCommandTest extends TestCase
{
    public function setUp()
    {
        /**
         * Create new organisation
         * Add owner as member
         * Send confirmation email
         * Persist
         */
        $this->founder = $this->getMockBuilder('LogTweets\Bundle\OrganisationBundle\Entity\MemberInterface')
                              ->getMock();
    }

    public function testCreateOrganisation()
    {
        $chain = new CommandChain();
        $chain->addCommand(new StartTransactionCommand());
        $chain->addCommand(new CreateOrganisationCommand());
        $chain->addCommand(new AddMemberCommand());
        $chain->addCommand(new CommitTransactionCommand());

        $parameters = new Parameters();
        $parameters->set('user', $this->founder);
        $parameters = $chain->execute($parameters);
        $organisation = $parameters->get('organisation');
        $this->assertSame($this->founder, $organisation->getFounder());
    }
}