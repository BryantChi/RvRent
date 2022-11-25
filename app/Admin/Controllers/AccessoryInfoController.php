<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AccessoryInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AccessoryInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AccessoryInfo(), function (Grid $grid) {
            // $grid->column('id')->sortable();
            $grid->column('accessory_id');
            $grid->column('accessory_name');
            $grid->column('accessory_specification');
            $grid->column('accessory_buy_date');
            $grid->column('accessory_quantity');
            $grid->column('accessory_unit_price');
            $grid->column('accessory_gross_price');
            $grid->column('accessory_rent_price');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            $grid->disableDeleteButton();
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
        return Show::make($id, new AccessoryInfo(), function (Show $show) {
            // $show->field('id');
            $show->field('accessory_id');
            $show->field('accessory_name');
            $show->field('accessory_specification');
            $show->field('accessory_buy_date');
            $show->field('accessory_quantity');
            $show->field('accessory_unit_price');
            $show->field('accessory_gross_price');
            $show->field('accessory_rent_price');
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
        return Form::make(new AccessoryInfo(), function (Form $form) {
            $form->display('id');
            $form->text('accessory_id');
            $form->text('accessory_name');
            $form->textarea('accessory_specification')->rows(3);
            $form->date('accessory_buy_date');
            $form->number('accessory_quantity');
            $form->currency('accessory_unit_price')->symbol('NT$');
            $form->currency('accessory_gross_price')->symbol('NT$');
            $form->currency('accessory_rent_price')->symbol('NT$');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
