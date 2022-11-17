<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvSeriesInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RvSeriesInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvSeriesInfo(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('rv_series_name');
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
        return Show::make($id, new RvSeriesInfo(), function (Show $show) {
            $show->field('id');
            $show->field('rv_series_name');
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
        return Form::make(new RvSeriesInfo(), function (Form $form) {
            $form->display('id');
            $form->text('rv_series_name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
