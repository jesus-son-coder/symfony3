<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(name="id", type="integer")
   */
  private $id;

  /**
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   */
  private $email;

  /**
   * Get id
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }


  public function getUsername()
  {
    return $this->email;
  }

  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }


  /**
   * @param mixed $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }


  public function getRoles()
  {
    return ['ROLE_USER'];
  }

  public function getPassword()
  {
  }

  public function getSalt()
  {
  }


  public function eraseCredentials()
  {
  }
}
