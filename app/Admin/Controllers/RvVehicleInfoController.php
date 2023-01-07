<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvVehicleInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\RvModelInfo as RvModel;
use App\Models\RvVehicleInfo as RvVehicle;

class RvVehicleInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvVehicleInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('vehicle_num');
            $grid->column('model_id');
            $grid->column('vehicle_status');
            // $grid->column('rent_status');
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
        return Show::make($id, new RvVehicleInfo(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();
                });
            $show->field('id');
            $show->field('vehicle_num');
            $show->field('model_id');
            $show->field('vehicle_status');
            // $show->field('rent_status');
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
        return Form::make(new RvVehicleInfo(), function (Form $form) {
            $form->display('id');
            $form->text('vehicle_num');
            if ($form->isCreating()) {
                $form->select('model_id')->options(RvModel::pluck('rv_name', 'id'))->required();
            } else {
                $form->display('model_id');
            }

            $form->radio('vehicle_status')->options(['rent_stay' => '可出租', 'rent_stop' => '暫停出租', 'rent_out' => '已出租', 'rent_back' => '已回車', 'rent_fix' => '維護中'])->default('rent_stay');
            // $form->switch('rent_status');

            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form) {
                if ($form->isEditing()) {
                    $rvModel = RvModel::find($form->model_id);
                    $rvVehicle = RvVehicle::find($form->getKey());
                    $lastStatus = $rvVehicle->vehicle_status;
                    switch ($form->vehicle_status) {
                        case 'rent_stay':
                        case 'rent_back':
                            if ($lastStatus == 'rent_stop' || $lastStatus == 'rent_out' || $lastStatus == 'rent_fix') {
                                $rvModel->stock += 1;
                                $rvModel->save();
                            }
                            break;
                        case 'rent_stop':
                        case 'rent_out':
                        case 'rent_fix':
                            if ($rvModel->stock > 0) {
                                if ($lastStatus == 'rent_stay' || $lastStatus == 'rent_back') {
                                    $rvModel->stock -= 1;
                                    $rvModel->save();
                                }
                            }
                            break;
                        default:
                            break;
                    }
                    return;
                }
            });

            $form->saved(function (Form $form, $result) {
                // 修改用户提交的数据
                // $form->author_id = 1;

                // 删除、忽略用户提交的数据
                // $form->deleteInput('');
                $rvModel = RvModel::find($form->model_id);
                if ($form->isCreating()) {
                    if ($result) {
                        switch ($form->vehicle_status) {
                            case 'rent_stay':
                            case 'rent_back':
                                $rvModel->stock += 1;
                                $rvModel->save();
                                break;
                            case 'rent_stop':
                            case 'rent_out':
                            case 'rent_fix':
                                if ($rvModel->stock > 0) {
                                    $rvModel->stock -= 1;
                                    $rvModel->save();
                                }
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                    return;
                }
            });

            $form->deleted(function (Form $form, $result) {
                $data = $form->model()->toArray();
                if ($result) {
                    $rvModel = RvModel::find($data[0]['model_id']);
                    if ($rvModel->stock > 0) {
                        $rvModel->stock -= 1;
                        $rvModel->save();
                    }
                }
            });
        });
    }
}
