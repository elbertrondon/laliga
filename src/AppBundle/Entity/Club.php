<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClubRepository")
 */
class Club
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
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=true)
     */
    private $borrado;
    
    /**
     * Many User have Many Phonenumbers.
     * @ORM\ManyToMany(targetEntity="Jugadores")
     * @ORM\JoinTable(name="club_jugador",
     *      joinColumns={@ORM\JoinColumn(name="club_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="jugador_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $jugadores;
    
    
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
     * @return Club
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Club
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Club
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return bool
     */
    public function getBorrado()
    {
        return $this->borrado;
    }
    
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jugadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jugadore
     *
     * @param \AppBundle\Entity\Jugadores $jugadore
     *
     * @return Club
     */
    public function addJugadore(\AppBundle\Entity\Jugadores $jugadore)
    {
        $this->jugadores[] = $jugadore;

        return $this;
    }

    /**
     * Remove jugadore
     *
     * @param \AppBundle\Entity\Jugadores $jugadore
     */
    public function removeJugadore(\AppBundle\Entity\Jugadores $jugadore)
    {
        $this->jugadores->removeElement($jugadore);
    }

    /**
     * Get jugadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJugadores()
    {
        return $this->jugadores;
    }
}
