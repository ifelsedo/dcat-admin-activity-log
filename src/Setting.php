<?php

namespace Ifelsedo\ActivityLog;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function title()
    {
        return $this->trans('activity-log.title');
    }

    public function form()
    {
        // $this->text('key1')->required();
        // $this->text('key2')->required();
    }
}
