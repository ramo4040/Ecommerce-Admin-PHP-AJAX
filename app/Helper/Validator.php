<?php

namespace app\Helper;

use Exception;

class Validator {
    private $data;
    private $rules;
    private $errors;

    public  function create(array|string $data, array $rules): void {
        $this->data = $data;
        $this->rules = $rules;
        $this->errors = [];

        $this->sanitizeInput($this->data);

        foreach ($this->rules as $field => $ruleSet) {
            $this->validateField($field, $ruleSet);
        }
    }

    public  function sanitizeInput(array &$data): void {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars(trim($value));
        }
    }

    public  function validateField(string $field, string $rules): void {
        $rules = explode('|', $rules);
        foreach ($rules as  $rule) {
            $this->applyRule($field, $rule);
        }
    }


    public function applyRule(string $field, $rule) {
        switch (true) {
            case $rule === 'required' && empty($this->data[$field]):
                $this->addError($field, 'The :attribute field is required.');
                break;
            case $rule === 'alpha_num' && !preg_match('/^[a-zA-Z0-9 ]+$/', $this->data[$field]):
                $this->addError($field, ':attribute must contain only letters and numbers.');
                break;
            case $rule === 'price' && !is_numeric($this->data[$field]):
                $this->addError($field, 'The :attribute must be a valid price.');
                break;
            default:
                break;
        }
    }

    private function addError(string $field, string $message): void {
        $field = str_replace('_', ' ', $field);
        $this->errors[$field] = str_replace(':attribute', $field, $message);
    }

    public function fails(): bool {
        return !empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}
