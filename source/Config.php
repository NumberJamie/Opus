<?php

namespace source;

class Config {
    private array $variables = [];
    private string $env = BASE_DIR . '.env';

    function __construct() {
        $contents = file($this->env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($contents as $line) {
            $this->variables += $this->create_pair($line);
        }
    }

    function get(string $key, string $fallback = ''): string {
        return $this->variables[$key] ?? $fallback;
    }

    private function create_pair(string $secret): array {
        list($key, $value) = explode('=', $secret, 2);
        return [$key => $value];
    }
}