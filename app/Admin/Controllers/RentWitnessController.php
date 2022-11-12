<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RentWitness;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class RentWitnessController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RentWitness(), function (Grid $grid) {
            // $grid->export();
            $grid->disableFilterButton();
            // $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('title')->sortable();
            $grid->column('witness_front_cover')->image();
            $grid->column('content')->display(function ($content) {
                return "<p style=\"width:300px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;\">".str_replace("</p>", "",str_replace("<p>", "", $content))."</p>";
            });
            $grid->column('content_en')->display(function ($content) {
                return "<p style=\"width:300px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;\">".str_replace("</p>", "",str_replace("<p>", "", $content))."</p>";
            });
            // $grid->column('path');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->actions(function ($actions) {
                // 去掉删除
                $actions->disableDelete();
            });

            $grid->batchActions(function ($batch) {
                // $batch->disableDelete();
            });

            $grid->quickSearch('title');

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                // $filter->like('', '');

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
        return Show::make($id, new RentWitness(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();

            });
            $show->field('id');
            $show->field('title');
            $show->field('witness_front_cover')->image();
            $show->field('content')->unescape()->as(function ($content) {
                return $content;
            });
            $show->field('content_en')->unescape()->as(function ($content) {
                return $content;
            });
            $show->field('path')->image();
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
        return Form::make(new RentWitness(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->image('witness_front_cover')->move('images/witness/'.date('Ym').'/frontCover')->uniqueName()->rules('mimes:jpg,jpeg,png,gif');
            $form->editor('content')->options(['menubar' => false, 'toolbar' => ['code undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent | \
            styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | \
            table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen | bdmap indent2em lineheight formatpainter axupimgs']])->imageDirectory('editor/images');
            $form->editor('content_en')->options(['menubar' => false, 'toolbar' => ['code undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent | \
            styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | \
            table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen | bdmap indent2em lineheight formatpainter axupimgs']])->imageDirectory('editor/images');
            $form->multipleImage('path')->move('images/witness/'.date('Ym'))->maxSize(3072)->uniqueName()->rules('mimes:jpg,jpeg,png,gif|nullable')->sortable();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
