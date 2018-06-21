<?php

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface ChanelProductPricingInterface
 * @package AppBundle\Entity
 */
interface ChanelProductPricingInterface extends ResourceInterface
{
    /**
     * @return integer
     */
    public function getPrice();

    /**
     * @param $price
     */
    public function setPrice($price): void;

    /**
     * @return integer
     */
    public function getOriginalPrice();

    /**
     * @param $originalPrice
     */
    public function setOriginalPrice($originalPrice): void;

    /**
     * @return null|string
     */
    public function getChanelCode(): ?string;

    /**
     * @param string $chanelCode
     */
    public function setChanelCode(string $chanelCode): void;

    /**
     * @return Product
     */
    public function getProduct();

    /**
     * @param $product
     */
    public function setProduct($product): void;
}
