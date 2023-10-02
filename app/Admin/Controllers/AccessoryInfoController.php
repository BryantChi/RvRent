<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AccessoryInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\AccessoryInfo as Accessory;

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
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            // $grid->column('id')->sortable();
            $grid->column('accessory_id');
            $grid->column('accessory_name');
            $grid->column('accessory_specification')->display(function ($spec) {
                $spec_infos = json_decode($spec);
                $str = '';
                foreach($spec_infos as $info) {
                    $str .= $info->item . ' X ' . $info->count . '<br>';
                    // . '..........  $' . $info->price
                }
                return $str;
            });
            $grid->column('accessory_buy_date');
            $grid->column('accessory_quantity');
            $grid->column('accessory_instock');
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
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();

            });
            // $show->field('id');
            $show->field('accessory_id');
            $show->field('accessory_name');
            $show->field('accessory_specification')->unescape()->as(function ($spec) {
                $spec_infos = json_decode($spec);
                $str = '';
                foreach($spec_infos as $info) {
                    $str .= $info->item . ' X ' . $info->count . '<br>';
                    // . '..........  $' . $info->price
                }
                return $str;
            }); // ->explode('<br>')->label()
            $show->field('accessory_buy_date');
            $show->field('accessory_quantity');
            // $show->field('accessory_instock');
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
            // $form->textarea('accessory_specification')->rows(3);
            $form->table('accessory_specification', function ($table) {
                $table->text('item', __('項目'));
                $table->number('count', __('數量'));
                $table->currency('price', __('價格'))->symbol('NT$');
            })->saving(function ($v) {
                return json_encode($v);
            });

            $form->date('accessory_buy_date');
            if ($form->isCreating()) {
                $form->number('accessory_quantity');
                // $val_status = 0;
            } else {
                $form->display('accessory_quantity')->value($form->model()->accessory_quantity);
                // $val_status = $form->model()->accessory_instock;
            }
            // $form->display('accessory_instock')->value($val_status);
            $form->currency('accessory_unit_price')->symbol('NT$');
            $form->currency('accessory_gross_price')->symbol('NT$');
            $form->currency('accessory_rent_price')->symbol('NT$');

            $form->display('created_at');
            $form->display('updated_at');


            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isCreating()) {
                    $accessory = Accessory::find($form->getKey());
                    $accessory->accessory_instock = $accessory->accessory_quantity;
                    $accessory->save();
                }
            });
        });
    }
}
