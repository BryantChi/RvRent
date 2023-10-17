@foreach ($sp_filter ?? [] as $key => $sp)
    @foreach ($sp ?? [] as $item)
    <div class="col-lg-42 col-md-62 col-12 mb-4 pt-2 sp-item-box">
        <a href="javascript:void(0)" onclick="modelsSelect('{{ route('car_rent_s2', ['rvm_id' => $key, 'spid' => $item['id']]) }}', 'sp')">
            <div class="card blog-post border-0 shadow-md rounded" style="border: 1px solid #f7c000 !important;">
                <div class="card-body p-0">
                    {{-- <img src="images/illu/2.svg" class="img-fluid" alt=""> --}}

                    <div class="content px-4 py-4">
                        <p class="title text-dark h5">{{ $sp_models[$key]->rv_name }} - <br>{{ $item['title'] }}</p>
                        <p class="text-muted mt-3">{{ $item['start'] }} ～ {{ $item['end'] }}</p>
                        <p class="text-muted text-right mt-3">{{ $sp_models[$key]->bed_count }}床位</p>

                        <ul class="list-unstyled d-flex justify-content-between align-items-center border-top mt-3 pt-3 mb-0">
                            <li class="text-muted"><a href="javascript:void(0)" class="btn btn-primary3" onclick="modelsSelect('{{ route('car_rent_s2', ['rvm_id' => $key, 'spid' => $item['id']]) }}', 'sp')">選擇 <i data-feather="arrow-right" class="fea icon-sm"></i></a></li>
                            <li class="text-muted ml-auto"><i data-feather="dollar-sign" class="fea icon-sm text-primary"></i> $ {{ (Int) $item['rental'] }} / 夜</li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
@endforeach
