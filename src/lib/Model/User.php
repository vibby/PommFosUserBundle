<?php

namespace Fferriere\PommProjectFosUserBundle\Model;

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
    /**
     * Returns the user unique id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this['id'];
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
        $this['username'] = $username;
        return $this;
    }

    /**
     * Gets the canonical username in search and sort queries.
     *
     * @return string
     */
    public function getUsernameCanonical()
    {
        return $this['username_canonical'];
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
        $this['username_canonical'] = $usernameCanonical;
        return $this;
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this['email'];
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
        $this['email'] = $email;
        return $this;
    }

    /**
     * Gets the canonical email in search and sort queries.
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this['email_canonical'];
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
        $this['email_canonical'] = $emailCanonical;
        return $this;
    }

    /**
     * Gets the plain password.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this['plain_password'];
    }

    /**
     * Sets the plain password.
     *
     * @param string $password
     *
     * @return self
     */
    public function setPlainPassword($password)
    {
        $this['plain_password'] = $password;
        return $this;
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
        $this['Password'] = $password;
        return $this;
    }

    /**
     * Tells if the the given user has the super admin role.
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this['super_admin'];
    }

    /**
     * @param boolean $boolean
     *
     * @return self
     */
    public function setEnabled($boolean)
    {
        $this['enabled'] = $boolean;
        return $this;
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
        $this['locked'] = $boolean;
        return $this;
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
        $this['super_admin'] = $boolean;
        return $this;
    }

    /**
     * Gets the confirmation token.
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this['confirmation_token'];
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
        $this['confirmation_token'] = $confirmationToken;
        return $this;
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
        $this['password_requested_at'] = $date;
        return $this;
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
        $this['last_login'] = $time;
        return $this;
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
    public function hasRole($role)
    {
        return array_search($role, $this['roles']);
    }

    /**
     * Sets the roles of the user.
     *
     * This overwrites any previous roles.
     *        return $this;

     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles)
    {
        $this['roles'] = $roles;
        return $this;
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
            $this['roles'][] = $role;
        }
        return $this;
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
            $this['roles'] = array_values(array_diff($this['roles'],[$role]));
        }
        return $this;
    }

    /**
     * @inherit
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
     * @inherit
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
     * @inherit
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
     * @inherit
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
     * @inherit
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->get('roles');
    }

    /**
     * @inherit
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @inherit
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->get('salt');
    }

    /**
     * @inherit
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->get('username');
    }

    /**
     * @inherit
     */
    public function eraseCredentials()
    {
        return;
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
            $expired,
            $locked,
            $credentialsExpired,
            $enabled,
            $id
        ) = $data;

        $this->setPassword($password)
            ->setSalt($salt)
            ->setUsernameCanonical($usernameCanonical)
            ->setUsername($username)
            ->setExpired($expired)
            ->setLocked($locked)
            ->setCredentialsExpired($credentialsExpired)
            ->setEnabled($enabled)
            ->setId($id);
    }

    public function serialize() {
        return serialize(array(
            $this->getPassword(),
            $this->getSalt(),
            $this->getUsernameCanonical(),
            $this->getUsername(),
            $this->isExpired(),
            $this->isLocked(),
            $this->isCredentialsExpired(),
            $this->isEnabled(),
            $this->getId(),
        ));
    }
}
