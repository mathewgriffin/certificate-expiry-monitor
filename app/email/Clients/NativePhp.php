<?php

namespace Email\Clients;

use Email\EmailClientInterface;

/**
 * Class NativePhp
 */
class NativePhp implements EmailClientInterface
{
    /**
     * {@inheritDoc}
     */
    public function send(string $to, string $subject, string $message, string $headers): bool
    {
        return mail($to, $message, $headers);
    }

}