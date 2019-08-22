<?php

namespace Email;

/**
 * Class EmailFactory
 */
class EmailFactory
{
    /**
     * @return EmailClientInterface
     */
    public static function getEmailClient(): EmailClientInterface
    {
        $client = getenv('EMAIL_CLIENT');
        $className = '\\Email\\Clients\\NativePhp';

        if (!empty($client) && class_exists('\\Email\\Clients\\' . $client)) {
            $className = '\\Email\\Clients\\' . $client;
        }

        return new $className;
    }
}
