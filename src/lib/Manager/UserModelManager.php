<?php

namespace Vibby\PommProjectFosUserBundle\Manager;

/**
 * MemberModel
 *
 * Model class for table member.
 *
 * @see Model
 */
class UserModelManager
{
    /**
     * __construct()
     *
     * Manager constructor
     *
     * @access public
     */
    public function __construct($pomm, $connectionName, $userModelClass)
    {
        $this->pomm = $pomm;
        $this->connectionName = $connectionName;
        $this->userModelClass = $userModelClass;
    }

    public function getModel()
    {
        return $this->pomm[$this->connectionName]
            ->getModel($this->userModelClass);
    }
}
