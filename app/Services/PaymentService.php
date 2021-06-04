<?php


namespace App\Services;


class PaymentService
{
    public static function getPayments($orders, $role = 'courier')
    {
        $credit = 0;
        $cash = 0;

        if ($role === 'client') {
            foreach ($orders as $order) {
                if ($order->payment->paymentPos === 'admin') {
                    $value = (int)$order->delivery_pay;
                    $order->payment->isCredit ? $credit += $value : $cash += $value;
                }
            }
        } else {
            foreach ($orders as $order) {
                if ($order->payment->paymentPos === 'courier') {
                    $value = (int)$order->delivery_pay;
                    $order->payment->isCredit ? $credit += $value : $cash += $value;
                }
            }
        }

        return [
            'cash' => $cash,
            'credit' => $credit
        ];
    }

    public function updatePaymentsStatus($orders, $newStatus)
    {
        $id = 0;
        foreach ($orders as $order) {
            if ($newStatus == "admin") {
                if ($order->payment->paymentPos === 'courier') {
                    $order->payment()->update(['paymentPos' => 'admin']);
                }
            } else if ($newStatus == "finish") {
                if ($order->payment->paymentPos === 'admin') {
                    $order->payment()->update(['paymentPos' => 'finish']);
                }
            }
        }
    }
}
