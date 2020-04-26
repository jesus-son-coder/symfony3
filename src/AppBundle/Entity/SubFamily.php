<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 26/04/2020
 * Time: 21:38
 **/

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="20200426_01_subfamily")
 */
class SubFamily
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $name;

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }
}