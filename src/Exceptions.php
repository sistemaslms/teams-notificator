<?php

namespace TeamsNotificator;

class TeamsNotificatorException extends \RuntimeException {}
class InvalidWebhookUrlException extends TeamsNotificatorException {}
class HttpRequestException extends TeamsNotificatorException {}
