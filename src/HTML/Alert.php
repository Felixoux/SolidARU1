<?php

namespace App\HTML;

final class Alert
{
    public function getAlert(string $get, string $message): ?string
    {
        $get_class = explode('/', $get);
        $get = $get_class[0];
        $class = $get_class[1] ?? 'alert-success';
        if(isset($_GET[$get])) {
            return <<<HTML
        <p class="alert $class">$message</p>
HTML;

        }
        return null;
    }
}