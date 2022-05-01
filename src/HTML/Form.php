<?php

namespace App\HTML;

class Form
{
    private $data;
    private array $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
        <div class="form-group">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <input type="text" name="$key" id="$key" value="$value" required>
        </div>
        HTML;
    }

    public function textarea(string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
        <div class="form-group">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <textarea type="text" name="$key" id="$key" value="$value" required>$value</textarea>
        </div>
        HTML;
    }

    private function getValue(string $key): ?string
    {

        if(is_array($this->data)) {
            return $this->data[$key] ?? null;
        }
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $value =  $this->data->$method();
        if($value instanceof \DateTimeInterface){
            return $value->format("Y-m-d H:i:s");
        }
        return $value;
    }

    public function getInputClass(string $key): string
    {
        $alertClass = 'alert alert-danger';
        if(isset($this->errors[$key])) {
            $alertClass .= ' is_invalid';
        }
        return $alertClass;
    }

    public function getErrorFeedback(string $key)
    {
        $error_value = null;
        if(isset($this->errors[$key])) {
            $error_value = $this->errors[$key][0];
        }
        return $error_value;
    }
}