<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ChanelProductPricing
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChanelProductPricingRepository")
 * @ORM\Table(name="sylius_chanel_product_pricing")
 */
class ChanelProductPricing implements ChanelProductPricingInterface
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var mixed
     * @ORM\Column(name="price", type="integer")
     */
    protected $price;

    /**
     * @var mixed
     * @ORM\Column(name="original_price", type="integer")
     */
    protected $originalPrice;

    /**
     * @var string
     * @ORM\Column(name="chanel_code", type="string")
     */
    protected $chanelCode;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Product",
     *     inversedBy="channelProductPricings",
     *     cascade={"persist", "remove"}
     * )
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return (string)$this->getPrice();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    /**
     * @param mixed $originalPrice
     */
    public function setOriginalPrice($originalPrice): void
    {
        $this->originalPrice = $originalPrice;
    }

    /**
     * @return string
     */
    public function getChanelCode(): ?string
    {
        return $this->chanelCode;
    }

    /**
     * @param string $chanelCode
     */
    public function setChanelCode(string $chanelCode): void
    {
        $this->chanelCode = $chanelCode;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }
}
