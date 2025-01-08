<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    /**
     * Отправляет письмо с лендинга
     *
     * @param Request $request
     * @return void
     */
    public function sendMail(Request $request) {
        $to_name = 'B&B Logistic';
        $to_email = 'info@bb-logistic.com';

        Mail::send('mails.landing-email', ["name" => $request['name'], "phone" => $request['phone']], function ($message) use ($to_name, $to_email) {
            $message->to('info@bb-logistic.com', $to_name)->subject('Заявка с сайта B&B Logistic');
            $message->from($to_email, $to_email);
        } );

        return response()->json([
            'success' => true,
            'answer' => "Заявка успешно отправлена!",
            'data' => $request['name'] . $request['phone']
        ]);
    }
}
