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
      // "execute()" returns an array of results.
      // égetOneOrNullResult()" returns "one" result (or null)
  }
}