<?php
/**
 * Created by PhpStorm.
 * User: Andros Laptop
 * Date: 3/25/14
 * Time: 2:11 AM
 */

namespace Fao\MainBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use \Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class OwnerVoter implements VoterInterface{

    public function supportsAttribute($attribute)
    {
        return 'ROLE_DOCUMENT' == $attribute;
    }

    public function supportsClass($class)
    {
        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        foreach ($attributes as $attribute) {
            if (false === $this->supportsAttribute($attribute)) {
                continue;
            }
            $user = $token->getUser();
            // comprobar que el documento que se edita fue publicada
            // por este usuario

            //if ($object->getDocs()->getUser() === $user->getId()) {
            //    return VoterInterface::ACCESS_GRANTED;
            //} else {
            //    return VoterInterface::ACCESS_DENIED;
            //}
        }
        return VoterInterface::ACCESS_ABSTAIN;
    }
} 