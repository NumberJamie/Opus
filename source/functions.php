<?php

namespace source;

function base_dir(string $fileName, string $ext = '.php'): string {
    if (str_ends_with($fileName, $ext) and $ext != '') {
        return BASE_DIR . $fileName;
    }
    return BASE_DIR . $fileName . $ext;
}

function view(string $fileName, array $attr = []): void {
    extract($attr);
    require base_dir("views/{$fileName}.view");
}

function clean_path(string $path): string {
    return filter_var($path, FILTER_SANITIZE_URL);
}