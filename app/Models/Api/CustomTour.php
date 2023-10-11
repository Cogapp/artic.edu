<?php

namespace App\Models\Api;

use App\Libraries\Api\Models\BaseApiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTour extends BaseApiModel
{
    protected $connection;

    public function __construct()
    {
        if (config('app.env') !== 'testing') {
            $this->connection = 'tours';
        }
    }

    protected $fillable = ['id', 'tour_json', 'timestamp'];
}
