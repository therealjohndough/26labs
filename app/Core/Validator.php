<?php

namespace App\Core;

class Validator {
    private array $errors = [];

    public function validate(array $data, array $rules): bool {
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $rulesList = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;

            foreach ($rulesList as $rule) {
                $this->validateRule($field, $value, $rule);
            }
        }

        return count($this->errors) === 0;
    }

    private function validateRule(string $field, mixed $value, string $rule): void {
        $ruleParts = explode(':', $rule);
        $ruleName = trim($ruleParts[0]);
        $params = isset($ruleParts[1]) ? explode(',', $ruleParts[1]) : [];

        match($ruleName) {
            'required' => $this->validateRequired($field, $value),
            'email' => $this->validateEmail($field, $value),
            'min' => $this->validateMin($field, $value, (int)$params[0]),
            'max' => $this->validateMax($field, $value, (int)$params[0]),
            'url' => $this->validateUrl($field, $value),
            default => null,
        };
    }

    private function validateRequired(string $field, mixed $value): void {
        if (empty($value)) {
            $this->errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    private function validateEmail(string $field, mixed $value): void {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' must be a valid email.';
        }
    }

    private function validateMin(string $field, mixed $value, int $min): void {
        if (!empty($value) && strlen((string)$value) < $min) {
            $this->errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " must be at least $min characters.";
        }
    }

    private function validateMax(string $field, mixed $value, int $max): void {
        if (!empty($value) && strlen((string)$value) > $max) {
            $this->errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " must not exceed $max characters.";
        }
    }

    private function validateUrl(string $field, mixed $value): void {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' must be a valid URL.';
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasErrors(): bool {
        return count($this->errors) > 0;
    }
}
