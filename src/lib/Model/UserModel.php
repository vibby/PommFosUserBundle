<?php

namespace Fferriere\PommProjectFosUserBundle\Model;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Fferriere\PommProjectFosUserBundle\Model\UserStructure;

/**
 * MemberModel
 *
 * Model class for table member.
 *
 * @see Model
 */
class UserModel extends Model
{
    use WriteQueries;

    /**
     * __construct()
     *
     * Model constructor
     *
     * @access public
     */
    public function __construct()
    {
        $this->structure = new UserStructure();
        $this->flexible_entity_class = '\Fferriere\PommProjectFosUserBundle\Model\User';
    }
}
