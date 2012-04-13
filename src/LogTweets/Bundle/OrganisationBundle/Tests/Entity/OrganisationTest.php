<?php
namespace LogTweets\Bundle\OrganisationBundle\Tests\Entity;

use PHPUnit_Framework_TestCase as TestCase;
use LogTweets\Bundle\OrganisationBundle\Entity\Organisation;
use DomainException;

class OrganisationTest extends TestCase
{
    public function setUp()
    {
        $this->founder = $this->getMockBuilder('LogTweets\Bundle\OrganisationBundle\Entity\MemberInterface')
                              ->getMock();
        $this->memberA = $this->getMockBuilder('LogTweets\Bundle\OrganisationBundle\Entity\MemberInterface')
                              ->getMock();
        $this->memberB = $this->getMockBuilder('LogTweets\Bundle\OrganisationBundle\Entity\MemberInterface')
                              ->getMock();
    }

    public function testCreatingOrganisationWithFounder()
    {
        $organisation = new Organisation($this->founder);
        $this->assertSame($this->founder, $organisation->getFounder());
    }

    public function testAddingMembersToTheOrganisation()
    {
        $organisation = new Organisation($this->founder);

        $this->assertInternalType('array', $organisation->getMembers());
        $this->assertCount(0, $organisation->getMembers());
        $this->assertNull($organisation->addMember($this->memberA));
        $this->assertInternalType('array', $organisation->getMembers());
        $this->assertCount(1, $organisation->getMembers());
        $this->assertNull($organisation->addMember($this->memberB));
        $this->assertCount(2, $organisation->getMembers());
        $this->assertInternalType('array', $organisation->getMembers());
        $this->assertNull($organisation->removeMember($this->memberB));
        $this->assertCount(1, $organisation->getMembers());

        try {
            $organisation->addMember($this->memberA);
            $this->fail('Expected exception');
        } catch (DomainException $e) {
            $this->assertSame('Already a member of the organisation', $e->getMessage());
        }

        try {
            $organisation->removeMember($this->memberB);
            $this->fail('Expected exception');
        } catch (DomainException $e) {
            $this->assertSame('Cannot remove member from the organisation. Not a member', $e->getMessage());
        }
    }
}
