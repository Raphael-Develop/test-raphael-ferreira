<?php

namespace App\Entity;

use App\Contract\Config\ConfigInterface;
use App\Repository\SignConfigRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignConfigRepository::class)]
class SignConfig implements ConfigInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * @var Collection<int, SignRule>
     */
    #[ORM\OneToMany(targetEntity: SignRule::class, mappedBy: 'signConfig', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $signRules;

    public function __construct()
    {
        $this->signRules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, SignRule>
     */
    public function getRules(): Collection
    {
        return $this->signRules;
    }

    public function addRule(SignRule $rule): static
    {
        if (!$this->signRules->contains($rule)) {
            $this->signRules->add($rule);
            $rule->setSignConfig($this);
        }

        return $this;
    }

    public function removeRule(SignRule $rule): static
    {
        if ($this->signRules->removeElement($rule)) {
            // set the owning side to null (unless already changed)
            if ($rule->getSignConfig() === $this) {
                $rule->setSignConfig(null);
            }
        }

        return $this;
    }
}
