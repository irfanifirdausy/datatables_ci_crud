<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* created on 30 April 2015 by irfani@gmail.com */
class Welcome extends CI_Controller {
   
    public function __construct() {
		parent::__construct();
		$this->load->model('mapp');	
	    $this->load->library('lapp');	
	
	}

	public function index()
	{
		$data['main_content'] = $this->html_content();			
		$data['add_js'] = $this->lapp->js_dt_set(base_url('welcome/getdata'),2);		
		$data['add_js'].=$this->lapp->js_validate('#myform');
		$data['add_js'].=$this->lapp->js_dt_del(base_url('welcome/delete'),base_url()); 
		$this->load->view('index_view',$data);
	}
	
	public function html_content() {
	$output='';
		$output.=$this->lapp->add_error_css();
    $output.='<div class="panel panel-default">';
	if ($this->input->get('mod')=='edit' && is_numeric($this->input->get('id'))===TRUE) {
	$judul = '<i class="glyphicon glyphicon-pencil"></i> Edit Data';
	
	$q = $this->mapp->qselect('employee',$this->input->get('id'));
	if ($q->num_rows() > 0 ) {
	 $row = $q->result_array();
	 
	  $id=$row[0]['ID'];
	  $name=$row[0]['employee_name'];
	  $position=$row[0]['employee_position'];
    
	} 
	} else {
	$judul = '<i class="glyphicon glyphicon-plus"></i> Add Data';
	$id=$name=$position='';
	}
	
                                    $output.='<div class="panel-heading">'.$judul.'</div>
                                     
                                
                                <!-- form start -->
                              <div class="panel-body">
                                <form role="form" name="myform" id="myform" action="'.base_url('welcome/save').'" method="post">
                                <table class="table table-bordered table-responsive">
                                        <tbody>
										<tr>
                                            <td width="10%">NAME</td>
                                            <td><input type="text" class="required form-control input-sm" id="txtname" name="txtname" maxlength="50" value="'.$name.'"><input type="hidden" class="form-control input-sm" id="txtID" name="txtID" value="'.$id.'"></td>
                                            <td width="10%">POSITION</td>
                                            <td><input type="text" class="required form-control input-sm" id="txtposition" name="txtposition" maxlength="100" value="'.$position.'"></td>
                                        </tr>
									
                                    </tbody></table>
                                    <p>
                                        <input type="submit" class="btn btn-primary btn-sm" name="save" value="S a v e"> &nbsp;
                                        <input type="reset" class="btn btn-warning btn-sm" name="reset" value="Reset">
                                    </p>
                                </form>
                               
                            
                    
                                
  <table id="data" class="table table-bordered table-striped table-responsive" width="100%">
    <thead>
        <tr>
             <th>&nbsp;</th> 
			<th>NAME</th>             
			<th>POSITION</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot> <tr>
	   <th>&nbsp;</th> 
			<th>NAME</th>             
			<th>POSITION</th>
            <th width="15%">Action</th>
        </tr></tfoot>
</table>
<p>&nbsp;</p>
<br>
                         </div> </div>';
	return $output;
	}
	
	public function getdata() {
	    $this->db = $this->load->database('default',true);
        $aColumns = array('ID','employee_name', 'employee_position');
        
        $sTable = 'employee';
		$sIndexColumn = "ID";
        $sWhere = ''; $i=1;
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
	     $qtot= $this->db->query('select COUNT(*) AS total from '.$sTable.' where STATUSID=1');
   		$total1 =  $qtot->result_array();
		$iFilteredTotal1 =$total1[0]['total'];
	
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }  else {
		
		 $this->db->limit($iFilteredTotal1, $this->db->escape_str($iDisplayStart));
		}
        
        // Ordering
		$sOrder=$aColumns[''.$iSortCol_0.''].' desc';
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
					$sOrder = $aColumns[''.$iSortCol_0.''].' '.$sSortDir;
                }
            }
        }
        
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }
        
$top = (isset($iDisplayStart))?((int)$iDisplayStart):0 ;
 if(isset($iDisplayStart) && $iDisplayLength != '-1') {
$limit = (isset($iDisplayLength))?((int)$iDisplayLength):10;
} else {
$limit =$iFilteredTotal1;
}

$q = "SELECT  ".implode(",",$aColumns)."
FROM $sTable $sWhere ".(($sWhere=="")?" WHERE STATUSID=1":" AND ")."";
if( !empty($sSearch)) {   
	$q.=" AND ( ".$aColumns['1']." LIKE '%".$sSearch."%' ";    
	$q.=" OR ".$aColumns['2']." LIKE '%".$sSearch."%')"; 
	}
$q .= " ORDER BY $sOrder limit $top, $limit";


$rResult = $this->db->query($q);

$q = "SELECT COUNT(*) AS found_rows
FROM $sTable $sWhere ".(($sWhere=="")?" WHERE STATUSID=1":" AND ")."";
if( !empty($sSearch)) {   
	$q.=" AND ( ".$aColumns['1']." LIKE '%".$sSearch."%' ";    
	$q.=" OR ".$aColumns['2']." LIKE '%".$sSearch."%')"; 
	}
	   $rResult1 = $this->db->query($q);

		$total =  $rResult1->result_array();
		$iFilteredTotal =$total[0]['found_rows'];
		
    
    $iTotal = $this->db->where('STATUSID',1)->get($sTable)->num_rows(); 
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
           $no = $top + $i;
		    $row = array();
            $row[0] = $no;
			$row[1] = $aRow['employee_name'];
			$row[2] = $aRow['employee_position'];
            $row[3] = '<a href="?mod=edit&id='.$aRow['ID'].'" id="btnedit" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a> <a href="#" id="btndel" kode="'.$aRow['ID'].'" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></a> ';
            $output['aaData'][] = $row;
			$i++;
			
        }
        echo json_encode($output);
	}
	
	public function save() {
    if ($this->input->post('save',true)) {
	$id = trim($this->input->post('txtID'));
	if($id!=''){
	  $this->mapp->employee_upd($id);		
	}else{
      $this->mapp->employee_insert();	
	}
	echo '<script type="text/JavaScript">
    alert("Data Saved.");
	window.location="'.base_url().'";
    </script>';
    } 
   }
   
   public function delete() {
    $id = $this->input->post('kode');
    $this->mapp->qdel('employee',$id);
   }
	
	
}

?>	