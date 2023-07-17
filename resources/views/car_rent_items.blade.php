@foreach ($rvModelInfo as $model)
    <div class="row rv_item_box rounded mb-3 position-relative p-0 m-0 w-100" style="border: 1px solid #e0e0e0;">
        <div class="col-md-4">
            <div class="item-img mt-3">
                <img src="{{ $model->rv_front_cover != null ? env('APP_URL') . '/uploads/' . $model->rv_front_cover : asset('assets/img/icon/rv-icon/1.png') }}"
                    class="img-fluid" alt="9otravel">
                <h4 class="text-center mt-3">{{ $model->rv_name }}</h4>
            </div>
        </div>
        <div class="col-md-8 align-self-center py-3">
            <div class="row g-0 w-75 mx-auto" style="width: 80% !important;">
                @foreach ($attachmentInfo->attachments[$model->id]->attach as $item)
                    <div class="col-md-4 col-6 my-2 d-flex align-items-center" style="color: #f7c000">
                        <img src="{{ env('APP_URL') . '/uploads/' . $item->attachment_icon }}"
                            class="img_fluid mr-3" width="36" alt="{{ __('') }}">
                        <span>{{ $item->attachment_name }}</span>
                    </div>
                @endforeach
                {{-- <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                            <span><i class="fa-solid fa-fire"></i> 自排</span>
                                        </div> --}}
            </div>

        </div>

        <div class="rent-count-icon">
            <i class="rent-count-container"></i>
            <p class="text-center">
                <span class="d-block">租車次數</span>
                <span class="d-block"><i class="fa-solid fa-caravan"></i> {{ $model->stock }}</span>
            </p>
        </div>

        <div class="rent-action px-md-0 px-2 py-md-0 py-3">
            <div class="row justify-content-end p-0 m-0">
                <p class="mx-2">床位數：  <span  style="color: #f7c000">{{ $model->bed_count }}</span>  人</p>，
                <p class="ml-2">Strating at &nbsp;<span style="color: #f7c000">${{ $model->base_price }} / night</span></p>
                <div class="col-12 justify-content-end d-flex p-0">
                    <a href="javascript:void(0)" class="btn btn-primary3 ml-2 models-select" onclick="modelsSelect('{{ route('car_rent_s2', ['rvm_id' => $model->id]) }}')"><i
                            class="fa-solid fa-cart-shopping"></i> 選擇</a>
                    <a href="{{ route('Rv_Detail', ['id' => $model->id]) }}" class="btn btn-primary3 ml-2 text-uppercase">learn more</a>
                </div>
            </div>
        </div>

    </div>
@endforeach
