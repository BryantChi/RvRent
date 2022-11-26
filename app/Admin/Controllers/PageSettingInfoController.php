<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\PageSettingInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PageSettingInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PageSettingInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('page_url');
            $grid->column('page_title');
            $grid->column('page_banner_img')->image()->hide();
            $grid->column('page_banner_img_mob')->image()->hide();
            $grid->column('page_meta_description');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            $grid->disableDeleteButton();
            $grid->disableCreateButton();
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
        return Show::make($id, new PageSettingInfo(), function (Show $show) {
            $show->field('id');
            $show->field('page_url');
            $show->field('page_title');
            $show->field('page_banner_img')->image();
            $show->field('page_banner_img_mob')->image();
            $show->field('page_meta_description');
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
        return Form::make(new PageSettingInfo(), function (Form $form) {
            $form->display('id');
            $form->display('page_url', __('page-setting-info.fields.page_url'));
            $form->text('page_title', __('page-setting-info.fields.page_title'));
            $form->multipleImage('page_banner_img', __('page-setting-info.fields.page_banner_img'))->move('images/banner/'.date('Ym'))->maxSize(3072)->rules('mimes:jpg,jpeg,png,gif|nullable')->sortable();//->uniqueName()
            $form->multipleImage('page_banner_img_mob', __('page-setting-info.fields.page_banner_img_mob'))->move('images/banner_mob/'.date('Ym'))->maxSize(3072)->rules('mimes:jpg,jpeg,png,gif|nullable')->sortable();
            $form->textarea('page_meta_description', __('page-setting-info.fields.page_meta_description'))->rows(10);

            $form->display('created_at', __('admin.created_at'));
            $form->display('updated_at', __('admin.updated_at'));

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                // $tools->disableView();
                // $tools->disableList();
           });
        });
    }
}
