<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:49
 */

namespace Ftven\SdkTaxonomy\Entity;

class AccessToken
{
    private $id;

    /**
     * @var \DateTime
     */
    private $expire;
    private $token;

    /**
     * @param \DateTime $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    /**
     * @return \DateTime
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }


} 