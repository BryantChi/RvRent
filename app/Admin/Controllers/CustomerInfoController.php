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
            $grid->column('name')->sortable();
            $grid->column('nick_name')->sortable();
            $grid->column('IDNumber')->sortable();
            $grid->column('email')->sortable();
            $grid->column('email_verified_at')->sortable();
            $grid->column('password')->hide();
            $grid->column('country')->sortable();
            $grid->column('phone')->sortable();
            $grid->column('line_id')->sortable();
            $grid->column('gender')->sortable();
            $grid->column('birthday')->sortable();
            $grid->column('driving_licence')->image();
            $grid->column('driving_licence_certified')->switch()->sortable();
            // $grid->column('remember_token');
            $grid->column('created_at')->sortable();
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            $grid->disableDeleteButton();
            // $grid->disableCreateButton();
            // $grid->quickSearch();

            // // 设置表单提示值
            // $grid->quickSearch()->placeholder('搜索...');
            $grid->quickSearch(function ($model, $query) {
                $model->where('customer_id', $query);
                // ->orWhere('desc', 'like', "%{$query}%")
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
            $show->field('IDNumber');
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
            // $form->image('profile_photo')->move('images/user_profile/'.$customer_id)->uniqueName()->rules('mimes:jpg,jpeg,png,gif');
            $form->text('name')->required();
            $form->text('nick_name');
            $form->text('IDNumber')->required()->rules('regex:/^[A-Za-z][12]\d{8}$/');
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
            $form->image('driving_licence')->move('images/user_driving_licence/'.$customer_id)->uniqueName()->rules('mimes:jpg,jpeg,png,gif');
            $form->switch('driving_licence_certified');
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
