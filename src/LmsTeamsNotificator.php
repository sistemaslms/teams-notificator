<?php

namespace LmsTeamsNotificator;

final class LmsTeamsNotificator
{
    /** @var HttpClient */
    private $httpClient;

    /** @var string */
    private $webhookUrl;

    /** @var string */
    private $message = '';

    /**
     * @param string $webhookUrl
     * @param string $message
     * @param HttpClient|null $httpClient
     */
    public function __construct($webhookUrl, $message = '')
    {
        $this->httpClient = new HttpClient();
        $this->webhookUrl = $webhookUrl;
        $this->message = $message . "\n\n";
    }

    /**
     * Concatena texto al mensaje, terminando cada llamada con "\n\n"
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->message .= $text . "\n\n";
        return $this;
    }

    /**
     * Envía el mensaje acumulado al webhook configurado
     *
     * @return void
     */
    public function notify()
    {
        $this->httpClient->postJson($this->webhookUrl, array(
            'message' => $this->message,
        ));
    }

    /**
     * Limpia el mensaje acumulado (opcional, si reutilizas el objeto)
     *
     * @return self
     */
    public function reset()
    {
        $this->message = '';
        return $this;
    }
}
