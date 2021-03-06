<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace yunwuxin\notification\channel;

use yunwuxin\Mail as Mailer;
use yunwuxin\mail\Mailable;
use yunwuxin\Notification;
use yunwuxin\notification\Channel;
use yunwuxin\notification\MailableMessage;
use yunwuxin\notification\message\Mail as MailMessage;
use yunwuxin\notification\Notifiable;

class Mail extends Channel
{
    /** @var Mailer */
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * 发送通知
     * @param Notifiable   $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $this->getMessage($notifiable, $notification);

        if ($message instanceof MailMessage) {
            $message = new MailableMessage($message, $notification);
        }

        if ($message instanceof Mailable) {
            $this->mailer->send($message);
        }
    }
}
