<?php

namespace Vibby\PommProjectFosUserBundle\Model;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Vibby\PommProjectFosUserBundle\Model\User;
use Vibby\PommProjectFosUserBundle\Model\UserStructure;

/**
 * UserModel
 *
 * Model class for table user.
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
        $this->structure = new UserStructure;
        $this->flexible_entity_class = '\Vibby\PommProjectFosUserBundle\Model\User';
    }
}
