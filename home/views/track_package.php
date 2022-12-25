<!-- Breadcumb Area Start -->
<div class="breadcumb-area bg-img lazy-load" data-src="<?php echo IMAGE;?>breadcumb.jpg">
        <div class="bradcumbContent">
            <h2><?php D(__('track_package', 'Track Package')); ?></h2>
        </div>
    </div>
    <!-- Breadcumb Area End -->
<div class="clearfix"></div>
    <!-- Login Area Start -->
<div class="academy-courses-area section-padding-100">
    <div class="container" id="app">
        <!-- the content area start -->
        <div class="package-wrapper" v-if="active_tab=='track'">
            <h5 class="pl-2"><i aria-hidden="true" class="fa fa-search"></i> <?php D(__('track_package', 'Track Package')); ?></h5>
            <div class="row">
                <div class="col-sm-8 pr-0">
                    <input type="text" class="form-control input-sm" placeholder="Package Number" v-model="track_package_number">
                    <p v-if="track_package.error_msg != null" style="color:red">{{track_package.error_msg}}</p>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-site btn-block" @click="trackPackage" :disabled="processing"> 
                        <span v-if="processing">
                            <span v-html="loader"></span>
                        </span>
                        <span v-else>
                            <?php D(__('track', 'Track'));?>
                        </span>
                    </button>
                </div>
            </div>
            <div class="row" v-if="track_package.ID !== null">
            <div class="col-sm-12">
                <table class="table mt-3 white-bg rtl">
                    <tr>
                        <td colspan="2"><h5><?php D(__('package_detail', 'Package Detail')); ?></h5></td>
                    </tr>
                    <tr>
                        <th><?php D(__('package_number', 'Package Number')); ?></th>
                        <td class="text-right">{{track_package.package_number}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('customer_name', 'Customer Name')); ?></th>
                        <td class="text-right">{{track_package.customer_name}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('pickup_city', 'Pickup City')); ?></th>
                        <td class="text-right">{{track_package.pickup_city}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('destination_city', 'Destination City')); ?></th>
                        <td class="text-right">{{track_package.drop_city}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('added_date', 'Added Date')); ?></th>
                        <td class="text-right">{{track_package.added_date}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('price', 'Price')); ?> </th>
                        <td class="text-right">{{currency}}{{track_package.price}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('fee', 'Fee')); ?> </th>
                        <td class="text-right">{{currency}}{{track_package.fee}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('total_price', 'Total Price')); ?> </th>
                        <td class="text-right">
                            {{currency}}{{track_package.package_price_total > 0 ? track_package.package_price_total : (parseFloat(track_package.fee)+parseFloat(track_package.price))}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 50%"><?php D(__('pickup_information', 'Pickup Information')); ?> </th>
                        <td class="text-right"> {{track_package.pickup_info}}</td>
                    </tr>
                    <tr>
                        <th style="width: 50%"><?php D(__('drop_information', 'Drop Information')); ?></th>
                        <td class="text-right"> {{track_package.drop_info}}</td>
                    </tr>
                    <tr>
                        <th><?php D(__('current_status', 'Current Status')); ?></th>
                        <td class="text-right"> 
                        <span class="badge badge-pill badge-warning" v-if="track_package.package_status == 'pending'"><?php D(__('pending', 'Pending')); ?></span>
                        <span class="badge badge-pill badge-success" v-else-if="track_package.package_status == 'delivered'"><?php D(__('delivered', 'Delivered')); ?></span>
                        <span class="badge badge-pill badge-primary" v-else-if="track_package.package_status == 'proceeding'"><?php D(__('proceeding', 'Proceeding')); ?></span>
                        <span class="badge badge-pill badge-danger" v-else-if="track_package.package_status == 'rejected'"><?php D(__('rejected', 'Rejected')); ?></span>
                        <span class="badge badge-pill badge-info" v-else-if="track_package.package_status == 'stuck'"><?php D(__('stuck', 'Stuck')); ?></span>
                        <span class="badge badge-pill badge-secondary" v-else-if="track_package.package_status == 'money_delivered'"><?php D(__('money_delivered', 'Money delivered')); ?></span>
                        <span class="badge badge-pill badge-success" v-else-if="track_package.package_status == 'confirm'"><?php D(__('confirmed', 'Confirmed')); ?></span>
                        <span class="badge badge-pill badge-primary" v-else-if="track_package.package_status == 'backage_return'"><?php D(__('backage_return', 'Backage Return')); ?></span>
                        <span class="badge badge-pill badge-danger" v-else-if="track_package.package_status == 'reject_after_reach'"><?php D(__('reject_after_reach', 'Reject After Reach')); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <h6><?php D(__('tracking_history', 'Tracking History')); ?></h6>
                            <ul class="list-group mb-3">
                                <li class="list-group-item" v-for="(item, $index) in track_package.track_history" :key="$index">
                                    <div class="d-flex mb-3">
                                        <div>
                                            <p class="text-muted p-0 m-0"> <i class="fa fa-clock-o"></i> &nbsp;  {{item.date}}</p>
                                        </div>
                                        <div class="mr-auto">
                                            <span class="badge badge-pill badge-warning" v-if="item.package_status == 'pending'"><?php D(__('pending', 'Pending')); ?></span>
                                            <span class="badge badge-pill badge-success" v-else-if="item.package_status == 'delivered'"><?php D(__('delivered', 'Delivered')); ?></span>
                                            <span class="badge badge-pill badge-primary" v-else-if="item.package_status == 'proceeding'"><?php D(__('proceeding', 'Proceeding')); ?></span>
                                            <span class="badge badge-pill badge-danger" v-else-if="item.package_status == 'rejected'"><?php D(__('rejected', 'Rejected')); ?></span>
                                            <span class="badge badge-pill badge-info" v-else-if="item.package_status == 'stuck'"><?php D(__('stuck', 'Stuck')); ?></span>
                                            <span class="badge badge-pill badge-secondary" v-else-if="item.package_status == 'money_delivered'"><?php D(__('money_delivered', 'Money delivered')); ?></span>
                                            <span class="badge badge-pill badge-success" v-else-if="item.package_status == 'confirm'"><?php D(__('confirmed', 'Confirmed')); ?></span>
                                            <span class="badge badge-pill badge-primary" v-else-if="item.package_status == 'backage_return'"><?php D(__('backage_return', 'Backage Returned')); ?></span>
                                            <span class="badge badge-pill badge-danger" v-else-if="item.package_status == 'reject_after_reach'"><?php D(__('reject_after_reach', 'Reject After Reach')); ?></span>
                                        </div>
                                    </div>
                                    <p class="mb-0">{{item.note}}</p>
                                </li>
                            </ul>
                        </th>
                    </tr>
                </table>
            </div>
            </div>

        </div>
        <!-- the content area end -->
    </div>
</div>



<?php 
if(ENVIRONMENT != 'development'){
    load_js('vue.min.js');
}else{ ?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<?php } ?>

<script type="text/javascript">
App.addScript(function(){

    function getPackage(pkg_number){
        return new Promise(function(resolve, reject){
            $.ajax({
                url: '<?php echo base_url('get-package')?>',
                data: {package_number: pkg_number},
                type: 'POST',
                dataType: 'json',
                success: function(res){
                    resolve(res);
                }
            })
            .error(function(){
                reject();
            });
        });
    }

    
    function clearError(){
      $('.is-invalid').removeClass('is-invalid');
      $('.invalid-feedback').removeClass('.invalid-feedback').hide();
    }

    function showError(errors){
        for(var error_field in errors){
            $('#'+error_field).addClass('is-invalid');
            $('#'+error_field+'Error').html(' <i class="fa fa-exclamation-circle"></i> '+errors[error_field]).addClass('invalid-feedback').show();
        }
    }

  var app = new Vue({
      el: '#app',
      data: {   
            active_tab: 'track',
            track_package: {
                pickup_city: '',
                drop_city: '',
                customer_name: '',
                price: 0,
                fee: 0,
                package_price_total: 0,
                added_date: null,
                pickup_info: null,
                drop_info: null,
                ID: null,
                package_number: null,
                error_msg: null,
                package_status: null,
                note: null,
                track_history: [],
            },
            track_package_number: null,
            price_set: false,
            processing: false,
            loader: generateLoader(20),
            currency: '<?php echo CURRENCY; ?>',
      },
     
        computed: {
            packageTotal: function(){
                var package_total =  0;
                if(this.fee > 0 && this.package.price > 0){
                    package_total =  parseFloat(this.fee) + parseFloat(this.package.price);
                }

                return package_total;
            },
        },

      methods: {
            trackPackage: function(){
                var package_number = this.track_package_number;
                var _self = this;
                if(package_number === null){
                    this.track_package.error_msg = '<?php D(__('invalid_package_number', 'Invalid package number')) ?>';
                    return false;
                }
                this.processing = true;
                this.track_package.error_msg = null;

                getPackage(package_number)
                .then(function(res){
                    if(res.status == 1){
                        _self.track_package.pickup_city = res.data.package.pick_city_name;
                        _self.track_package.drop_city = res.data.package.drop_city_name;
                        _self.track_package.added_date = res.data.package.added_date;
                        _self.track_package.pickup_info = res.data.package.pickup_info;
                        _self.track_package.drop_info = res.data.package.package_info;
                        _self.track_package.ID = res.data.package.packge_id;
                        _self.track_package.package_number = res.data.package.package_number;
                        _self.track_package.package_status = res.data.package.package_status;
                        _self.track_package.note = res.data.package.package_note;
                        _self.track_package.customer_name = res.data.package.customer_name;
                        _self.track_package.error_msg = null;
                       
                        _self.track_package.fee = (parseFloat(res.data.package.package_fee)+parseFloat(res.data.package.package_fee_extra)).toFixed(2);
                        _self.track_package.price = res.data.package.price;
                        _self.track_package.package_price_total = res.data.package.package_price_total;

                        _self.track_package.track_history = res.data.package.package_history;
                        
                    }else{
                        _self.track_package.ID = null;
                        _self.track_package.error_msg = res.errors.track_package;
                    }

                    _self.processing = false;
                });

            },
        }
  });



});
</script>