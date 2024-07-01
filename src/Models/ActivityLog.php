<?php
namespace Ifelsedo\ActivityLog\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'admin_activity_log';
}
