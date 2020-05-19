<?php


namespace Service\Order;

use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\Order\CheckoutBuilder;
use Service\User\SecurityInterface;

class Checkout
{
    /**
     * @var CheckoutBuilder
     */
    public $builder;

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

    public function __construct(
        DiscountInterface $discount,
        BillingInterface $billing,
        SecurityInterface $security,
        CommunicationInterface $communication
    )
    {
        $this->discount = $discount;
        $this->billing = $billing;
        $this->security = $security;
        $this->communication = $communication;
    }

    public function runCheckout(Basket $basket) {
        $totalPrice = 0;
        foreach ($basket->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $basket->communication->process($user, 'checkout_template');
    }
}