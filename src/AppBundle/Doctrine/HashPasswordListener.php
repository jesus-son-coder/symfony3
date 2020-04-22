<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 22/04/2020
 * Time: 19:10
 **/

namespace AppBundle\Doctrine;

use AppBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashPasswordListener implements EventSubscriber
{
  private $passwordEncoder;

  /**
   * HashPasswordListener constructor.
   * @param UserPasswordEncoder $passwordEncoder
   */
  public function __construct(UserPasswordEncoder $passwordEncoder)
  {
    $this->passwordEncoder = $passwordEncoder;
  }

  public function getSubscribedEvents()
  {
    return ['prePersist', 'preUpdate'];
  }

  /**
   * @param User $entity
   */
  public function encodePassword(User $entity)
  {
    $encoded = $this->passwordEncoder->encodePassword(
      $entity,
      $entity->getPlainPassword()
    );
    $entity->setPassword($encoded);
  }


  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();
    if(!$entity instanceof User || $entity->getPlainPassword() === '') {
      return;
    }
    // Encodage du Password avec la méthode de Hashage par défaut :
    $this->encodePassword($entity);
  }


  public function preUpdate(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();
    if(!$entity instanceof User || $entity->getPlainPassword() === '') {
      return;
    }
    // Encodage du Password avec la méthode de Hashage par défaut :
    $this->encodePassword($entity);
    $em = $args->getEntityManager();
    $meta = $em->getClassMetadata(get_class($entity));
    $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
  }



}