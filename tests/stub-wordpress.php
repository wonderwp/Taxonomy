<?php

declare(strict_types=1);

namespace {
    if (!class_exists('WP_Error', false)) {
        class WP_Error
        {
            public function __construct(
                private string $code = '',
                private string $message = '',
                private mixed $data = null
            ) {
            }

            public function get_error_code(): string
            {
                return $this->code;
            }

            public function get_error_message(): string
            {
                return $this->message;
            }
        }
    }

    if (!class_exists('WP_Taxonomy', false)) {
        class WP_Taxonomy
        {
            public function __construct(public string $name = '')
            {
            }
        }
    }

    if (!function_exists('register_taxonomy')) {
        function register_taxonomy($taxonomy, $object_type, $args = [])
        {
            $GLOBALS['wwp_test_register_taxonomy_calls'][] = compact('taxonomy', 'object_type', 'args');

            if (!empty($GLOBALS['wwp_test_register_taxonomy_return'])) {
                return $GLOBALS['wwp_test_register_taxonomy_return'];
            }

            return new WP_Taxonomy((string) $taxonomy);
        }
    }
}
