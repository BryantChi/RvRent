<?php

namespace App\Admin\Actions\Order;

use App\Models\RentOrderInfo as Order;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderDeleteMuti extends BatchAction
{
    /**
     * @return string
     */
	protected $title = '刪除訂單';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // 获取选中的文章ID数组
        $keys = $this->getKey();

        // 获取请求参数
        // $action = $request->get('action');

        foreach (Order::find($keys) as $or) {
            $or->order_status = Order::ORDER_STATUS['os6'];
            $or->save();
            $or->delete();
        }

        $message = '訂單刪除成功';

        return $this->response()->success($message)->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['Confirm?', '您確定刪除訂單吗？'];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
        // 'action' => $this->action,
    }
}
