<?php

namespace TeamsNotificator;

final class TeamsNotificator
{
    /** @var HttpClient */
    private $httpClient;

    public function __construct(HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new HttpClient();
    }

    /**
     * Envía un mensaje a un endpoint que espera { "message": "..." }
     *
     * @param string $webhookUrl
     * @param string $message
     * @return void
     */
    public function send($webhookUrl, $message)
    {
        $this->assertValidUrl($webhookUrl);

        $this->httpClient->postJson($webhookUrl, array(
            'message' => $message,
        ));
    }

    /**
     * @param string $url
     * @return void
     */
    private function assertValidUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidWebhookUrlException("URL inválida: {$url}");
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (strtolower((string) $scheme) !== 'https') {
            throw new InvalidWebhookUrlException("La URL debe ser https: {$url}");
        }
    }
}
