<?php


namespace Service\Order;


use Service\Billing\Transfer\Card;
use Service\Communication\Sender\Email;
use Service\Discount\NullObject;
use Service\User\Security;

class CheckoutFacade
{

    public function makeOrder(Basket $basket) {
        // Здесь должна быть некоторая логика выбора способа платежа
        $billing = new Card();

        // Здесь должна быть некоторая логика получения информации о скидке
        // пользователя
        $discount = new NullObject();

        // Здесь должна быть некоторая логика получения способа уведомления
        // пользователя о покупке
        $communication = new Email();

        $security = new Security($this->session);

        $checkoutProcess = new CheckoutProcess($discount, $billing, $security, $communication);
        $checkoutProcess->run($basket);

    }
}