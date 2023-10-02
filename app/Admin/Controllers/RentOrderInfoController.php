<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Order\BatchRestore;
use App\Admin\Actions\Order\OrderDeleteMuti;
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
use Carbon\Carbon;

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
            Order::setDataReconciliation();

            // $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->disableViewButton();
            $grid->disableCreateButton();
            // $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->column('id')->sortable();
            $grid->column('order_num')->sortable();
            $grid->column('order_status')->sortable(); // ->select(Order::ORDER_STATUS_SELECT, true)
            $grid->column('order_user')->display(function ($user_num) {
                $check = '';
                $user = User::where('customer_id', $user_num)->first();
                if ((bool)$user->driving_licence_certified) {
                    $check = '<span class="text-success"><i class="fa fa-circle"></i></span> ' . '<a href="' . url("admin/customer?_search_=" . $user_num . "") . '" >' . $user_num . '</a>';
                } else {
                    $check = '<span class="text-danger"><i class="fa fa-circle"></i></span> ' . '<a href="' . url("admin/customer?_search_=" . $user_num . "") . '" >' . $user_num . '</a>';
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

            // $grid->disableActions();

            $grid->quickSearch(['order_num', 'order_user', 'order_get_date', 'order_back_date', 'order_rv_vehicle']);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('order_num', '訂單編號');
                $filter->like('order_user', '會員編號');
                // $filter->equal('order_rv_model_id', '車型');
                $filter->date('created_at', '訂單建立日');
                $filter->like('order_rv_vehicle', '車牌號碼');
                $filter->scope('trashed', '回收站')->onlyTrashed();
            });

            $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
                // if (request('_scope_') == 'trashed') {
                //     $batch->add(new BatchRestore(Order::class));
                // }
                $batch->add(new OrderDeleteMuti());
            });
            $grid->disableBatchDelete();

            $grid->export();

            $titles = [
                'id' => 'ID', 'order_num' => '訂單編號', 'order_status' => '狀態', 'order_user' => '會員編號', 'order_rv_model_id' => '車型', 'order_amount_001' => '保險費', 'order_amount_002' => '清潔費及電瓶維護費', 'order_rv_amount_info' => '其他費用細項', 'order_one_night_rental' => '租金單價',
                'order_total_rental' => '總租金', 'order_night_count' => '天數(晚)', 'order_get_date' => '取車日', 'order_back_date' => '還車日', 'order_bed_count' => '床數', 'order_rv_vehicle' => '分配車輛', 'order_accessory_info' => '額外配備租借資訊',
                'order_mileage_plan' => '里程加購方案', 'order_mileage_plan_amount' => '里程加購方案價格', 'order_pay_way' => '付款方式', 'order_client_note' => '客戶備註', 'order_company_note' => '備註', 'order_other_driver_info' => '駕駛人資訊', 'created_at' => '訂單建立日'
            ];
            $grid->export($titles)->rows(function ($rows) {
                foreach ($rows as $index => $row) {
                    $row['id'] = $index;
                    $row['order_rv_model_id'] = (RvModelInfo::find($row['order_rv_model_id']))->rv_name;
                    $ami3 = "";
                    foreach ((json_decode($row['order_rv_amount_info']))->other_value_other_price as $v) {
                        if (preg_match("/保險/i", $v->item)) {
                            $ami1 = (int)$v->price;
                        } else if (preg_match("/清潔/i", $v->item)) {
                            $ami2 = (int)$v->price;
                        }

                        $ami3 .= $v->item . " : " . (int)$v->price . "\r\n";
                    }
                    $row['order_amount_001'] = $ami1;
                    $row['order_amount_002'] = $ami2;
                    $row['order_rv_amount_info'] = $ami3;

                    if ($row['order_accessory_info'] != null) {
                        $acci = "";
                        foreach (json_decode($row['order_accessory_info']) as $key => $value) {
                            $acci .= $value->equipment_name . " : " . (int)$value->equipment_total_amount . " / " . $value->equipment_count . "組\t\n";
                        }
                        $row['order_accessory_info'] = $acci;
                    } else {
                        $row['order_accessory_info'] = '無額外配備租賃資訊';
                    }

                    $plan_info = json_decode($row['order_mileage_plan_info']);
                    $row['order_mileage_plan'] = $plan_info->plan_key;
                    $row['order_mileage_plan_amount'] = $plan_info->plan_value;

                    if ($row['order_pay_way'] == 'remit') {
                        $row['order_pay_way'] = '匯款';
                    } else {
                        $row['order_pay_way'] = '信用卡';
                    }

                    $info = json_decode($row['order_other_driver_info']);
                    $row['order_other_driver_info'] = "駕駛人：" . $info->dr_name . "\t\n" .
                        "駕駛人信箱：" . $info->dr_email . "\t\n" .
                        "駕駛人聯絡電話：" . $info->dr_phone . "\t\n" .
                        "駕駛人身分證字號：" . $info->dr_IDNumber . "\t\n";
                }

                return $rows;
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
            $form->display('order_num');
            $form->select('order_status')->options(Order::ORDER_STATUS_SELECT);
            $form->display('order_user');
            $form->display('order_rv_model_id');
            $form->display('order_rv_amount_info');
            $form->text('order_one_night_rental');
            $form->text('order_total_rental');
            $form->number('order_night_count');
            $form->date('order_get_date')->format('YYYY-MM-DD');
            $form->date('order_back_date')->format('YYYY-MM-DD');
            $form->number('order_bed_count');
            $form->text('order_rv_vehicle');
            $form->text('order_rv_vehicle_payment');
            $form->text('order_rv_vehicle_payment_status');
            $form->display('order_accessory_info');
            $form->display('order_mileage_plan_info');
            $form->text('order_pay_way');
            $form->display('order_remit');
            $form->textarea('order_client_note');
            $form->textarea('order_company_note');
            $form->display('order_other_driver_info');
            $form->display('order_other_driving_licence');

            $form->display('created_at');
            $form->display('updated_at');
            $form->confirm('注意！', '您確定要提交吗？');

            $form->saving(function (Form $form) {
                if ($form->isEditing()) {
                    if ($form->order_status == "") {
                        $id = $form->getKey();
                        $or = Order::find($id);
                        $form->order_status = $or->order_status;
                    }
                }

                return;
            });
            $id = $form->getKey();
            if ($form->isEditing()) {
                $ors = Order::withTrashed()->findOrFail($id);
            } else {
                $ors = Order::find($id);
            }
            $lastOrderStatus = $ors->order_status;
            $form->saved(function (Form $form) use($lastOrderStatus) {
                // 判断是否是新增操作
                if ($form->isEditing()) {
                    $id = $form->getKey();
                    $odr = Order::find($id);
                    $user = User::where('customer_id', $odr->order_user)->first();
                    if ($form->order_status != $lastOrderStatus) {
                        switch ($form->order_status) {
                            case Order::ORDER_STATUS['os1']:
                                $order_success_email = RentOrderInfoController::sendOrderSuccessEmail($user->email, $id);
                                if (empty($order_success_email)) {
                                    return $form->response()->success('已更新狀態，並發信通知會員')->redirect('rv_order');
                                } else {
                                    return $form->response()->error('服务器出错了~')->redirect('rv_order');
                                }
                                break;
                            case Order::ORDER_STATUS['os5']:
                                $expired_email = RentOrderInfoController::sendOrderPaidExpiredEmail($user->email, $id);
                                if (empty($expired_email)) {
                                    return $form->response()->success('已更新狀態，並發信通知會員')->redirect('rv_order');
                                } else {
                                    return $form->response()->error('服务器出错了~')->redirect('rv_order');
                                }
                                break;
                            case Order::ORDER_STATUS['os6']:
                                $order = Order::find($id);
                                $order->delete();

                                $cancel_email = RentOrderInfoController::sendOrderCancelEmail($user->email, $id);
                                if (empty($cancel_email)) {
                                    return $form->response()->success('已更新狀態，並發信通知會員')->redirect('rv_order');
                                } else {
                                    return $form->response()->error('服务器出错了~')->redirect('rv_order');
                                }
                                break;
                            case Order::ORDER_STATUS['os9']:
                                $today = Carbon::today();
                                $back_date = Carbon::parse($form->order_back_date);
                                if ($today >= $back_date) {
                                    $finish_mail = RentOrderInfoController::sendOrderFinishedEmail($user->email, $id);

                                    if ($finish_mail) {
                                        return $form->response()->success('已更新狀態，並發信通知會員')->redirect('rv_order');
                                    } else {
                                        return $form->response()->error('服务器出错了~')->redirect('rv_order');
                                    }
                                } else {
                                    $odr->order_status = $lastOrderStatus;
                                    $odr->save();
                                    return $form->response()->error('訂單未達還車日~')->redirect('rv_order');
                                }
                                break;
                            case Order::ORDER_STATUS['os10']:
                                $verify_fail = RentOrderInfoController::sendOrderVerifyFailEmail($user->email, $id);

                                if (empty($verify_fail)) {
                                    return $form->response()->success('已更新狀態，並發信通知會員')->redirect('rv_order');
                                } else {
                                    return $form->response()->error('服务器出错了~')->redirect('rv_order');
                                }
                                break;
                        }
                    }
                }

                return;
            });

            // $form->deleted(function (Form $form) {

            //     $backlog = Order::setDataReconciliation();

            //     if (!$backlog) {
            //         return $form->response()->error('服务器出错了~ 訂單刪除失敗～')->redirect('rv_order');
            //     }

            //     return;
            // });
        });
    }

    public static function sendOrderVerifyFailEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單驗證失敗';

        $details = '您好，您的訂單驗證失敗，請於48小時內與客服人員聯絡';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $verify_fail = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $verify_fail;
    }

    public static function sendOrderCancelEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單取消';

        $details = '親愛的客戶您好，訂單編號：' . $order->order_num . '<br>您的訂單已由系統取消，有任何問題請洽客服人員。';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $cancel_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $cancel_email;
    }

    public static function sendOrderSuccessEmail($mail, $id)
    {

        $order = Order::find($id);
        $order_rv_amount_info = json_decode($order->order_rv_amount_info);

        $get = Carbon::parse($order->order_get_date . ' ' . $order_rv_amount_info->other_value_get_time);
        $get_year = $get->year;
        $get_month = $get->month;
        $get_day = $get->day;
        $get_hour = $get->hour;
        $get_minute = $get->minute;

        $back = Carbon::parse($order->order_back_date . ' ' . $order_rv_amount_info->other_value_back_time);
        $back_year = $back->year;
        $back_month = $back->month;
        $back_day = $back->day;
        $back_hour = $back->hour;
        $back_minute = $back->minute;

        $title = '訂單驗證通過，已成立';

        // $details = '恭喜！您的訂單成立且已通過驗證，祝您有個美好的旅程，有任何問題請洽客服人員。';
        // $details = '親愛的客戶您好，恭喜您訂單完成資料也已認證確認 👍 請於幾月幾號幾點前來取車並於x月x號幾點前完成還車喔 現場取車時再用信用卡授權並支付尾款xxxx元 謝謝您。';
        $details = '親愛的客戶您好，訂單編號：' . $order->order_num . '<br>恭喜您訂單完成資料也已認證確認 👍 <br>請於' . $get_year . '年' . $get_month . '月' . $get_day . '號' . $get_hour . '點前來取車<br>並於' . $back_year . '年' . $back_month . '月' . $back_day . '號' . $back_hour . '點前完成還車喔 <br><br>現場取車時再用信用卡授權並支付尾款 $' . (Int) ($order->order_total_rental/2) . '元 謝謝您。';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $success_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $success_email;
    }

    public static function sendOrderPendingPaymentEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單已成功送出';

        $details = '貼心小提醒!<br>親愛的客戶您好，訂單編號：' . $order->order_num . '<br>您的露營車預定就差最後一個付款動作喔，有任何問題請洽客服人員。';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $pending_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $pending_email;
    }

    public static function sendOrderCreditCardPayFailEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單已成立，付款失敗';

        $details = '親愛的客戶您好，訂單編號：' . $order->order_num . '<br>您的露營車預定信用卡付款失敗，有任何問題請洽客服人員。';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $fail_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $fail_email;
    }

    public static function sendOrderPaidExpiredEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單未成立，逾期付款';

        $details = '親愛的客戶您好，訂單編號：' . $order->order_num . '<br>您的露營車預定逾期付款，訂單已由系統取消，如仍需預訂請重新預定，有任何問題請洽客服人員。';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $expired_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $expired_email;
    }

    public static function sendOrderFinishedEmail($mail, $id)
    {
        $order = Order::find($id);

        $title = '訂單已結束';

        $details = '親愛的客戶您好，訂單編號：' . $order->order_num . '<br>本次的旅程已結束，您的露營車已歸還成功，有任何問題請洽客服人員。<br>祝您順心～';

        $bcc_mail = ['oma@o-ma.com.tw', 'ela@o-ma.com.tw', 'simon@o-ma.com.tw', 'gary.tsai@o-ma.com.tw', 'brown@o-ma.com.tw'];
        $cancel_email = Mail::to($mail)->bcc($bcc_mail)->send(new OrderServicesMail($title, $details));

        return $cancel_email;
    }
}
