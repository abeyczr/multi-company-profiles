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
    $pageTitle = "Hero Banners"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Hero Banners</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <a  class="btn btn-primary btn-block" href="<?php print_link("herobanners/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Hero Banner 
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
                    <div id="herobanners-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/herobanners/", $field_name, $field_value); ?>
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
                                        <th class="td-company_id <?php echo (get_value('orderby') == 'company_id' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('company_id', "Company", ''); ?>
                                        </th>
                                        <th class="td-title <?php echo (get_value('orderby') == 'title' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('title', "Title", ''); ?>
                                        </th>
                                        <th class="td-button_text <?php echo (get_value('orderby') == 'button_text' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('button_text', "Button Text", ''); ?>
                                        </th>
                                        <th class="td-button_link <?php echo (get_value('orderby') == 'button_link' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('button_link', "Button Link", ''); ?>
                                        </th>
                                        <th class="td-status <?php echo (get_value('orderby') == 'status' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('status', "Status", ''); ?>
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
                                        <td class="td-company_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companyprofiles/view/$data[company_id]?subpage=1") ?>">
                                            <i class="icon dripicons-preview"></i> <?php echo $data['companyprofiles_company_name'] ?>
                                        </a>
                                    </td>
                                    <td class="td-title">
                                        <?php echo  $data['title'] ; ?>
                                    </td>
                                    <td class="td-button_text">
                                        <?php echo  $data['button_text'] ; ?>
                                    </td>
                                    <td class="td-button_link">
                                        <?php echo  $data['button_link'] ; ?>
                                    </td>
                                    <td class="td-status">
                                        <?php echo  $data['status'] ; ?>
                                    </td>
                                    <!--PageComponentEnd-->
                                    <td class="td-btn">
                                        <a class="btn btn-sm btn-primary has-tooltip page-modal"    href="<?php print_link("herobanners/view/$rec_id"); ?>" >
                                        <i class="icon dripicons-preview"></i> 
                                    </a>
                                    <a class="btn btn-sm btn-success has-tooltip page-modal"    href="<?php print_link("herobanners/edit/$rec_id"); ?>" >
                                    <i class="icon dripicons-document-edit"></i> 
                                </a>
                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal"  href="<?php print_link("herobanners/delete/$rec_id"); ?>" >
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
                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("herobanners/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
