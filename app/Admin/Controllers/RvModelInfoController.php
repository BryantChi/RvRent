<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvModelInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RvModelInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvModelInfo(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('rv_name');
            $grid->column('rv_front_cover');
            $grid->column('rv_series_id');
            $grid->column('rv_rent_setting');
            $grid->column('rv_discription');
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
        return Show::make($id, new RvModelInfo(), function (Show $show) {
            $show->field('id');
            $show->field('rv_name');
            $show->field('rv_front_cover');
            $show->field('rv_series_id');
            $show->field('rv_rent_setting');
            $show->field('rv_discription')->unescape()->as(function ($content) {
                return $content;
            });
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
        return Form::make(new RvModelInfo(), function (Form $form) {
            $form->display('id');
            $form->text('rv_name')->required();
            $form->text('rv_front_cover');
            $form->text('rv_series_id')->required();

            $form->text('rv_rent_setting')->placeholder('先隨便打');


            $form->editor('rv_discription')->options(['menubar' => false, 'toolbar' => ['code undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent | \
            styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | \
            table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen | bdmap indent2em lineheight formatpainter axupimgs']])->imageDirectory('editor/images');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
