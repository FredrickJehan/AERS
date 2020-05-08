<?php
    $column = array('cr_author','cr_year','cr_title','cr_location','cr_institute','cr_url');
    $query = "SELECT * FROM completed_research";

    if(isset($_POST['search']['value'])){
        $query .='
        WHERE cr_author LIKE "%'.$_$POST['search']['value'].'%"
        OR cr_year LIKE "%'.$_$POST['search']['value'].'%"
        OR cr_title LIKE "%'.$_$POST['search']['value'].'%"
        OR cr_location LIKE "%'.$_$POST['search']['value'].'%"
        OR cr_institute LIKE "%'.$_$POST['search']['value'].'%"
        OR cr_url LIKE "%'.$_$POST['search']['value'].'%"
        ';
    }

    if(isset($_POST['order'])){
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    }else{
        $query .= 'ORDER BY cr_author DESC ';
    }

    $query1 = ''

    if($_POST['length'] != -1){
        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $statement = prepare($query);
    $statement->execute();
    $number_filter_row = $statement->rowCount();
    $statement = prepare($query . $query1);
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();

    foreach($result as $row){
        $sub_array = array();
        $sub_array[] = $row['cr_author'];
        $sub_array[] = $row['cr_year'];
        $sub_array[] = $row['cr_title'];
        $sub_array[] = $row['cr_location'];
        $sub_array[] = $row['cr_institute'];
        $sub_array[] = $row['cr_url'];
        $data[] = $sub_array;
    }

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsFiltered' => $number_filter_row,
        'data' => $data
    );
    echo json_encode($output);

?>