<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvSeriesInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Widgets\Modal;
use App\Models\RvModelInfo as RvModel;

class RvSeriesInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvSeriesInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('rv_series_name');
            $grid->column('rv_series_file')->display(function ($photo) {
                if ($photo == null || $photo == '') {
                    $iframe = '<h3 class="text-center" >未上傳契約書</h3>';
                } else {
                    $iframe = '<iframe src="http://9o-traveller.com.tw/uploads/' . $photo .'" width="100%" style="height: 100vh;" seamless scrolling="yes"></iframe>';
                }


                $modal = Modal::make()
                ->lg()->scrollable()->centered()
                ->title('預覽')
                ->body($iframe)
                ->button('<button class="btn btn-primary">查看</button>');
                 return $modal;
            });// 设置按钮名称
            // ->modal(function ($modal) {
            //     // 设置弹窗标题
            //     $modal->title('預覽');

            //     // 自定义图标
            //     // $modal->icon('feather icon-x');

            //     $card = new Card(null, $photo);

            //     return "<div style='padding:10px 10px 0'>$card</div>";
            // });

            // ->link(function ($value) {
            //     return env('APP_URL').'uploads/'.$value;
            // });

            $grid->column('rv_series_package')->display(function($packages) {
                $pg = json_decode($packages);
                $pgm = '';
                foreach ($pg as $key => $value) {
                    $pgm .= '<p class="">'.$key . ' : $' . $value . '</p>';
                }
                return $pgm;
            });

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
        return Show::make($id, new RvSeriesInfo(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();

            });
            $show->field('id');
            $show->field('rv_series_name');
            $show->field('rv_series_file')->file();
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
        return Form::make(new RvSeriesInfo(), function (Form $form) {
            $form->display('id');
            $form->text('rv_series_name');
            $form->file('rv_series_file')->move('images/rv/contract')->uniqueName()->maxSize(1024)->accept('pdf')->removable(false);

            $form->keyValue('rv_series_package')->default(['50公里內' => '1800', '100公里內' => '3000', '200公里內' => '5000'])->setKeyLabel('套餐公里')->setValueLabel('套餐價格')->required();

            $form->display('created_at');
            $form->display('updated_at');

            $form->deleting(function (Form $form) {
                $data = $form->model()->toArray();

                $countRvVehicle = RvModel::where('rv_series_id', $data[0]['id'])->get();
                if (count($countRvVehicle) != 0) {
                    return $form->response()->error('数据受保護，不可刪除，删除失败');
                }
            });
        });
    }
}
