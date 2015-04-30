<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* created on 30 April 2015 by irfani@gmail.com */

class Lapp extends Mapp{
	
	public function __construct()
	{
		parent::__construct();
		
	}
   
	 public function js_dt_set($url,$cols) {
	 $output ='';
	 $output.=' 
	 var oTable = $(\'#data\').dataTable({
	    dom: \'T<"clear">lfrtip\',
			   		"tableTools": {
			   	   	"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
			   	    	"sRowSelect": "multi",
				    	"aButtons": [
					        	"select_all", 
					        	"select_none",
							{
						    		"sExtends":    "collection",
						    		"sButtonText": "Export",
						    		"aButtons":    [ "copy","csv", "xls", "pdf","print" ]
							}
				    	]
				},
		"sPaginationType": "full_numbers",
		/*"sScrollY": "400px",*/
		"bProcessing": true,
	        "bServerSide": true,
	        "sServerMethod": "GET",
	        "sAjaxSource": "'.$url.'",
	        "iDisplayLength": 10,
	        "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
	        "aaSorting": [[1, \'asc\']],
	       "aoColumns": [
			{ "bVisible": true, "bSearchable": false, "bSortable": false },';
		for ($i=1;$i<=$cols;$i++){	
			$output.='{ "bVisible": true, "bSearchable": true, "bSortable": true },';
		}	
		$output.='{ "bVisible": true, "bSearchable": false, "bSortable": false }
	        ], "oLanguage": {
        "sProcessing": "<img src=\"assets/images/ajax-loader11.gif\">"
    }
			
			
		
	});';
	
	 return $output;
	 } 
	
	public function add_error_css() {
	$output='<style type="text/css">    
	label.error {
    font-weight: bold;
    color: red;
    padding: 2px 8px;
    margin-top: 2px;
    } </style>';
	return $output;
	}
	
	
	public function js_validate($formname) {
	$output='$(\''.$formname.'\').validate();';
	return $output;
	}
	
	
	public function js_dt_del($action,$callback) {
	$output='';
	$output.=' jQuery(\'#data tbody\').on(\'click\', \'#btndel\', function () {
	 if(confirm(\'Do You Want to Delete This Data?\')){
        var data = oTable.fnGetData(jQuery(this).closest(\'tr\')[0]);
		var kode 	= jQuery(this).attr(\'kode\');
		jQuery.post(\''.$action.'\',{kode:kode},function(data){
			/*alert(\'delete sukses\');*/
			window.location="'.$callback.'";
		});
	 } 
	});';
	  
	return $output;
	}


} //end class
?>