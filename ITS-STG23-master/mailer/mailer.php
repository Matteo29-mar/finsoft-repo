<?php
require_once __DIR__ . '/../config_test.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

function send_mail($to, $subject, $body, $from_email = MAILER_DEFAULT_FROM_EMAIL, $from_user = MAILER_DEFAULT_FROM_USER, $files = NULL)
{
    try {
        $transport = Transport::fromDsn(MAILER_DSN);

        $mailer = new Mailer($transport);
        $email = (new Email())
            ->from(new Address($from_email, $from_user))
            ->to($to)
            ->subject($subject)
            ->text($body)
            ->html($body);

        if (isset($files)) {
            if (is_array($files)) foreach ($files as $file) $email->attachFromPath($file);
            else $email->attachFromPath($files);
        }

        $mailer->send($email);
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
