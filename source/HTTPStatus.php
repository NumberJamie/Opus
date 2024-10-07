<?php

namespace source;

use ReflectionClass;

final class HTTPStatus {
    // 1xx information
    const int CONTINUE = 100;
    const int SWITCHING_PROTOCOLS = 101;
    const int PROCESSING = 102;
    const int EARLY_HINTS = 103;

    // 2xx successful
    const int OK = 200;
    const int CREATED = 201;
    const int ACCEPTED = 202;
    const int NO_CONTENT = 204;
    const int RESET_CONTENT = 205;
    const int PARTIAL_CONTENT = 206;

    // 3xx redirection
    const int MOVED_PERMANENTLY = 301;
    const int NOT_MODIFIED = 304;

    // 4xx client errors
    const int BAD_REQUEST = 400;
    const int UNAUTHORIZED = 401;
    const int FORBIDDEN = 403;
    const int NOT_FOUND = 404;
    const int METHOD_NOT_ALLOWED = 405;
    const int NOT_ACCEPTABLE = 406;
    const int REQUEST_TIMEOUT = 408;
    const int TOO_MANY_REQUESTS = 429;

    // 5xx server errors
    const int INTERNAL_SERVER_ERROR = 500;
    const int NOT_IMPLEMENTED = 501;
    const int BAD_GATEWAY = 502;
    const int SERVICE_UNAVAILABLE = 503;

    static function valid_states(): array {
        $reflection = new ReflectionClass(__CLASS__);
        return array_values($reflection->getConstants());
    }
}