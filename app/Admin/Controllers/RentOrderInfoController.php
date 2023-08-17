<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Order\BatchRestore;
use App\Admin\Repositories\RentOrderInfo;
use App\Mail\OrderServicesMail;
use App\Models\RvModelInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Modal;
use App\Models\User;
use App\Models\RentOrderInfo as Order;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Illuminate\Support\Carbon;

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
            // $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->disableViewButton();
            $grid->disableCreateButton();
            // $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->column('id')->sortable();
            $grid->column('order_num')->sortable();
            $grid->column('order_status')->select(Order::ORDER_STATUS_SELECT, true)->sortable();
            $grid->column('order_user')->display(function ($user_num) {
                $check = '';
                $user = User::where('customer_id', $user_num)->first();
                if ((bool)$user->driving_licence_certified) {
                    $check = '<span class="text-success"><i class="fa fa-circle"></i></span> ' . '<a href="' . env('APP_URL') . 'customer?_search_=' . $user_num . '">' . $user_num . '</a>';
                } else {
                    $check = '<span class="text-danger"><i class="fa fa-circle"></i></span> ' . '<a href="' . env('APP_URL') . 'customer?_search_=' . $user_num . '">' . $user_num . '</a>';
                }
                return $check;
            })->sortable();
            $grid->column('order_rv_model_id')->display(function ($model_id) {
                return (RvModelInfo::find($model_id))->rv_name;
            })->sortable();
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
            $grid->column('order_one_night_rental')->sortable();
            $grid->column('order_total_rental')->sortable();
            $grid->column('order_night_count')->sortable();
            $grid->column('order_get_date')->sortable();
            $grid->column('order_back_date')->sortable();
            $grid->column('order_bed_count')->sortable();
            $grid->column('order_rv_vehicle')->sortable();
            $grid->column('order_rv_vehicle_payment')->sortable();
            $grid->column('order_rv_vehicle_payment_status')->sortable();
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
            })->sortable();
            $grid->column('order_remit')->image();
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
            $grid->column('created_at')->sortable();
            $grid->column('updated_at')->sortable();

            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->scope('trashed', '回收站')->onlyTrashed();
            });

            // $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
            //     if (request('_scope_') == 'trashed') {
            //         $batch->add(new BatchRestore(Order::class));
            //     }
            // });
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
            $form->select('order_status')->options(Order::ORDER_STATUS_SELECT);
            $form->text('order_user');
            $form->text('order_rv_model_id');
            $form->display('order_rv_amount_info');
            $form->text('order_one_night_rental');
            $form->text('order_total_rental');
            $form->text('order_night_count');
            $form->text('order_get_date');
            $form->text('order_back_date');
            $form->text('order_bed_count');
            $form->text('order_rv_vehicle');
            $form->text('order_rv_vehicle_payment');
            $form->text('order_rv_vehicle_payment_status');
            $form->display('order_accessory_info');
            $form->display('order_mileage_plan_info');
            $form->text('order_pay_way');
            $form->text('order_remit');
            $form->text('order_client_note');
            $form->text('order_company_note');
            $form->display('order_other_driver_info');
            $form->text('order_other_driving_licence');

            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isEditing()) {
                    $id = $form->getKey();
                    $user = User::find($id);
                    $form->confirm('注意！', '您確定要提交吗？');
                    switch ($form->order_status) {
                        case Order::ORDER_STATUS['os1']:
                            $order_success_email = RentOrderInfoController::sendOrderSuccessEmail($user->email);
                            if (empty($order_success_email)) {
                                $form->response()->success('已更新狀態，並發信通知會員')->refresh();
                            } else {
                                return $form->response()->error('服务器出错了~')->refresh();
                            }
                            break;
                        case Order::ORDER_STATUS['os6']:
                            $cancel_email = RentOrderInfoController::sendOrderCancelEmail($user->email);
                            if (empty($cancel_email)) {
                                $form->response()->success('已更新狀態，並發信通知會員')->refresh();
                            } else {
                                return $form->response()->error('服务器出错了~')->refresh();
                            }
                            break;
                        case Order::ORDER_STATUS['os10']:
                            $verify_fail = RentOrderInfoController::sendOrderVerifyFailEmail($user->email);

                            if (empty($verify_fail)) {
                                $form->response()->success('已更新狀態，並發信通知會員')->refresh();
                            } else {
                                return $form->response()->error('服务器出错了~')->refresh();
                            }
                            break;
                    }
                }

                // 中断后续逻辑
                // return $form->response()->error('服务器出错了~');
            });
        });
    }

    public static function sendOrderVerifyFailEmail($mail)
    {

        $title = '訂單驗證失敗';

        $details = '您好，您的訂單驗證失敗，請於48小時內與客服聯絡';

        $verify_fail = Mail::to($mail)->send(new OrderServicesMail($title, $details));

        return $verify_fail;
    }

    public static function sendOrderCancelEmail($mail) {
        $title = '訂單取消';

        $details = '您好，您的訂單已由系統取消，有任何問題請洽客服人員。';

        $cancel_email = Mail::to($mail)->send(new OrderServicesMail($title, $details));

        return $cancel_email;
    }

    public static function sendOrderSuccessEmail($mail) {
        $title = '訂單驗證通過，已成立';

        $details = '恭喜！您的訂單成立且已通過驗證，祝您有個美好的旅程，有任何問題請洽客服人員。';

        $cancel_email = Mail::to($mail)->send(new OrderServicesMail($title, $details));

        return $cancel_email;
    }
}
