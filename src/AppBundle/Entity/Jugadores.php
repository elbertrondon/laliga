<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugadores
 *
 * @ORM\Table(name="jugadores")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JugadoresRepository")
 */
class Jugadores
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;
    
    /**
     * @ORM\ManyToMany(targetEntity="Club", mappedBy="jugadores")
     */
    protected $club;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Jugadores
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    

    

    
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->club = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add club
     *
     * @param \AppBundle\Entity\Club $club
     *
     * @return Jugadores
     */
    public function addClub(\AppBundle\Entity\Club $club)
    {
        $this->club[] = $club;

        return $this;
    }

    /**
     * Remove club
     *
     * @param \AppBundle\Entity\Club $club
     */
    public function removeClub(\AppBundle\Entity\Club $club)
    {
        $this->club->removeElement($club);
    }

    /**
     * Get club
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClub()
    {
        return $this->club;
    }
}
