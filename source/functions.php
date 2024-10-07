<?php

namespace source;

function view(string $fileName, array $attr = []): void {
    extract($attr);
    require BASE_DIR . "views/{$fileName}.view.php";
}

function clean_path(string $path): string {
    return filter_var($path, FILTER_SANITIZE_URL);
}