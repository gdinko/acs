<?php

namespace Gdinko\Acs\Exceptions;

use Exception;

class AcsException extends Exception
{
    protected $errors;

    /**
     * __construct
     *
     * @param  string $message
     * @param  int $code
     * @param  array $errors Acs Errors
     * @return void
     */
    public function __construct($message, $code = 0, $errors = null)
    {
        parent::__construct($message, $code);

        $this->errors = $errors;
    }

    /**
     * getErrors
     *
     * @return array
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
