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
   * @ORM\Column(type="string")
   */
  private $name;
}