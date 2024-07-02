<?php

namespace Ifelsedo\ActivityLog\Http\Controllers;

use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;
use Ifelsedo\ActivityLog\ActivityLogServiceProvider;
use Ifelsedo\ActivityLog\Models\ActivityLog;

class ActivityLogController extends AdminController
{
    // public function index(Content $content)
    // {
    //     return $content
    //         ->title(ActivityLogServiceProvider::trans('activity-log.title'))
    //         ->description(trans('admin.list'))
    //         ->body($this->grid());
    // }

    protected $translation = 'activity-log';

    protected function grid()
    {
        Admin::requireAssets('@ifelsedo.activity-log');
        Admin::script(
            <<<JS
    $(".properties").each(function () {
        $(this).jsonViewer(JSON.parse($(this).text()), { collapsed: true });
    });
JS
        );
        return Grid::make(new ActivityLog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('log_name');
            $grid->column('description');
            $grid->column('subject_type');
            $grid->column('event');
            $grid->column('subject_id');
            $grid->column('causer_type');
            $grid->column('causer_id');
            $grid->column('properties')->setAttributes(['class' => 'properties']);
            $grid->column('batch_uuid');
            $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->toolsWithOutline(false); // 工具栏
            $grid->disableCreateButton();
            $grid->disableQuickEditButton();
            $grid->disableEditButton();
            $grid->disableViewButton();
            // $grid->showColumnSelector();
            // $grid->setActionClass(Grid\Displayers\Actions::class);

            $grid->model()->orderBy('id', 'desc');
            $grid->quickSearch();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('log_name');
                $filter->equal('subject_id');
                $filter->equal('causer_id');
                // $filter->between('created_at')->datetime();
            });
        });
    }

    public function destroy($id)
    {
        $ids = explode(',', $id);

        ActivityLog::destroy(array_filter($ids));

        return JsonResponse::make()
            ->success(trans('admin.delete_succeeded'))
            ->refresh()
            ->send();
    }
}
