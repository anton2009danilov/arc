<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class CheckoutProcess
{
    public $discount;
    public $billing;
    public $security;
    public $communication;

    public function __construct($discount, $billing, $security, $communication)
    {
        $this->discount = $discount;
        $this->billing = $billing;
        $this->security = $security;
        $this->communication = $communication;
    }

    public function run($basket): void
    {
        $totalPrice = 0;
        foreach ($basket->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $this->discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');


    }
}