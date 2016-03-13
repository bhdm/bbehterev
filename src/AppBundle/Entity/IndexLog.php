<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexLog
 *
 * @ORM\Table(name="index_log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndexLogRepository")
 */
class IndexLog
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
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", nullable=true)
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="ball", type="integer")
     */
    private $ball;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    public function __construct()
    {
        $this->created = new \DateTime();
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return IndexLog
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
     * Set gender
     *
     * @param string $gender
     *
     * @return IndexLog
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return IndexLog
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set ball
     *
     * @param integer $ball
     *
     * @return IndexLog
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}

