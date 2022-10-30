<?php

use Hashemirafsan\TooMailable\Transports\{
    Amazon, Google, Mailchimp, Mailgun, Mailjet, 
    OhMySmtp, Postmark, Sendgrid, SendInBlue
};

return [
    'transports' => [
        'amazon' => Amazon::class,
        'google' => Google::class,
        'mailchimp' => Mailchimp::class,
        'mailgun' => Mailgun::class,
        'mailjet' => Mailjet::class,
        'postmark' => Postmark::class,
        'sendgrid' => Sendgrid::class,
        'sendinblue' => SendInBlue::class,
        'oh-my-smtp' => OhMySmtp::class,
    ],
];