<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestLog
 *
 * @ORM\Table(name="test_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestLogRepository")
 */
class TestLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ball", type="integer", nullable=true)
     */
    private $ball;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="tests")
     */
    private $user;

    /**
     * @ORM\Column(type="string" , nullable=true)
     */
    private $test;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->test = 'test-1';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ball
     *
     * @param integer $ball
     *
     * @return TestLog
     */
    public function setBall($ball)
    {
        $this->ball = $ball;

        return $this;
    }

    /**
     * Get ball
     *
     * @return int
     */
    public function getBall()
    {
        return $this->ball;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TestLog
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param mixed $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }


}

