<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RentOrderInfo;
use App\Models\RvModelInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Modal;
use App\Models\User;

class RentOrderInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RentOrderInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->disableViewButton();
            // $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->column('id')->sortable();
            $grid->column('order_num');
            $grid->column('order_status');
            $grid->column('order_user');
            $grid->column('order_rv_model_id')->display(function ($model_id) {
                return (RvModelInfo::find($model_id))->rv_name;
            });
            $grid->column('order_rv_amount_info')->display(function ($rv_amount_info) {
                $info = json_decode($rv_amount_info);
                $body = '';
                $body .= '<div class="row w-75 p-0 my-0 mx-auto justify-content-between">' .
                    '<div class="col-auto p-0">取車當日 </div>' .
                    '<div class="col-auto p-0">' . $info->other_value_get_time . ' 後</div>' .
                    '</div>';
                $body .= '<div class="row w-75 p-0 my-0 mx-auto justify-content-between">' .
                    '<div class="col-auto p-0">還車當日 </div>' .
                    '<div class="col-auto p-0">' . $info->other_value_back_time . ' 前</div>' .
                    '</div>';
                foreach ($info->other_value_other_price as $key => $value) {
                    if ($value->type == 'night') {
                        $body .= '<div class="row w-75 p-0 my-0 mx-auto justify-content-between">' .
                            '<div class="col-auto p-0">' . $value->item . '</div>' .
                            '<div class="col-auto p-0">NT$ ' . (int)$value->price . ' / 天</div>' .
                            '</div>';
                    } else {
                        $body .= '<div class="row w-75 p-0 my-0 mx-auto justify-content-between">' .
                            '<div class="col-auto p-0">' . $value->item . '</div>' .
                            '<div class="col-auto p-0">NT$ ' . (int)$value->price . ' / 次</div>' .
                            '</div>';
                    }
                }

                // ->lg()
                $modal = Modal::make()
                    ->scrollable()->centered()
                    ->title('車型其他配備租金資訊')
                    ->body($body)
                    ->button('<button class="btn btn-primary">查看</button>');
                return $modal;
            });
            $grid->column('order_one_night_rental');
            $grid->column('order_total_rental');
            $grid->column('order_night_count');
            $grid->column('order_get_date');
            $grid->column('order_back_date');
            $grid->column('order_bed_count');
            $grid->column('order_rv_vehicle');
            $grid->column('order_rv_vehicle_payment');
            $grid->column('order_rv_vehicle_payment_status');
            $grid->column('order_accessory_info')->display(function ($accessory_info) {
                if ($accessory_info !== null) {
                    $info = json_decode($accessory_info);
                    $body = '';
                    foreach ($info as $key => $value) {
                        $body .= '<h5>' . $value->equipment_name  . '</h5><div class="row w-75 p-0 my-0 mx-auto mb-3 justify-content-between">' .
                            '<div class="col-auto p-0">單價：NT$ ' . (int)$value->equipment_base_amount . '</div>' .
                            '<div class="col-auto p-0">總價：NT$ ' . (int)$value->equipment_total_amount . ' / ' . $value->equipment_count . ' 組</div>' .
                            '</div>';
                    }
                } else {
                    $body = '<h5 class="text-center">無額外配備租賃資訊</h5>';
                }

                // ->lg()
                $modal = Modal::make()
                    ->scrollable()->centered()
                    ->title('車型其他配備租金資訊')
                    ->body($body)
                    ->button('<button class="btn btn-primary">查看</button>');
                return $modal;
            });
            $grid->column('order_mileage_plan_info')->display(function ($plan_info) {
                $info = json_decode($plan_info);
                $body = '<p>方案：' . $info->plan_key . '</p><p>金額：NT$ ' . $info->plan_value . '</p>';
                return $body;
            });
            $grid->column('order_pay_way')->display(function ($payway) {
                switch ($payway) {
                    case 'remit':
                        return '匯款';
                        break;
                    case 'credit_card':
                        return '信用卡';
                        break;
                }
            });
            $grid->column('order_remit');
            $grid->column('order_client_note');
            $grid->column('order_company_note');
            $grid->column('order_other_driver_info')->display(function ($driver_info) {
                $info = json_decode($driver_info);
                $user = User::where('customer_id', $info->customer_id)->first();
                if ($info->dr_IDNumber == $user->IDNumber) {
                    $body = '<p>同該會員資訊</p>';
                } else {
                    $body = '<p>駕駛人：' . $info->dr_name . '</p>' .
                        '<p>駕駛人信箱：' . $info->dr_email . '</p>' .
                        '<p>駕駛人聯絡電話：' . $info->dr_phone . '</p>' .
                        '<p>駕駛人身分證字號：' . $info->dr_IDNumber . '</p>';
                }
                return $body;
            });
            $grid->column('order_other_driving_licence')->image();
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
        return Show::make($id, new RentOrderInfo(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();
                });
            $show->field('id');
            $show->field('order_num');
            $show->field('order_status');
            $show->field('order_user');
            $show->field('order_rv_model_id');
            $show->field('order_rv_amount_info');
            $show->field('order_one_night_rental');
            $show->field('order_total_rental');
            $show->field('order_night_count');
            $show->field('order_get_date');
            $show->field('order_back_date');
            $show->field('order_bed_count');
            $show->field('order_rv_vehicle');
            $show->field('order_rv_vehicle_payment');
            $show->field('order_rv_vehicle_payment_status');
            $show->field('order_accessory_info');
            $show->field('order_mileage_plan_info');
            $show->field('order_pay_way');
            $show->field('order_remit');
            $show->field('order_client_note');
            $show->field('order_company_note');
            $show->field('order_other_driver_info');
            $show->field('order_other_driving_licence');
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
        return Form::make(new RentOrderInfo(), function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableDelete();
                $tools->disableView();
                // $tools->disableList();
            });
            $form->display('id');
            $form->text('order_num');
            $form->text('order_status');
            $form->text('order_user');
            $form->text('order_rv_model_id');
            $form->text('order_rv_amount_info');
            $form->text('order_one_night_rental');
            $form->text('order_total_rental');
            $form->text('order_night_count');
            $form->text('order_get_date');
            $form->text('order_back_date');
            $form->text('order_bed_count');
            $form->text('order_rv_vehicle');
            $form->text('order_rv_vehicle_payment');
            $form->text('order_rv_vehicle_payment_status');
            $form->text('order_accessory_info');
            $form->text('order_mileage_plan_info');
            $form->text('order_pay_way');
            $form->text('order_remit');
            $form->text('order_client_note');
            $form->text('order_company_note');
            $form->text('order_other_driver_info');
            $form->text('order_other_driving_licence');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
