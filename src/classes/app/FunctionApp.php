<?php
namespace Application\app;

class Functions {
    public static function is_nulls(...$value): bool {
        for ($i = 0; $i < count($value); $i++) {
            if (is_null($value[$i])) {
                return true;
            } else {
                if (empty($value[$i])) {
                    return true;
                }
            }
        }

        return false;
    }
}