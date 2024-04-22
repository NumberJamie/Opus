<?php

/*
    simple password test
    NOTE: store 255 characters to be more future proof (of the hash not the user made password)
*/

class Password{
    private static int $min_strlen = 8;
    private static int $similarity_threshold = 75;
    private static string $algo = PASSWORD_ARGON2ID;
    
    function verifyPassword(string $password, string $password_hash): bool {
        if (password_needs_rehash($password_hash, self::$algo)){
            $password_hash = password_hash($password, self::$algo);
        }
        return password_verify($password, $password_hash);
    }
    
    function createPassword(string $username, string $password, array $errors = []): string | array {
        similar_text($username, $password, $similairity);
        $password_lenght = strlen($password);
        if (self::$min_strlen >= $password_lenght){
            $errors[] = 'Password is too short, needs to be ' . self::$min_strlen . ' characters or longer.';
        }
        if ($similairity > self::$similarity_threshold){
            $errors[] = 'Password cannot be similar to your other information.';
        }
        if ($errors) return $errors;
        return password_hash($password, self::$algo);
    }
}

$password_class = new Password();
?>

<form name="form" action="" method="post">
    <label for="username_test">username test</label>
    <input type="text" name="username_test" id="username_test" >
    <label for="password_test">password test</label>
    <input type="text" name="password_test" id="password_test" >
    <input type="submit" value="submit">
    <div class="errors">
        <?php
            $username = 'username_test';
            $password = 'password_test';
            if (array_key_exists($password, $_POST) && array_key_exists($username, $_POST)){
                $errors = $password_class->createPassword($_POST[$username], $_POST[$password]);
                if (is_array($errors)){
                    foreach ($errors as $error){
                        echo '<p>' . $error . '</p>';
                    }
                } else {
                    echo '<p>Password hash: ' . $errors . '</p>';
                }
            }
        ?>
    </div>
</form>
