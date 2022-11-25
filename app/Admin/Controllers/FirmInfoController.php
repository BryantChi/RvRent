<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\FirmInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\FirmInfo as Firm;
class FirmInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new FirmInfo(), function (Grid $grid) {
            // $grid->column('id')->sortable();
            $grid->column('firm_id');
            $grid->column('firm_name');
            $grid->column('firm_vat_number');
            $grid->column('firm_phone');
            $grid->column('firm_fax');
            $grid->column('firm_email');
            $grid->column('firm_line_id');
            $grid->column('firm_verify');
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
        return Show::make($id, new FirmInfo(), function (Show $show) {
            // $show->field('id');
            $show->field('firm_id');
            $show->field('firm_name');
            $show->field('firm_vat_number');
            $show->field('firm_phone');
            $show->field('firm_fax');
            $show->field('firm_email');
            $show->field('firm_line_id');
            $show->field('firm_verify');
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
        return Form::make(new FirmInfo(), function (Form $form) {
            $firm_id = 'F' . date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $infos = Firm::where('firm_id', '=', $firm_id)->get();
            if (count($infos) > 0) {
                $firm_id = 'F' . date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            }

            // $form->display('id');
            $form->hidden('firm_id')->value($firm_id);
            $form->text('firm_name');
            $form->text('firm_vat_number');
            $form->mobile('firm_phone')->options(['mask' => '999 999 9999']);
            $form->mobile('firm_fax')->options(['mask' => '999 999 9999']);
            $form->email('firm_email');
            $form->text('firm_line_id');
            $form->switch('firm_verify');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
