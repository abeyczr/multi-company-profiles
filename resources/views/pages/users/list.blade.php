<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Users"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Users</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <a  class="btn btn-primary btn-block" href="<?php print_link("users/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New User 
                </a>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                        <button class="btn btn-primary"><i class="icon dripicons-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="users-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/users/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left table-bordered">
                                <thead class="table-header bg-primary text-white">
                                    <tr>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <th class="td-id <?php echo (get_value('orderby') == 'id' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('id', "Id", ''); ?>
                                        </th>
                                        <th class="td-username <?php echo (get_value('orderby') == 'username' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('username', "Username", ''); ?>
                                        </th>
                                        <th class="td-name <?php echo (get_value('orderby') == 'name' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('name', "Name", ''); ?>
                                        </th>
                                        <th class="td-phone <?php echo (get_value('orderby') == 'phone' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('phone', "Phone", ''); ?>
                                        </th>
                                        <th class="td-email <?php echo (get_value('orderby') == 'email' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('email', "Email", ''); ?>
                                        </th>
                                        <th class="td-photo <?php echo (get_value('orderby') == 'photo' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('photo', "Photo", ''); ?>
                                        </th>
                                        <th class="td-role <?php echo (get_value('orderby') == 'role' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('role', "Role", ''); ?>
                                        </th>
                                        <th class="td-status <?php echo (get_value('orderby') == 'status' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('status', "Status", ''); ?>
                                        </th>
                                        <th class="td-email_verified_at <?php echo (get_value('orderby') == 'email_verified_at' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('email_verified_at', "Email Verified At", ''); ?>
                                        </th>
                                        <th class="td-remember_token <?php echo (get_value('orderby') == 'remember_token' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('remember_token', "Remember Token", ''); ?>
                                        </th>
                                        <th class="td-created_at <?php echo (get_value('orderby') == 'created_at' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('created_at', "Created At", ''); ?>
                                        </th>
                                        <th class="td-updated_at <?php echo (get_value('orderby') == 'updated_at' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('updated_at', "Updated At", ''); ?>
                                        </th>
                                        <th class="td-btn"></th>
                                    </tr>
                                </thead>
                                <?php
                                    if($total_records){
                                ?>
                                <tbody class="page-data">
                                    <!--record-->
                                    <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <!--PageComponentStart-->
                                        <td class="td-id">
                                            <a href="<?php print_link("/users/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-username">
                                            <?php echo  $data['username'] ; ?>
                                        </td>
                                        <td class="td-name">
                                            <?php echo  $data['name'] ; ?>
                                        </td>
                                        <td class="td-phone">
                                            <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                        </td>
                                        <td class="td-email">
                                            <a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a>
                                        </td>
                                        <td class="td-photo">
                                            <?php 
                                                Html :: page_img($data['photo'], '50px', '50px', "small", 1); 
                                            ?>
                                        </td>
                                        <td class="td-role">
                                            <?php echo  $data['role'] ; ?>
                                        </td>
                                        <td class="td-status">
                                            <?php echo  $data['status'] ; ?>
                                        </td>
                                        <td class="td-email_verified_at">
                                            <a href="<?php print_link("mailto:$data[email_verified_at]") ?>"><?php echo $data['email_verified_at']; ?></a>
                                        </td>
                                        <td class="td-remember_token">
                                            <?php echo  $data['remember_token'] ; ?>
                                        </td>
                                        <td class="td-created_at">
                                            <?php echo format_date( $data['created_at'] , 'd-m-Y H:i:s'); ?>
                                        </td>
                                        <td class="td-updated_at">
                                            <?php echo format_date( $data['updated_at'] , 'd-m-Y H:i:s'); ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <a class="btn btn-sm btn-primary has-tooltip page-modal"    href="<?php print_link("users/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> 
                                        </a>
                                        <a class="btn btn-sm btn-success has-tooltip page-modal"    href="<?php print_link("users/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> 
                                    </a>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal"  href="<?php print_link("users/delete/$rec_id"); ?>" >
                                    <i class="icon dripicons-cross"></i> 
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                        <!--endrecord-->
                    </tbody>
                    <tbody class="search-data"></tbody>
                    <?php
                        }
                        else{
                    ?>
                    <tbody class="page-data">
                        <tr>
                            <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                <i class="icon dripicons-wrong"></i> Belum ada data
                            </td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <?php
                if($show_footer){
            ?>
            <div class=" mt-3">
                <div class="row align-items-center justify-content-between">    
                    <div class="col-md-auto d-flex">    
                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("users/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                        <i class="icon dripicons-cross"></i> Delete Selected
                        </button>
                    </div>
                    <div class="col">   
                        <?php
                            if($show_pagination == true){
                            $pager = new Pagination($total_records, $record_count);
                            $pager->show_page_count = false;
                            $pager->show_record_count = true;
                            $pager->show_page_limit =false;
                            $pager->limit = $limit;
                            $pager->show_page_number_list = true;
                            $pager->pager_link_range=5;
                            $pager->render();
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>


@endsection
