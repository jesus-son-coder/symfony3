<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 23/04/2020
 * Time: 13:06
 **/

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
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
   */
  private $name;


  /**
   * @ORM\Column(name="subFamily", type="string", nullable=true)
   */
  private $subFamily;


  /**
   * @ORM\Column(name="speciesCount", type="integer", nullable=true)
   */
  private $speciesCount;


  /**
   * @ORM\Column(name="funFact", type="string")
   */
  private $funFact;


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
  public function setSubFamily($subFamily)
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


}