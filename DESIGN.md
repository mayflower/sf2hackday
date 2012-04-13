# Design

## Bounded Context: Organisation

Used for:
  - Login
  - Registration
  - Organisation administration

### Organisations
  - Top level entity
  - Organisations must have a founder: Organisation::getFounder()
  - Organisations have multiple members: Organisation::addMember(), Organisation::removeMember(), Organisation::getMembers()
  - Organisations have multiple system groups

### Founder
  - The organisations founder is the founding user of an organisation
  -- Should be changeable
  - Founder has administrative rights (invite other members, disable members)
  -- Allow granting administrative rights to other members?

### Member
  - A member has a real name, a nickname, an email address and a password
  - Organisation members are allowed to create changelog entries for this organisation
  -- There is no reason they cannot be part of multiple organisations but doesn’t matter for the start

### System Group
  - A system group has a name
  - A System Group has n number of changelog entries
  - A System Group has n Systems

## Bounded Context: Changelog

Used for:
 - Displaying changelog entries
 - Creating new changelog entries

### Changelog entry
  - Changelog entry consists of text, creation date (microtime!), the related System, the related System Group and the
    author of the entry
