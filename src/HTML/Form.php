<?php

namespace App\HTML;

final class Form
{
    private $data;
    private array $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label, ?string $class = null, ?string $required = null, ?string
    $veryClass = null): string
    {
        $required_star = $required !== null ? '<span class="alert">*</span>' : '';
        $type = $key === "password" ? 'password' : 'text';
        if ($type === 'password') {
            $value = '';
        }
        $value = $type === "password" ? '' : $this->getValue($key);
        return <<<HTML
        <div class="form-group $veryClass">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label $required_star</label>
            <input max="18" type="$type" name="$key" id="$key" value="$value" class="$class" placeholder="$label" required>
        </div>
        HTML;
    }

    public function file(string $key, string $label, ?string $class = null): string
    {
        if($label === 'Ajouter des images' || $label === 'Ajouter des documents') {
            $filed = 'multiple required';
        } else {
            $filed = '';
        }
        $type = $key === "password" ? 'password' : 'text';
        return <<<HTML
        <div class="form-group $class">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label</label>
            <input type="file" name="$key" id="$key" $filed>
        </div>
        HTML;
    }

    public function inputSecurity(string $key, string $label): string
    {
        $type = $key === 'current_password' ? 'text' : 'password';
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
            <label for="$key">$label <span class="alert">*</span></label>
            <textarea name="$key" id="markDown" class="markDown" placeholder="$label" required>$value</textarea>
        </div>
        HTML;
    }

    public function select(string $key, string $label, array $options = [], ?string $required = null, ?string $class
    = null): string
    {
        $required_star = $required !== null ? '<span class="alert">*</span>' : '';
        $optionsHTML = [];
        $value = $this->getValue($key);
        foreach ($options as $k => $v) {
            $selected = in_array($k, $value) ? ' selected' : '';
            $optionsHTML[] = "<option value=\"$k\"$selected>$v</option>";
        }

        $optionsHTML = implode('', $optionsHTML);
        return <<<HTML
        <div class="form-group $class">
            <p class="{$this->getInputClass($key)}">{$this->getErrorFeedback($key)}</p>
            <label for="$key">$label $required_star</label>
            <p class="mb1">Séléctionnez un(e) ou plusieurs $label si vous le souhaitez</p>
            <select name="{$key}[]" id="$key" $required multiple>$optionsHTML</select>
        </div>
        HTML;
    }

    public function checkbox(string $key, string $label, string $class = null): string
    {
        return <<<HTML
        <div class="$class">
        <input type="checkbox" name="$key" id="$key">
        <label for="$key">$label</label>
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