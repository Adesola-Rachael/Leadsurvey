<!-- <?php
  //Pagination code
  $asc_status = "";
  $desc_status = "";
  $asc_sort = "selected";
  $desc_sort = "";

  $status_sort = "";
  $time_sort = "";


  $show10 = "selected";
  $show25 = "";
  $show50 = "";
  $show100 = "";

  $active_opt = "all";

  $summary_msg = "";

  $adjacents = 3; // How many adjacent pages should be shown on each side?
  $page = 1; //default value for current page
  $sort_by = ""; //creating variable for sort attribute
  $search_string = ""; //creating variable for search attribute

  /* Get data for Pagination*/

  //setting/getting value for total number of items to be shown on one page
  if(isset($_GET['items_per_page'])){   
    //collecting P3 value through GET
    $limit = $_GET['items_per_page'];
    $limit = stripslashes($limit);
    $limit = mysqli_real_escape_string($conn, $limit); //for prevention of mySQL injection

    //setting form variables ("selected")
    switch ($limit) {
        case '10':
            $show10 = "selected";
            $show25 = "";
            $show50 = "";
            $show100 = "";
            break;
        case '25':            
            $show10 = "";
            $show25 = "selected";
            $show50 = "";
            $show100 = "";
            break;
        case '50':
            $show10 = "";
            $show25 = "";
            $show50 = "selected";
            $show100 = "";
            break;
        case '100':
            $show10 = "";
            $show25 = "";
            $show50 = "";
            $show100 = "selected";
            break;
        
        default:
            $show25 = "selected";
            break;
    }
  }else{
    //default value for limit
    $limit = 10;
  }  

  //collecting GET variables and using them to create and execute a query.
  if(isset($_GET['sort']) && !empty($_GET['sort']) && (isset($_GET['search']) && !empty($_GET['search'])) ){  
    //collecting sort value through GET
    $sort_by = $_GET['sort'];
    $sort_by = stripslashes($sort_by);
    $sort_by = mysqli_real_escape_string($conn, $sort_by); //for prevention of mySQL injection 

    //collecting sort ORDER value through GET
    $sort_order = $_GET['sort_order'];
    $sort_order = stripslashes($sort_order);
    $sort_order = mysqli_real_escape_string($conn, $sort_order); //for prevention of mySQL injection 

    switch ($sort_order) {
      case 'asc':
        $asc_sort = "selected";
        $desc_sort = "";
        break;
      case 'desc':
        $asc_sort = "";
        $desc_sort = "selected";        
        break;
    }

    //setting active option
    $active_opt = "search";

    //setting form variables ("selected")
    switch ($sort_by) {
      case 'status':
        $status_sort = "selected";
        $time_sort = "";
        break;
      case 'time':
        $status_sort = "";
        $time_sort = "selected"; 
        break;
    }   

    //collecting search value through GET
    $search_string = trim($_GET['search']);
    $search_string = stripslashes($search_string);
    $search_string = mysqli_real_escape_string($conn, $search_string); //for prevention of mySQL injection 
  
    //setting result summary message
    $summary_msg = "(<strong>\"$search_string\"</strong>), Sorted By: <strong>$sort_by, in ".ucfirst($sort_order)."ending order</strong>";

    //setting the target page
    $targetpage = $page_name.".php?sort=$sort_by&sort_order=$sort_order&search=$search_string&items_per_page=$limit&"; 

    //Creating a query to get search results from DB
    $query_items = "SELECT * FROM $tbl_name WHERE (
      $primary_search_column LIKE '$search_string'
      $search_part_query
      ) AND $compulsory_part_query 
    ";    //creating the query        
    $result_search = $conn -> query($query_items); // executing the query
  }else if(isset($_GET['search']) && $_GET['search'] != ""){
    //collecting search value through GET
    $search_string = trim($_GET['search']);
    $search_string = stripslashes($search_string);
    $search_string = mysqli_real_escape_string($conn, $search_string); //for prevention of mySQL injection 

    //setting active option
    $active_opt = "search";

    //setting result summary message
    $summary_msg = "(<strong>\"".$search_string."\"</strong>)";

    //setting the target page
    $targetpage = $page_name.".php?search=".$search_string."&items_per_page=".$limit."&"; 

    //Creating a query to get search results from DB
    $query_items = "SELECT * FROM ".$tbl_name." WHERE 
    $primary_search_column LIKE '%".$search_string."%' 
        AND user_id='$id' AND status!='trashed' 
        ";    //creating the query        
    $result_search = $conn -> query($query_items); // executing the query  
  }else if(isset($_GET['sort']) && !empty($_GET['sort'])){
    //collecting sort value through GET
    $sort_by = $_GET['sort'];
    $sort_by = stripslashes($sort_by);
    $sort_by = mysqli_real_escape_string($conn, $sort_by); //for prevention of mySQL injection 

    //collecting sort ORDER value through GET
    $sort_order = $_GET['sort_order'];
    $sort_order = stripslashes($sort_order);
    $sort_order = mysqli_real_escape_string($conn, $sort_order); //for prevention of mySQL injection 

    switch ($sort_order) {
      case 'asc':
        $asc_sort = "selected";
        $desc_sort = "";
        break;
      case 'desc':
        $asc_sort = "";
        $desc_sort = "selected";        
        break;
    }

    //setting active option
    $active_opt = "all";

    //setting form variables ("selected")
    switch ($sort_by) {
      case 'status':
        $status_sort = "selected";
        $time_sort = "";
        $vendor_sort = "";
        break;
      case 'time':
        $status_sort = "";
        $time_sort = "selected"; 
        $vendor_sort = "";
        break;
      case 'vendor':
        $status_sort = "";
        $time_sort = "";        
        $vendor_sort = "selected";
        break;
    } 

    //setting result summary message
    $summary_msg = "Sorted By: <strong>".$sort_by.", in ".ucfirst($sort_order)."ending order</strong>";

    //setting the target page
    $targetpage = $page_name.".php?sort=".$sort_by."&sort_order=".$sort_order."&items_per_page=".$limit."&"; 

    //Creating a query to get search results from DB
    $query_items = "SELECT * FROM ".$tbl_name." WHERE $compulsory_part_query ";    //creating the query        
    $result_search = $conn -> query($query_items); // executing the query  
  }else {
    //setting the target page
    $targetpage = $page_name.".php?items_per_page=".$limit."&"; 
    $query_items = "SELECT * FROM ".$tbl_name." WHERE $compulsory_part_query ";
    $result_search = $conn -> query($query_items); // executing the query    
  }

  //getting the total number of rows gotten from the executed query, if executed successfully.
  if($result_search){
    //getting the total number of rows from the query execution
    $total_rows = $result_search->num_rows;   
  }else{
    echo "QUERY ERROR: <br/>".$query_items;
    exit();
  }


  //setting/getting value for current page number
  if(isset($_GET['page'])){
    //collecting page value through GET
    $page = $_GET['page'];
    $page = stripslashes($page);
    $page = mysqli_real_escape_string($conn, $page); //for prevention of mySQL injection 

    //set the start user number for current page
    $start = ($page - 1) * $limit;
  }else{ 
    $start = 0;
  } //if no page var is given, set start to 0


  //setting the valid sort column appropriately
  $sort_column = "";
  switch ($sort_by) {
  case 'time':
    $sort_column = "time_created";
    break;
  case 'status':
    $sort_column = "status";
    break;
  }


  // Get data for Display in search page 
  //collecting GET variables and using them to create and execute a query.
  if(isset($_GET['sort']) && !empty($_GET['sort']) && (isset($_GET['search']) && !empty($_GET['search'])) ){ 
    $sql = "SELECT * FROM ".$tbl_name." WHERE 
       ".$primary_search_column." LIKE '%".$search_string."%' AND
       $compulsory_part_query
        ORDER BY ".$sort_column." ".$sort_order."
        LIMIT $start, $limit";            
    $get_query_item = $conn->query($sql);  
  }else if(isset($_GET['search']) && !empty($_GET['search'])){ 
    $sql = "SELECT * FROM ".$tbl_name." WHERE 
       ".$primary_search_column." LIKE '%".$search_string."%' 
        AND $compulsory_part_query
        LIMIT $start, $limit";            
    $get_query_item = $conn->query($sql);  
  }else if(isset($_GET['sort']) && !empty($_GET['sort']) ){ 
    $sql = "SELECT * FROM ".$tbl_name." WHERE
    $compulsory_part_query
        ORDER BY ".$sort_column." ".$sort_order."
        LIMIT $start, $limit";            
    $get_query_item = $conn->query($sql);  
  }else {
    $sql = "SELECT * FROM ".$tbl_name." WHERE $compulsory_part_query   ORDER BY sn DESC LIMIT $start, $limit";
    $get_query_item = $conn->query($sql);
  }



  /* Setup page vars for display. */
  $prev = $page - 1;                          //previous page is page - 1
  $next = $page + 1;                          //next page is page + 1
  $lastpage = ceil($total_rows/$limit);      //lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;                      //last page minus 1

  //setting the value for number of the last user on a page 
  $last_user_num = 0;
  if( $page != $lastpage){
    $last_user_num = $page * $limit;
  }else{
    $last_user_num = $total_rows;
  }
  if ($total_rows <= 0) {
    $last_user_num = 0;
  }

  /* 
    Now we apply our rules and draw the pagination object. 
    We're actually saving the code to a variable in case we want to draw it more than once.
  */


  $pagination = "";
  if($lastpage > 1)
  {               
    //pages 
    for ($counter = 1; $counter <= $lastpage; $counter++)
    {
        if ($counter < $page && $counter >= $page-2){
            $pagination.= '<li class="paginate_button page-item"><a href="'.$targetpage.'page='.$counter.'" tabindex="0" class="page-link">'.$counter.'</a></li>  ';                 
        }                   
        else if ($counter == $page){
            $pagination.= '<li class="paginate_button page-item active"><a href="#"  tabindex="0" class="page-link">'.$counter.'</a></li>';
        }   
        else if ($counter > $page && $counter <= $page+2){
            $pagination.= '<li class="paginate_button page-item"><a href="'.$targetpage.'page='.$counter.'" tabindex="0" class="page-link">'.$counter.'</a></li>  ';                 
        }                   
    }

    if($page <= $lastpage && $page > 1){
        $prev_page = $page - 1;
        $pagination = '
                            <li class="paginate_button page-item previous">
                              <a href="'.$targetpage.'page='.$prev_page.'" aria-label="Previous" tabindex="0" class="page-link"".$primary_search_column."="previous page">
                                <span aria-hidden="true"> <strong>&laquo;</strong></span>
                              </a>
                            </li>
                        '.$pagination;            
    }

    if($page < $lastpage){
        $next_page = $page + 1;
        $pagination .= '
                            <li class="paginate_button page-item next">
                              <a href="'.$targetpage.'page='.$next_page.'" aria-label="Next"  tabindex="0" class="page-link"".$primary_search_column."="next page">
                                <span aria-hidden="true"><strong>&raquo;</strong></span>
                              </a>
                            </li>
                        ';            
    }

    $pagination .= '
                          </ul>
                        </div>
                      </div>
                    </div>
            <!-- pagination -->
                        ';
  }else{
  //echo "PAGINATION ERROR";
  }

  //setting styles based on active option
  $search_opt = "";                                
  $issue_opt = "";
  $all_opt = "btn-default";
  $draft_opt = "btn-default";
  $trash_opt = "btn-default";

  switch ($active_opt) {
  case 'all':
    $search_opt = "";                                
    $issue_opt = "";
    $all_opt = "btn-success";
    $draft_opt = "btn-default";
    $trash_opt = "btn-default";
    break;
  case 'issues':
    $search_opt = "";                                
    $issue_opt = "style=\"border: 2px solid #00a65a;\"";
    $all_opt = "btn-default";
    $draft_opt = "btn-default";
    $trash_opt = "btn-default";
    break;
  case 'search':
    $search_opt = "style=\"border: 2px solid #00a65a;\"";                                
    $issue_opt = "";
    $all_opt = "btn-default";
    $draft_opt = "btn-default";
    $trash_opt = "btn-default";
    break;
  case 'draft':
    $search_opt = "";                                
    $issue_opt = "";
    $all_opt = "btn-default";
    $draft_opt = "btn-success";
    $trash_opt = "btn-default";
    break;
  case 'trashed':
      $search_opt = "";                                
      $issue_opt = "";
      $all_opt = "btn-default";
      $draft_opt = "btn-default";
      $trash_opt = "btn-success";
      break;
  }  
?> -->


