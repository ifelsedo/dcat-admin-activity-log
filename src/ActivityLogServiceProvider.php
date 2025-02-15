<?php

namespace Ifelsedo\ActivityLog;

use Dcat\Admin\Extend\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/jquery.json-viewer.js',
    ];
	protected $css = [
		'css/jquery.json-viewer.css',
	];

    // 定义菜单
    protected $menu = [
        [
            'title' => 'Activity Logs',
            'uri'   => 'auth/activity-logs',
            'icon'  => '', // 图标可以留空
        ],
    ];

	public function settingForm()
	{
		return new Setting($this);
	}
}
