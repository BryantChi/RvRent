<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CustomerInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CustomerInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CustomerInfo(), function (Grid $grid) {
            // $grid->column('id')->sortable()->hidden();
            $grid->column('customer_id')->sortable();
            $grid->column('customer_name');
            $grid->column('customer_nick_name');
            $grid->column('customer_phone');
            $grid->column('customer_gender');
            $grid->column('customer_driving_licence_number');
            $grid->column('customer_driving_licence_type');
            $grid->column('customer_birthday');
            $grid->column('customer_mail');
            $grid->column('customer_line_id');
            $grid->column('customer_country');
            $grid->column('customer_verify');
            // $grid->column('customer_token')->hidden();
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
        return Show::make($id, new CustomerInfo(), function (Show $show) {
            // $show->field('id')->hidden();
            $show->field('customer_id');
            $show->field('customer_name');
            $show->field('customer_nick_name');
            $show->field('customer_phone');
            $show->field('customer_gender');
            $show->field('customer_driving_licence_number');
            $show->field('customer_driving_licence_type');
            $show->field('customer_birthday');
            $show->field('customer_mail');
            $show->field('customer_line_id');
            $show->field('customer_country');
            $show->field('customer_verify');
            // $show->field('customer_token')->hidden();
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
        return Form::make(new CustomerInfo(), function (Form $form) {
            // $form->display('id')->hidden();
            $form->hidden('customer_id')->value(date('Ymd'.sprintf("%03d", mt_rand(1, 100))));
            $form->text('customer_name');
            $form->text('customer_nick_name');
            $form->mobile('customer_phone')->options(['mask' => '9999 999 999']);
            $form->radio('customer_gender')->options(['m' => '男', 'f'=> '女', 'n' => '不顯示'])->default('m');
            $form->text('customer_driving_licence_number');
            $form->text('customer_driving_licence_type');
            $form->date('customer_birthday');
            $form->email('customer_mail');
            $form->text('customer_line_id');
            $form->text('customer_country')->default('台灣');
            // $form->switch('customer_verify');
            $form->text('customer_token')->disable();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
