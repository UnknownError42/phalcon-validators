<?php

namespace Learnph\Common\Services;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class NumericValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation. Allowed options:
     * 'min' : input value must not be lower than it;
     * 'max' : input value must not be higher than it.
     *
     * @param  Validation  $validator
     * @param  string  $attribute
     *
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if(!preg_match('/^([0-9])+$/u', $value)) {

            $message = $this->getOption('message');

            if (!$message) {
                $message = 'The value can contain only numeric (0-9) characters';
            }

            $validator->appendMessage(new Message($message, $attribute, 'Numeric'));

            return false;
        }

        if($min = $this->getOption('min')) {
            if ($value < $min) {
                return false;
            }
        }

        if($max = $this->getOption('max')) {
            if ($value > $max) {
                return false;
            }
        }

        return true;
    }
}