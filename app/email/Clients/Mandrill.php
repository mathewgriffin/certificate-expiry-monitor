<?php

namespace Email\Clients;

use Email\EmailClientInterface;

/**
 * Class Mandrill
 */
class Mandrill implements EmailClientInterface
{
    /** @var string */
    private $fromAddress;

    /** @var string */
    private $apiKey;

    /**
     * Mandrill constructor.
     */
    public function __construct()
    {
        $this->fromAddress = getenv('SENDER_ADDRESS');
        $this->apiKey = getenv("MANDRILL_API_KEY");
    }

    /**
     * {@inheritDoc}
     */
    public function send(string $to, string $subject, string $message, string $headers): bool
    {
        try {
            $payload = [
                'key' => $this->apiKey,
                'message' => [
                    'subject' => $subject,
                    'text' => $message,
                    'from_email' => $this->fromAddress,
                    'to' => [
                        [
                            'email' => $to,
                        ],
                    ],
                ],
                "async" => true,
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

            $result = curl_exec($curl);

            curl_close($curl);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
    }
}
