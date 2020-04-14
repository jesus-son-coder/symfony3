<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExcelData
 *
 * @ORM\Table(name="20200414_01_excel_import_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExcelDataRepository")
 */
class ExcelData
{
    /**
     * @var int
     *
     * @ORM\Column(name="serial", type="integer")
     * @ORM\Id
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @return int
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param int $serial
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
