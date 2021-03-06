<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="anons", type="text", nullable=true)
     */
    private $anons;

    /**
     * @var array
     *
     * @ORM\Column(name="preview", type="array")
     */
    private $preview;

    /**
     * @var array
     *
     * @ORM\Column(name="video", type="array")
     */
    private $video;

    /**
     * @var array
     *
     * @ORM\Column(name="iframe", type="string", nullable=true)
     */
    private $iframe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="publications")
     */
    private $category;

    /**
     * @var Specialty
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Specialty", inversedBy="publications")
     */
    private $specialties;

    /**
     * @var Comment
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="publication")
     */
    private $comments;



    public function __construct()
    {
        $this->enabled = true;
        $this->created = new \DateTime();
        $this->video = array();
        $this->preview = array();
        $this->specialties = new ArrayCollection();
        $this->comments = new ArrayCollection();

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
     * Set title
     *
     * @param string $title
     *
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Publication
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled = true)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param array $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }


    /**
     * @return Comment
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


    /**
     * @return array
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param array $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getAnons()
    {
        return $this->anons;
    }

    /**
     * @param string $anons
     */
    public function setAnons($anons)
    {
        $this->anons = $anons;
    }

    /**
     * @return array
     */
    public function getIframe()
    {
        return $this->iframe;
    }

    /**
     * @param array $iframe
     */
    public function setIframe($iframe)
    {
        $this->iframe = $iframe;
    }

    /**
     * @return Specialty
     */
    public function getSpecialties()
    {
        return $this->specialties;
    }

    /**
     * @param Specialty $specialties
     */
    public function setSpecialties($specialties)
    {
        $this->specialties = $specialties;
    }

    

}

