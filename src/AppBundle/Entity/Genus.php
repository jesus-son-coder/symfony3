<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 23/04/2020
 * Time: 13:06
 **/

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRepository")
 * @ORM\Table(name="20200423_01_genus")
 */
class Genus
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", nullable=true)
   * @Assert\NotBlank()
   */
  private $name;


  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubFamily")
   * @ORM\JoinColumn(nullable=true)
   */
  private $subFamily;


  /**
   * @ORM\Column(name="speciesCount", type="integer", nullable=true)
   * @Assert\NotBlank()
   * @Assert\Range(min=0, minMessage="Negative species ! Come on...")
   */
  private $speciesCount;


  /**
   * @ORM\Column(name="funFact", type="text", nullable=true)
   */
  private $funFact;


  /**
   * @ORM\Column(name="isPublished", type="boolean")
   */
  private $isPublished = true;


  /**
   * @ORM\Column(name="firstDiscoveredAt", type="date")
   * @Assert\NotBlank()
   */
  private $firstDiscoveredAt;

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\GenusNote", mappedBy="genus")
   * @ORM\OrderBy({"createdAt"="DESC"})
   */
  private $notes;

  /**
   * Genus constructor.
   * @param $notes
   */
  public function __construct()
  {
    $this->notes = new ArrayCollection();
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }
  


  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getSubFamily()
  {
    return $this->subFamily;
  }

  /**
   * @param mixed $subFamily
   */
  public function setSubFamily(SubFamily $subFamily = null)
  {
    $this->subFamily = $subFamily;
  }

  /**
   * @return mixed
   */
  public function getSpeciesCount()
  {
    return $this->speciesCount;
  }

  /**
   * @param mixed $speciesCount
   */
  public function setSpeciesCount($speciesCount)
  {
    $this->speciesCount = $speciesCount;
  }

  /**
   * @return mixed
   */
  public function getFunFact()
  {
    return $this->funFact;
  }

  /**
   * @param mixed $funFact
   */
  public function setFunFact($funFact)
  {
    $this->funFact = $funFact;
  }

  public function getUpdatedAt()
  {
    return new \DateTime('-'.rand(0,100).' days');
  }

  /**
   * @return mixed
   */
  public function getIsPublished()
  {
    return $this->isPublished;
  }

  /**
   * @param mixed $isPublished
   */
  public function setIsPublished($isPublished)
  {
    $this->isPublished = $isPublished;
  }

  /**
   * @return ArrayCollection|GenusNote[]
   */
  public function getNotes()
  {
    return $this->notes;
  }

  /**
   * @return mixed
   */
  public function getFirstDiscoveredAt()
  {
    return $this->firstDiscoveredAt;
  }

  /**
   * @param mixed $firstDiscoveredAt
   */
  public function setFirstDiscoveredAt($firstDiscoveredAt)
  {
    $this->firstDiscoveredAt = $firstDiscoveredAt;
  }



}