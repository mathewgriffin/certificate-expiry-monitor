<?php

namespace Email;

/**
 * Interface EmailClientInterface
 */
interface EmailClientInterface
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $headers
     * @return bool
     */
    public function send(string $to, string $subject, string $message, string $headers): bool;
}