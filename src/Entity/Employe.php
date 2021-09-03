<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EmployeRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ApiResource(
 *      denormalizationContext={"groups"={"post"}}
 * )
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"post"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"post"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="smallint")
     * * @Groups({"post"})
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"post"})
     */
    private $poste;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="employe", orphanRemoval=true, cascade={"persist", "remove"})
     * * @Groups({"post"})
     */
    private $experience;

    public function __construct()
    {
        $this->experience = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experience->contains($experience)) {
            $this->experience[] = $experience;
            $experience->setEmploye($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experience->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getEmploye() === $this) {
                $experience->setEmploye(null);
            }
        }

        return $this;
    }
}
