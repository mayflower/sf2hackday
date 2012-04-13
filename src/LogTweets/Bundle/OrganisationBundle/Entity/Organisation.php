<?php
namespace LogTweets\Bundle\OrganisationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use DomainException;

class Organisation
{
    private $founder;

    private $members;

    public function __construct(MemberInterface $founder)
    {
        $this->founder = $founder;
        $this->members = new ArrayCollection();
    }

    public function getFounder()
    {
        return $this->founder;
    }
    
    public function addMember(MemberInterface $member)
    {
        if ($this->members->contains($member)) {
            throw new DomainException('Already a member of the organisation');
        }

        $this->members->add($member);
    }

    public function removeMember(MemberInterface $member)
    {
        if (!$this->members->contains($member)) {
            throw new DomainException('Cannot remove member from the organisation. Not a member');
        }
        $this->members->removeElement($member);
    }

    public function getMembers()
    {
        return $this->members->toArray();
    }
}
