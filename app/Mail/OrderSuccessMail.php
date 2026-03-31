<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Biến này sẽ chứa thông tin đơn hàng

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt hàng thành công tại BookStore')
                    ->view('emails.order_success'); // Trỏ đến file giao diện HTML
    }
}