<?php

namespace Vibby\PommProjectFosUserBundle\Model;

use PommProject\ModelManager\Model\FlexibleEntity;
use FOS\UserBundle\Model\UserInterface;

/**
 * User
 *
 * Structure class for relation «user».
 *
 * Class and fields comments are inspected from table and fields comments.
 * Just add comments in your database and they will appear here.
 * @see http://www.postgresql.org/docs/9.0/static/sql-comment.html
 *
 *
 *
 * @see FlexibleEntity
 */
class User extends FlexibleEntity implements UserInterface
{
    protected $plainPassword;

    public function __construct(array $values = null)
    {
        parent::__construct($values);
        if (!$this->has('id')) {
            $this->set('salt', base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
            $this->setRoles([]);
        }
    }

    /**
     * Returns the user unique id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * Sets the username.
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->set('username', $username);
    }

    /**
     * Gets the canonical username in search and sort queries.
     *
     * @return string
     */
    public function getUsernameCanonical()
    {
        return $this->get('username_canonical');
    }

    /**
     * Sets the canonical username.
     *
     * @param string $usernameCanonical
     *
     * @return self
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        $this->set('username_canonical', $usernameCanonical);
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->get('email');
    }

    /**
     * Sets the email.
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->set('email', $email);
    }

    /**
     * Gets the canonical email in search and sort queries.
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this->get('email_canonical');
    }

    /**
     * Sets the canonical email.
     *
     * @param string $emailCanonical
     *
     * @return self
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->set('email_canonical', $emailCanonical);
    }

    /**
     * Sets the hashed password.
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->set('password', $password);
    }

    /**
     * Tells if the the given user has the super admin role.
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->get('super_admin');
    }

    /**
     * @param boolean $boolean
     *
     * @return self
     */
    public function setEnabled($boolean)
    {
        $this->set('enabled', $boolean);
    }

    /**
     * Sets the locking status of the user.
     *
     * @param boolean $boolean
     *
     * @return self
     */
    public function setLocked($boolean)
    {
        $this->set('locked', $boolean);
    }

    /**
     * Sets the super admin status
     *
     * @param boolean $boolean
     *
     * @return self
     */
    public function setSuperAdmin($boolean)
    {
        $this->set('super_admin', $boolean);
    }

    /**
     * Gets the confirmation token.
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->get('confirmation_token');
    }

    /**
     * Sets the confirmation token
     *
     * @param string $confirmationToken
     *
     * @return self
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->set('confirmation_token', $confirmationToken);
    }

    /**
     * Sets the timestamp that the user requested a password reset.
     *
     * @param null|\DateTime $date
     *
     * @return self
     */
    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        $this->set('password_requested_at', $date);
    }

    /**
     * Checks whether the password reset request has expired.
     *
     * @param integer $ttl Requests older than this many seconds will be considered expired
     *
     * @return boolean true if the user's password request is non expired, false otherwise
     */
    public function isPasswordRequestNonExpired($ttl)
    {
        return true;
    }

    /**
     * Sets the last login time
     *
     * @param \DateTime $time
     *
     * @return self
     */
    public function setLastLogin(\DateTime $time = null)
    {
        $this->set('last_login', $time);
    }

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole($role = null)
    {
        try {
            return array_search($role, $this->get('roles'));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Sets the roles of the user.
     *
     * This overwrites any previous roles.
     *
     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles)
    {
        $this->set('roles', $roles);
    }

    /**
     * Adds a role to the user.
     *
     * @param string $role
     *
     * @return self
     */
    public function addRole($role)
    {
        if (!$this->hasRole($role)) {
            $this->set('roles', array_merge($this->get('roles'),[$role]));
        }
    }

    /**
     * Removes a role to the user.
     *
     * @param string $role
     *
     * @return self
     */
    public function removeRole($role)
    {
        if ($this->hasRole($role)) {
            $this->set('roles', array_values(array_diff($this-get('roles'),[$role])));
        }
    }

    /**
     * @inheritdoc
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @inheritdoc
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * @inheritdoc
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->get('roles');
    }

    /**
     * @inheritdoc
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @inheritdoc
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->get('salt');
    }

    /**
     * @inheritdoc
     *
     * @return string|null The salt
     */
    public function setSalt($salt)
    {
        $this->set('salt', $salt);
    }

    /**
     * @inheritdoc
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->get('username');
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($password) {
        $this->plainPassword = $password;
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $password,
            $salt,
            $usernameCanonical,
            $username,
            $enabled,
            $id
        ) = $data;

        $this->setPassword($password);
        $this->setSalt($salt);
        $this->setUsernameCanonical($usernameCanonical);
        $this->setUsername($username);
        $this->setEnabled($enabled);
        $this->setId($id);;
    }

    public function serialize() {
        return serialize(array(
            $this->getPassword(),
            $this->getSalt(),
            $this->getUsernameCanonical(),
            $this->getUsername(),
            $this->isEnabled(),
            $this->getId(),
        ));
    }
}
