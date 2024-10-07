<?php

namespace source;

use ReflectionClass;

final class HTTPStatus {
    // 4xx client errors
    const int FORBIDDEN = 403;
    const int NOT_FOUND = 404;
    const int METHOD_NOT_ALLOWED = 405;

    public static function valid_states(): array {
        $reflection = new ReflectionClass(__CLASS__);
        return array_values($reflection->getConstants());
    }
}