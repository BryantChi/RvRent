<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvDateLockInfo;
use App\Models\RvDateLockInfo as ModelsRvDateLockInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RvDateLockInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvDateLockInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('date');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });

            $info = ModelsRvDateLockInfo::all();
            if (count($info) > 0) {
                $grid->disableCreateButton();
            }
            $grid->disableFilter();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new RvDateLockInfo(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();

            });
            $show->field('id');
            $show->field('date');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new RvDateLockInfo(), function (Form $form) {
            $form->display('id');
            $form->table('date', function ($table) {
                $table->date('lock', __('鎖定日期'))->rules('required');
            })->saveAsJson();
            // $form->list('date')->rules('required|date:Y-m-d', ['required' => '日期不可為空', 'date' => '日期格式錯誤']);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
