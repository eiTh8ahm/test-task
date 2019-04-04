<?php

namespace TestTask;

class Validator
{
    /**
     * @param $value
     * @param string $rules
     *
     * @param string $valueType
     *
     * @return array
     */
    public static function validate($value, string $rules, string $valueType): array
    {
        $rules    = explode('|', $rules);
        $messages = [];

        foreach ($rules as $rule) {

            if (strpos($rule, ':') !== false) {
                $ruleParam = explode(':', $rule)[1];
                $rule      = explode(':', $rule)[0];
            }

            switch ($rule) {
                case 'not_empty':
                    {
                        if (empty($value)) {
                            $messages[] = $valueType . ' cannot be empty.';
                        }

                        break;
                    }
                case 'string':
                    {
                        if ( ! is_string($value)) {
                            $messages[] = $valueType . ' must be a type of String.';
                        }

                        break;
                    }
                case 'max_length':
                    {
                        if (strlen($value) > $ruleParam) {
                            $messages[] = 'The length of ' . $valueType . 'cannot be greater than ' . $ruleParam . '.';
                        }

                        break;
                    }

                default:
                    break;
            }
        }

        return $messages;
    }
}