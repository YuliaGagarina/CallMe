<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 09.08.2019
 * Time: 13:30
 */

namespace App\Repository;

interface RightsInterface
{
    const JUST_WATCH = 1;
    const CAN_CORRECT = 2;
    const CAN_ALL = 3;
}