<?php

namespace App\Interfaces;

Interface PersonInterface
{
    /**
     * @return string
     */
    public function personName();

    /**
     * @return string
     */
    public function personPosition();

    /**
     * @return string
     */
    public function personCompany();
}
