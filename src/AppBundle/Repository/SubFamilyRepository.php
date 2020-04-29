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

class SubFamilyRepository extends EntityRepository
{
  public function createAlphabeticalQueryBuilder()
  {
    return $this->createQueryBuilder('sub_family')
        ->orderBy('sub_family.name','ASC');
  }
}