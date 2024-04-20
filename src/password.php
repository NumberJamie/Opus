<?php

/*
    simple password test
    NOTE: store 255 characters to be more future proof
*/

class Password{
    private static int $min_strlen = 8;
    private static int $max_strlen = 255;
    private static string $algo = PASSWORD_ARGON2ID;
    
    function verifyPassword(string $password, string $password_hash): bool {
        if (password_needs_rehash($password_hash, self::$algo)){
            $password_hash = password_hash($password, self::$algo);
        }
        return password_verify($password, $password_hash);
    }
    
    function createPassword(string $password, array $errors = []): string | array {
        $password_lenght = strlen($password);
        if (self::$min_strlen >= $password_lenght){
            $errors[] = 'Password is too short, needs to be ' . self::$min_strlen . ' characters or longer.';
        }
        if (self::$max_strlen <= $password_lenght){
            $errors[] = 'Password is too long, needs to be ' . self::$max_strlen . ' characters or shorter.';
        }
        if ($errors) return $errors;
        return password_hash($password, self::$algo);
    }
}

$password = new Password();
print_r($password->createPassword('d'));
