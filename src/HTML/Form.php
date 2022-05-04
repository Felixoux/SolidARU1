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
    
    public function reset(): string
    {
        return <<<HTML
    <input type="reset">
HTML;

    }

    public function input(string $key, string $label): string
    {
        $type = $key === "password" ? 'password' : 'text';
        if($type === 'password') {
            $value = '';
        }
        $value = $type === "password" ? '': $this->getValue($key);
        return <<<HTML
        <div class="form-group">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <input type="$type" name="$key" id="$key" value="$value" placeholder="$label" required>
        </div>
        HTML;
    }

    public function file(string $key, string $label): string
    {
        $type = $key === "password" ? 'password' : 'text';
        return <<<HTML
        <div class="form-group">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <input type="file" name="$key" id="$key">
        </div>
        HTML;
    }

    public function inputSecurity(string $key, string $label): string
    {
        $type = $key === 'current_password' ? 'text': 'password';
        return <<<HTML
        <div class="form-group">
            <label for="$key">$label</label>
            <input type="$type" name="$key" id="$key" required>
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
            <textarea type="text" name="$key" id="$key" placeholder="$label" required>$value</textarea>
        </div>
        HTML;
    }

    public function select(string $key, string $label, array $options = []): string
    {
        $optionsHTML = [];
        $value = $this->getValue($key);
        foreach ($options as $k => $v) {
            $selected = in_array($k, $value) ? ' selected' : '';
            $optionsHTML[] = "<option value=\"$k\"$selected>$v</option>";
        }

        $optionsHTML = implode('', $optionsHTML);
        return <<<HTML
        <div class="form-group">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <select name="{$key}[]" id="$key" required multiple>$optionsHTML</select>
        </div>
        HTML;
    }

    private function getValue(string $key)
    {

        if (is_array($this->data)) {
            return $this->data[$key] ?? null;
        }
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $value = $this->data->$method();
        if ($value instanceof \DateTimeInterface) {
            return $value->format("Y-m-d H:i:s");
        }
        return $value;
    }

    public function getInputClass(string $key): string
    {
        $alertClass = 'alert alert-danger';
        if (isset($this->errors[$key])) {
            $alertClass .= ' is_invalid';
        }
        return $alertClass;
    }

    public function getErrorFeedback(string $key)
    {
        $error_value = null;
        if (isset($this->errors[$key])) {
            $error_value = $this->errors[$key][0];
        }
        return $error_value;
    }
}