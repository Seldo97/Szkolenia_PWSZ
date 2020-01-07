<?php
    namespace Exceptions;

    class General extends \Exception
    {
        public function __construct($previousException = null, $message = null)
        {
            parent::__construct($message);
        }
    }
