<?php

namespace source;

use function source\base_dir;

class Config {
    private string $env;
    private array $variables = [];

    function __construct() {
        $this->env = base_dir('.env', '');
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