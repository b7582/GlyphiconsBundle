<?php

namespace GlyphiconsBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Icon
 * @ORM\Entity()
 * @ORM\Table(name="icon")
 *
 *
 */
class Icon
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     *
     *
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     * @var string
     *
     * @Assert\NotBlank(message="Please, svg")
     * @Assert\File(mimeTypes={ "image/svg" })
     *
     */
    protected $file ;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @param string $name
     * @return Icon
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}