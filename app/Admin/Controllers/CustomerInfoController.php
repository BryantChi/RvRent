<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CustomerInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\User as Customer;
use Illuminate\Support\Facades\Hash;

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
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            // $grid->column('id')->sortable();
            $grid->column('customer_id')->sortable();
            $grid->column('name');
            $grid->column('nick_name');
            $grid->column('email');
            $grid->column('email_verified_at');
            $grid->column('password')->hide();
            $grid->column('country');
            $grid->column('phone');
            $grid->column('line_id');
            $grid->column('gender');
            $grid->column('birthday');
            $grid->column('driving_licence')->image();
            // $grid->column('remember_token');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            $grid->disableDeleteButton();
            // $grid->disableCreateButton();
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
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();

            });
            // $show->field('id');
            $show->field('customer_id');
            $show->field('name');
            $show->field('nick_name');
            $show->field('email');
            $show->field('email_verified_at');
            $show->field('password');
            $show->field('country');
            $show->field('phone');
            $show->field('line_id');
            $show->field('gender');
            $show->field('birthday');
            $show->field('driving_licence')->image();
            // $show->field('remember_token');
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
            // $form->display('id');
            $customer_id = 'C' . date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $infos = Customer::where('customer_id', '=', $customer_id)->get();
            if (count($infos) > 0) {
                $customer_id = 'C' . date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            }
            $form->hidden('customer_id')->value($customer_id);
            $form->text('name')->required();
            $form->text('nick_name');
            $form->email('email')->required();
            // $form->text('email_verified_at');
            if ($form->isCreating()) {
                $form->password('password')->required();
            } else {
                $form->password('password')->value($form->model()->password)->disable();
            }
            // $form->password('password_check', __('確認密碼'));
            $form->text('country')->default('台灣');
            $form->mobile('phone')->options(['mask' => '9999 999 999']);
            $form->text('line_id');
            $form->radio('gender')->options(['m' => '男', 'f'=> '女', 'n' => '不顯示'])->default('m');
            $form->date('birthday');
            $form->image('driving_licence')->move('images/user_driving_licence')->uniqueName()->rules('mimes:jpg,jpeg,png,gif');;
            // $form->text('remember_token');

            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form) {

                if ($form->isCreating()) {
                    $oldPwd = $form->password;
                    // 修改用户提交的数据
                    $form->password = Hash::make($oldPwd);
                }

            });

        });
    }
}
