<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      
		<!-- working area -->
		
		
	  
      <?php 
        $admin_role_key = admin_role_key();
      ?>
	  <div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Pending Packges</h3>
				</div>
				<div class="box-body table-responsive no-padding">
                     <table class="table table-hover">
                        <tbody>
                        <tr>
                        <th style="width:10%">ID</th>
                        <th style="width:18%">User</th>
                        <th style="width:15%">Pickup / Drop</th>
                        <th style="width:15%">Customer Name</th>
                        <?php if($admin_role_key !== 'local-admin' && $admin_role_key !== 'driver'){ ?>
                        <th style="width:10%">Fee Total</th>
                        <?php } ?>
                        <th style="width:12%"  class="text-center">Package Total</th>
                        <th style="width:15%">Added Date</th>
                        <th style="width:10%">Status</th>
                        <th class="text-right" style="padding-right:20px;">Action</th>
                        </tr>
                        <?php if(count($list) > 0){foreach($list as $k => $v){ 
                        $status = '';
                        if($v['status'] == PACKAGE_PENDING){	
                            $status = '<span class="badge badge-warning">Pending</span>';
                        }else if($v['status'] == PACKAGE_DELIVERED){
                            $status = '<span class="badge badge-success">Delivered</span>';
                        }else if($v['status'] == PACKAGE_PROCEEDING){
                            $status = '<span class="badge badge-primary">Proceeding</span>';
                        }else if($v['status'] == PACKAGE_REJECTED){
                            $status = '<span class="badge badge-danger">Rejected</span>';
                        }else if($v['status'] == PACKAGE_STUCK){
                            $status = '<span class="badge badge-info">Stuck</span>';
                        }else if($v['status'] == PACKAGE_MONEY_DELIVERED){
                            $status = '<span class="badge badge-secondary">Money Delivered</span>';
                        }else if($v['status'] == PACKAGE_CONFIRM){
                            $status = '<span class="badge badge-success">Confirmed</span>';
                        }
                        
                        ?>
                        <tr>
                        <td><b><?php echo $v['package_number']; ?></b></td>
                        <td>
                            <div><b>Name:</b> <?php echo $v['member_name'];?></div>
                            <div><b>Phone:</b> <?php echo $v['member_phone'];?></div>
                        </td>
                        <td>
                            <div><b>Pickup City: </b><div><?php echo $v['pickup_city_name'];?></div></div>
                            <div><b>Drop City: </b><div><?php echo $v['city_name'];?></div></div>
                        </td>
                        <td><?php echo $v['customer_name'] ? $v['customer_name'] : '-'; ?></td>
                        <?php if($admin_role_key !== 'local-admin' && $admin_role_key !== 'driver'){ ?>
                        <td><?php echo CURRENCY.sprintf('%1.2f', $v['package_fee']+$v['package_fee_extra']); ?></td>
                        <?php } ?>
                        <td class="text-center"><?php echo $v['package_price_total'] > 0 ? CURRENCY.$v['package_price_total'] : CURRENCY.sprintf('%1.2f', ($v['package_fee']+$v['package_fee_extra']+$v['price'])); ?></td>
                        <td><?php echo format_date_time($v['added_date']); ?></td>
                        <td><?php echo $status; ?></td>
                        <td class="text-right" style="padding-right:20px;">
                            <a href="<?php echo JS_VOID; ?>" onclick="package_detail('<?php echo $v['package_id']; ?>')"data-toggle="tooltip" title="Package Detail"><i class="icon-feather-package green <?php echo ICON_SIZE;?>"></i></a> 
                        </td>
                        </tr>
                        <?php } }else{  ?>
                        <tr>
                        <td colspan="10"><?php echo NO_RECORD; ?></td>
                        </tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	  </div>
	  
		
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <div class="modal fade" id="ajaxModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		 
		</div>
	  </div>
</div>

<script>
  function package_detail(id){
        var url = '<?php echo base_url('package/load_ajax_page?page=package_detail');?>&id='+id;
        load_ajax_modal(url);
    }
</script>
  