<?php

namespace Ifelsedo\ActivityLog\Http\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LogsActivityTrait
{
    use LogsActivity;

    protected $logName = '';

    protected function getDescriptionForEvent(string $eventName): string
    {
        $description = '';
        $admin = '';
        if ($user = Auth('admin')->user()) {
            $admin = $user->name;
        } else {
            $admin = 'system';
        }
        switch ($eventName) {
            case 'created':
                $description = $admin . '新增记录#id:' . $this->id;
                break;
            case 'updated':
                $description = $admin . '修改数据#id:' . $this->id;
                break;
            case 'deleted':
                $description = $admin . '删除数据#id:' . $this->id;
                break;
            default:
                $description = $admin . '其他操作#id:' . $this->id;
                break;
        }
        return $description;
    }

    protected function getLogName(): string
    {
        // return $this->logName ?: strtolower(class_basename($this));
        return $this->logName ?: $this->table;
    }

    protected function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // 记录所有字段的更改
            ->dontLogIfAttributesChangedOnly(['updated_at']) // 当只有updated_at 字段更改时不记录
            ->logOnlyDirty() // 只有实际发生更改的字段记录
            ->dontSubmitEmptyLogs() // 不记录空日志
            ->useLogName($this->getLogName()) // 设置日志名
            ->setDescriptionForEvent(function (string $eventName) {
                return $this->getDescriptionForEvent($eventName);
            });
    }
}
