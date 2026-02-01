<?php

namespace app\interfaces;

interface PersonInterface
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
