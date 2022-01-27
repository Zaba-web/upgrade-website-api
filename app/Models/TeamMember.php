<?php

namespace App\Models;

use App\Models\Core\Model;

class TeamMember extends Model {
    protected $tableName = 'team';
    protected $model = [
        'type' => 0,
        'name' => '',
        'biography' => '',
        'photo' => ''
    ];
}