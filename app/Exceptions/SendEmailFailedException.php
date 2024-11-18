<?php

namespace App\Exceptions;

use App\Helpers\Log;
use Exception;

class SendEmailFailedException extends Exception
{
    // Optionally, you can define a custom message or code
    public function __construct($message = "メールの送信に失敗しました。", $code = 0)
    {
        // Pass the message and code to the parent Exception class
        parent::__construct($message, $code);
    }

    // Optionally, you can customize the report method to log the exception
    public function report()
    {
        Log::error('Email sending failed: ' . $this->getMessage());
    }

    // Optionally, customize the render method to return a custom response
    public function render($request)
    {
        return response()->view('errors.email_sending_failed', ['error' => $this->getMessage()]);
    }
}
