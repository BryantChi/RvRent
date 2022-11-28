<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvAttachmentInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RvAttachmentInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvAttachmentInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('attachment_name');
            $grid->column('attachment_icon')->image();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
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
        return Show::make($id, new RvAttachmentInfo(), function (Show $show) {
            $show->field('id');
            $show->field('attachment_name');
            $show->field('attachment_icon')->image();
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
        return Form::make(new RvAttachmentInfo(), function (Form $form) {
            $form->display('id');
            $form->text('attachment_name')->required();
            $form->image('attachment_icon')->move('images/attachment_icon/')->maxSize(512)->rules('mimes:jpg,jpeg,png,gif')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
