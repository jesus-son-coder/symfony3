<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 25/04/2020
 * Time: 12:02
 **/

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="20200425_01_genus_notes")
 */
class GenusNote
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(name="username", type="string")
   */
  private $username;

  /**
   * @ORM\Column(name="userAvatarFileNname", type="string")
   */
  private $userAvatarFileNname;

  /**
   * @ORM\Column(name="note", type="text")
   */
  private $note;

  /**
   * @ORM\Column(name="createdAt", type="datetime")
   */
  private $createdAt;


  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Genus")
   */
  private $genus;

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
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @param mixed $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * @return mixed
   */
  public function getUserAvatarFileNname()
  {
    return $this->userAvatarFileNname;
  }

  /**
   * @param mixed $userAvatarFileNname
   */
  public function setUserAvatarFileNname($userAvatarFileNname)
  {
    $this->userAvatarFileNname = $userAvatarFileNname;
  }

  /**
   * @return mixed
   */
  public function getNote()
  {
    return $this->note;
  }

  /**
   * @param mixed $note
   */
  public function setNote($note)
  {
    $this->note = $note;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }


}