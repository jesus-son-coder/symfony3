<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 25/04/2020
 * Time: 11:30
 **/

namespace AppBundle\Repository;


use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{
  /**
   *
   */
  public function findAllPublishedOrderedByRecentActive()
  {
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished',true)
      ->leftJoin('genus.notes', 'genus_note')
      ->orderBy('genus_note.createdAt', 'DESC')
      ->getQuery()
      ->execute();
  }

  /**
   * @return Genus[]
   */
  public function findAllPublishedOrderedBySize()
  {
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished',true)
      ->orderBy('genus.speciesCount', 'DESC')
      ->getQuery()
      ->execute();
  }
}