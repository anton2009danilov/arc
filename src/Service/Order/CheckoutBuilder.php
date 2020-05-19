<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class CheckoutBuilder
{
    //TODO Написать самим класс строителя (BasketBuilder)
    /**
     * @var DiscountInterface
     */
    private $discount;

    /**
     * @var BillingInterface
     */
    private $billing;

    /**
     * @var SecurityInterface
     */
    private $security;

    /**
     * @var CommunicationInterface
     */
    private $communication;

    /**
     * @return DiscountInterface
     */
    public function getDiscount(): DiscountInterface
    {
        return $this->discount;
    }

    /**
     * @param DiscountInterface $discount
     */
    public function setDiscount(DiscountInterface $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return BillingInterface
     */
    public function getBilling(): BillingInterface
    {
        return $this->billing;
    }

    /**
     * @param BillingInterface $billing
     */
    public function setBilling(BillingInterface $billing): self
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @return SecurityInterface
     */
    public function getSecurity(): SecurityInterface
    {
        return $this->security;
    }

    /**
     * @param SecurityInterface $security
     */
    public function setSecurity(SecurityInterface $security): self
    {
        $this->security = $security;
        return $this;
    }

    /**
     * @return CommunicationInterface
     */
    public function getCommunication(): CommunicationInterface
    {
        return $this->communication;
    }

    /**
     * @param CommunicationInterface $communication
     */
    public function setCommunication(CommunicationInterface $communication): self
    {
        $this->communication = $communication;
        return $this;
    }

    /**
     * @return Checkout
     */
    public function build(): Checkout {

    }
}