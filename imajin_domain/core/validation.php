<?php
// Validation functions

// Validate required field
function validate_required($value) {
    return !empty(trim($value));
}

// Validate minimum length
function validate_min_length($value, $min_length) {
    return strlen(trim($value)) >= $min_length;
}

// Validate maximum length
function validate_max_length($value, $max_length) {
    return strlen(trim($value)) <= $max_length;
}

// Validate numeric value
function validate_numeric($value) {
    return is_numeric($value);
}

// Validate integer value
function validate_integer($value) {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

// Validate a string without special characters (except spaces, hyphens, underscores)
function validate_alphanumeric_with_spaces($value) {
    return preg_match('/^[a-zA-Z0-9\s\-_]+$/', $value);
}

// Validate URL
function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

// Validate date (YYYY-MM-DD format)
function validate_date($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

// Generic validation function that returns array of errors
function validate_data($data, $rules) {
    $errors = [];
    
    foreach ($rules as $field => $rule) {
        $value = $data[$field] ?? '';
        
        // Check if required
        if (strpos($rule, 'required') !== false && !validate_required($value)) {
            $errors[$field] = ucfirst($field) . ' is required';
            continue; // Skip other validations if required field is empty
        }
        
        // Check min length
        if (preg_match('/min:(\d+)/', $rule, $matches)) {
            $min = (int)$matches[1];
            if (!validate_min_length($value, $min)) {
                $errors[$field] = ucfirst($field) . " must be at least $min characters";
            }
        }
        
        // Check max length
        if (preg_match('/max:(\d+)/', $rule, $matches)) {
            $max = (int)$matches[1];
            if (!validate_max_length($value, $max)) {
                $errors[$field] = ucfirst($field) . " must be no more than $max characters";
            }
        }
        
        // Check if numeric
        if (strpos($rule, 'numeric') !== false && !empty($value) && !validate_numeric($value)) {
            $errors[$field] = ucfirst($field) . " must be a number";
        }
        
        // Check if integer
        if (strpos($rule, 'integer') !== false && !empty($value) && !validate_integer($value)) {
            $errors[$field] = ucfirst($field) . " must be an integer";
        }
        
        // Check if alphanumeric with spaces
        if (strpos($rule, 'alpha_num_spaces') !== false && !empty($value) && !validate_alphanumeric_with_spaces($value)) {
            $errors[$field] = ucfirst($field) . " contains invalid characters";
        }
    }
    
    return $errors;
}