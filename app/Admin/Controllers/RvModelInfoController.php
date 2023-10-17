<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RvModelInfo;
use Dcat\Admin\Form;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\RvAttachmentInfo as RvAttachment;
use App\Models\RvSeriesInfo as RvSeries;
use App\Models\RvVehicleInfo as RvVehicle;
use Carbon\Carbon;

class RvModelInfoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RvModelInfo(), function (Grid $grid) {
            $grid->disableFilterButton();
            $grid->showColumnSelector();
            // 显示快捷编辑按钮
            $grid->showQuickEditButton();
            $grid->column('id')->sortable();
            $grid->column('rv_name');
            $grid->column('rv_front_cover')->image();
            $grid->column('rv_series_id')->display(function ($rvSeriesId) {
                $result = RvSeries::where('id', $rvSeriesId)->get();
                return $result[0]->rv_series_name;
            });
            $grid->column('attachment_id')->display(function ($rvAttachment) {
                $result = array();
                foreach ($rvAttachment as $key => $value) {
                    $info = RvAttachment::where('id', $value)->first();
                    $result[] = $info->attachment_name;
                }

                return $result;
            })->label('success');
            $grid->column('rv_rent_setting')->hide();
            $grid->column('stock');
            $grid->column('in_stock');
            $grid->column('bed_count');
            $grid->column('base_price');
            $grid->column('rv_discription')->display(function ($rvDiscription) {
                return $rvDiscription;
            })->hide();
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
        return Show::make($id, new RvModelInfo(), function (Show $show) {
            $show->panel()
                ->tools(function ($tools) {
                    // $tools->disableEdit();
                    // $tools->disableList();
                    // $tools->disableDelete();
                    // 显示快捷编辑按钮
                    $tools->showQuickEdit();
                });
            $show->field('id');
            $show->field('rv_name');
            $show->field('rv_front_cover')->image();
            $show->field('rv_series_id')->as(function ($rvSeriesId) {
                $result = RvSeries::where('id', $rvSeriesId)->get();
                return $result[0]->rv_series_name;
            });
            $show->field('attachment_id')->as(function ($rvAttachment) {
                $result = array();
                foreach ($rvAttachment as $key => $value) {
                    $info = RvAttachment::where('id', $value)->first();
                    $result[] = $info->attachment_name;
                }

                return $result;
            })->label('success');
            // $show->field('rv_rent_setting');
            $show->field('stock');
            $show->field('in_stock');
            $show->field('bed_count');
            $show->field('base_price');
            $show->field('rv_discription')->unescape()->as(function ($content) {
                return $content;
            });
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
        return Form::make(new RvModelInfo(), function (Form $form) {


            $form->tab('基本設定', function (Form $form) {
                $form->display('id');
                $form->text('rv_name')->required();
                $form->image('rv_front_cover')->move('images/rv/' . date('Ym') . '/frontCover')->uniqueName()->maxSize(1024)->rules('mimes:jpg,jpeg,png,gif')->required();
                $form->select('rv_series_id')->options(RvSeries::pluck('rv_series_name', 'id'))->required();

                $form->checkbox('attachment_id')->options(RvAttachment::orderBy('order')->pluck('attachment_name', 'id'))->canCheckAll();

                if ($form->isCreating()) {
                    $val_status = 0;
                    $in_val_status = 0;
                } else {
                    $val_status = $form->model()->stock;
                    $in_val_status = $form->model()->in_stock;
                }
                $form->display('stock')->value($val_status);
                $form->display('in_stock')->value($in_val_status);
                $form->number('bed_count');
                $form->currency('base_price')->symbol('$');

                $form->editor('rv_discription')->options(['menubar' => false, 'toolbar' => ['code undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent | \
            styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | \
            table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen | bdmap indent2em lineheight formatpainter axupimgs']])->imageDirectory('editor/images');

                $form->display('created_at');
                $form->display('updated_at');
            })->tab('租金設定', function (Form $form) {

                $form->array('rv_rent_setting', function ($form) {
                    $form->fieldset('方案', function (NestedForm $form) {
                        $form->select('week', __('起始星期'))->options([0 => '星期日', 1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六']);
                        $form->time('get', __('取車時間'))->format('HH:00');
                        $form->time('back', __('還車時間'))->format('HH:00');
                        $form->number('day', __('可租天數(夜)'));
                        $form->currency('rental', __('租金費率/天(夜)'))->symbol('$');
                        $form->currency('overtime', __('超租加收/天(夜)'))->symbol('$');
                        $form->table('other_price', __('其他收費'), function ($table) {
                            $table->text('item', __('項目'));
                            $table->currency('price', __('價格'))->symbol('$');
                            $table->select('type', __('計算方式'))->options(['night' => '天', 'times' => '次'])->default('night');
                        })->rules('required', ['required' => '其他收費不可為空'])->saving(function ($v) {
                            return json_encode($v);
                        });
                        $form->currency('milage', __('里程數/夜'))->symbol('km');
                        $form->text('note', __('備註'));
                        // $form->switch('plan', __(''));
                        $form->radio('plan', __('設為方案'))
                            ->options([1 => '是', 0 => '否'])
                            ->default(0)
                            ->when(1, function (NestedForm $form) {
                                $form->text('plan_title', __('方案名稱'));
                            });
                    })->collapsed();


                })->saveAsJson();
            })->tab('特殊日期租金設定', function(Form $form) {

                $form->array('rv_rent_special_setting', function ($form) {

                    $form->column(10, function (NestedForm $form) {
                        $form->text('title', __('標題'))->rules('required', ['required' => '特殊租金設定- 標題 不可為空']);
                        $form->fieldset('方案', function ($form) {
                            $form->dateRange('start', 'end', __('日期區間'))->rules('required', ['required' => '特殊租金設定- 日期區間 不可為空']);
                            $form->time('get', __('取車時間'))->format('HH:00')->rules('required', ['required' => '特殊租金設定- 取車時間 不可為空']);
                            $form->time('back', __('還車時間'))->format('HH:00')->rules('required', ['required' => '特殊租金設定- 還車時間 不可為空']);
                            $form->currency('rental', __('租金費率/天(夜)'))->symbol('$')->rules('min:1', ['min' => '特殊租金設定- 租金費率/天(夜) 不可為0']);
                            $form->currency('overtime', __('超租加收/天(夜)'))->symbol('$')->rules('min:1', ['min' => '特殊租金設定- 超租加收/天(夜) 不可為0']);
                            $form->table('other_price', __('其他收費'), function ($table) {
                                $table->text('item', __('項目'));
                                $table->currency('price', __('價格'))->symbol('$');
                                $table->select('type', __('計算方式'))->options(['night' => '天', 'times' => '次'])->default('night');
                            })->rules('required', ['required' => '特殊租金設定- 其他收費 不可為空'])->saving(function ($v) {
                                return json_encode($v);
                            });
                            $form->currency('milage', __('里程數/夜'))->symbol('km');
                            $form->text('note', __('備註'));
                            // $form->number('favorable_day', __('優惠適用前後天數(夜)'))->attribute('min', 0);
                            // $form->currency('favorable_amount', __('優惠適用折扣'))->symbol('$')->default(0)->value(0.00);
                            // $form->table('item_day_rental', __('專案適用天數'), function ($table) {
                            //     $table->text('item_name', __('項目'));
                            //     $table->number('item_days', __('天數'))->attribute('min', 0);
                            //     $table->currency('item_price', __('租金'))->symbol('$')->rules('min:1', ['min' => '租金 不可為0']);
                            // })->rules('required', ['required' => '專案適用天數不可為空'])->saving(function ($v) {
                            //     return json_encode($v);
                            // });

                        })->collapsed();
                    });

                })->saving(function ($v) {
                    $a = [];
                    foreach ($v as $k => $r) {
                        $r['id'] = Carbon::now()->getTimestamp() . $k . mt_rand(1000,9999);
                        array_push($a, $r);
                    }
                    return json_encode($a);
                });

            });

            // $form->saving(function (Form $form) {
            //     $special_settings = $form->input('rv_rent_special_setting');
            //     if (empty($special_settings) || $special_settings == null) {
            //         // return $form->response()->error('特殊租金設定不可為空');
            //         $form->input('rv_rent_special_setting', null);
            //     }
            // });

            $form->deleting(function (Form $form) {
                $data = $form->model()->toArray();

                $countRvVehicle = RvVehicle::where('model_id', $data[0]['id'])->get();
                if (count($countRvVehicle) != 0) {
                    return $form->response()->error('数据受保護，不可刪除，删除失败');
                }
            });
        });
    }
}
