<section class="bg-step-bar">
    <div class="container">
        <div class="row justify-content-center align-content-center px-md-5 px-3 pt-5 pb-md-5 pb-4">
            <div class="col-md-3">
                <div class="step-box d-flex justify-content-md-center align-items-center
                {{ request()->is('car_rent') ? 'step-box-active' : 'step-box-default' }}
                {{ request()->is('car_rent_s2*') ? 'step-box-pass' : 'step-box-default' }}
                {{ request()->is('car_rent_s3*') ? 'step-box-pass' : 'step-box-default' }}
                {{ request()->is('car_rent_s4*') ? 'step-box-pass' : 'step-box-default' }}
                {{ request()->is('car_rent_s5*') ? 'step-box-pass' : 'step-box-default' }} ">
                    <span class="step-num mr-3">1</span>
                    <p class="step-txt my-auto">選擇您的露營車</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box d-flex justify-content-md-center align-items-center
                {{ request()->is('car_rent_s2*') ? 'step-box-active' : 'step-box-default' }}
                {{ request()->is('car_rent_s3*') ? 'step-box-pass' : 'step-box-default' }}
                {{ request()->is('car_rent_s4*') ? 'step-box-pass' : 'step-box-default' }}
                {{ request()->is('car_rent_s5*') ? 'step-box-pass' : 'step-box-default' }} ">
                    <span class="step-num mr-3">2</span>
                    <p class="step-txt my-auto">選擇加購方案</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box d-flex justify-content-md-center align-items-center
                {{ request()->is('car_rent_s3*') ? 'step-box-active' : 'step-box-default' }}
                {{ request()->is('car_rent_s4*') ? 'step-box-active' : 'step-box-default' }}
                {{ request()->is('car_rent_s5*') ? 'step-box-pass' : 'step-box-default' }}">
                    <span class="step-num mr-3">3</span>
                    <p class="step-txt my-auto">提交付款</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-box d-flex justify-content-md-center align-items-center
                {{ request()->is('car_rent_s5*') ? 'step-box-active' : 'step-box-default' }} ">
                    <span class="step-num mr-3">4</span>
                    <p class="step-txt my-auto">預訂成功</p>
                </div>
            </div>
        </div>
    </div>
</section>
