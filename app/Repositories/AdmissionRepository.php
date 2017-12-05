<?php

namespace App\Repositories;

use A17\CmsToolkit\Repositories\ModuleRepository;
use App\Models\Admission;
use DateTime;

class AdmissionRepository extends ModuleRepository
{


    public function __construct(Admission $model)
    {
        $this->model = $model;
    }

    public function getDatesField($fields, $f)
    {
        if (($dateTime = DateTime::createFromFormat("Y-m-d H:i:s", $fields[$f]))) {
            $fields[$f] = $dateTime->format("m/d/Y");
        }

        return $fields;
    }

    public function prepareDatesField($fields, $f)
    {
        if (($datetime = DateTime::createFromFormat("m/d/Y", $fields[$f]))) {
            $fields[$f] = $datetime->format("Y-m-d");
        } else {
            $fields[$f] = null;
        }

        return $fields;
    }
}
