<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('ssp');
	}

	public function index($type='',$team='',$data=array())
	{
		// echo json_encode($this->session->userdata());
		$this->load->view('v_dashboard',$data);
	}

	public function ajax_list_leave()
	{
		$startdate = $this->input->get('startdate');
		$enddate = $this->input->get('enddate');
		$requester = $this->input->get('requester');
		$desc = $this->input->get('desc');
		$where='';

		if(($startdate)&&(!$enddate)){
			$where .= 'WHERE date_request = "'.$this->db->escape_str($startdate).'" ';
		}elseif((!$startdate)&&($enddate)){
			$where .= 'WHERE date_request = "'.$this->db->escape_str($enddate).'" ';
		}elseif(($startdate)&&($enddate)){
			$where .= 'WHERE date_request >= "'.$this->db->escape_str($startdate).'" AND date_request <= "'.$this->db->escape_str($enddate).'" ' ;
		}

		if($this->session->userdata('priviledge') != 0 ){
			$requester = $this->session->userdata('name');
			$where .= ' WHERE name LIKE "%'.$this->db->escape_str($requester).'%" ';
		}

		if(($where)&&($requester)){
			$where .= ' AND name LIKE "%'.$this->db->escape_str($requester).'%" ';
		}elseif($requester){
			$where .= ' WHERE name LIKE "%'.$this->db->escape_str($requester).'%" ';
		}

		if(($where)&&($desc)){
			$where .= ' AND `desc` LIKE "%'.$this->db->escape_str($desc).'%" ';
		}elseif($desc){
			$where .= ' WHERE `desc` LIKE "%'.$this->db->escape_str($desc).'%" ';
		}

		

		$table = '(SELECT * FROM tbl_leave '.$where.' GROUP BY date_request , `name` , `desc`) x';
			
			// Table's primary key
			$primaryKey = 'x.id';
			
			// Table's where
			$sWhere = "x.id > 0";

			// Table's Group by
			$sGroupBy = '';
			
			
			$columns = array(
					array( 'db' => 'x.id', 'dt' => 0 ),
					array( 'db' => 'x.date_request',  'dt' => 1 ),
					array( 'db' => 'x.name',  'dt' => 2 ),
					array( 'db' => 'x.desc',  'dt' => 3 ),
				);

			$rows='';
			for($i=0;$i<count($columns);$i++){
				if ($i!=count($columns)-1){
					$rows.=$columns[$i]['db'].',';
				}else{
					$rows.=$columns[$i]['db'];
				}
				
			}
			
			// For Showing Column		
			$aColumns = explode (',',$rows);
			

			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP
			 * server-side, there is no need to edit below this line.
			 */
			//$this->load->library('ssp.class');
			//require( 'ssp.class.php' );
			
			
			$request = $_GET;
			$bindings = array();
			
			// SQL server connection information
			$db = SSP::sql_connect();
			
			
			// Build the SQL query string from the request
			$limit = SSP::limit( $request, $columns );
			$order = SSP::order( $request, $columns );
			$where = SSP::filter( $request, $columns, $bindings,$sWhere );
			
			//echo json_encode($where);
			//die();
			
			// Main query to actually get the data
			$data = SSP::sql_exec( $db, $bindings,
				"SELECT SQL_CALC_FOUND_ROWS ".implode(", ", SSP::pluck($columns, 'db'))."
				 FROM $table
				 $where
				 $sGroupBy
				 $order
				 $limit"
			);

			//echo $data;
			
			// Data set length after filtering
			$resFilterLength = SSP::sql_exec( $db,
				"SELECT FOUND_ROWS()"
			);
			$recordsFiltered = $resFilterLength[0][0];

			// Total data set length
			$resTotalLength = SSP::sql_exec( $db,$bindings,
				"SELECT COUNT({$primaryKey})
				 FROM   $table
				 $where
				 "
			);
			$recordsTotal = $resTotalLength[0][0];


			/*
			 * Output
			 */
			$output = array(
				"draw"            => intval( $request['draw'] ),
				"recordsTotal"    => intval( $recordsTotal ),
				"recordsFiltered" => intval( $recordsFiltered ),
				"data"            => array()
				//"data"            => SSP::data_output( $columns, $data )
			);
		
			$hit = '1';
				
				foreach($data as $aRow)
					{
						$row = array();
						for ( $i=0 ; $i<count($aColumns) ; $i++ )
						{
							
							if ( $aColumns[$i] == "version" )
							{
								
								$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
							}
							else if ( $aColumns[$i] != ' ' )
							{
								
									if(stripos($aColumns[$i],'.')===FALSE){
										if ($aColumns[$i] == 'id'){										
											// $row[]= 'Rp.	' ;
										} else {
											$row[] = $aRow[ $aColumns[$i] ];
										}
										$row[] = $aRow[ $aColumns[$i] ];
										$id_temp = $aRow[$aColumns[0]];
										
									} else {
										$column = explode('.',$aColumns[$i]);
										$temps = explode('.',$aColumns[0]);
										$id_temp = $aRow[$temps[1]];
										

										if ($column[1] == 'id'){
											$row[] = '<a href="javascript:void(0);" class="edit_data" data-id="'.$id_temp.'"> Edit </a> | <a href="javascript:void(0);" class="delete_data" data-id="'.$id_temp.'"> Hapus </a> | <a href="javascript:void(0);" class="detail_data" data-id="'.$id_temp.'"> Detail </a>';
										}else{
											$row[] = $aRow[$column[1]];	
										}		

									}


							}

						}
						 
						$output['data'][] = $row;
						$hit++;

						

					}
				
			
			//(data, account_database, table name, primary key, columns)
			/*echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
			);*/
			echo json_encode($output);
	}

	function saveLeave(){
		$data = $this->input->post('data_leave');
		
		$datas = json_decode($data);

		if($data){
			for ($i=0; $i <count($datas) ; $i++) { 
				$dataInsert = array(
					'name' => $datas[$i]->requester_add,
					'date_request' => $datas[$i]->daterequest_add,
					'desc' => $datas[$i]->desc_add,
					'start_date' => $datas[$i]->startdate_add,
					'end_date' => $datas[$i]->enddate_add,
					'type' => $datas[$i]->jenis_add,
					'create_by' => $this->session->userdata('username'),
					'create_date' => date('Y-m-d H:i:s')	
				);
				$this->db->insert('tbl_leave',$dataInsert);
			}
			$message = array('status'=> 'success' , 'message' => 'Berhasil menyimpan data');
		}else{
			$message = array('status'=> 'failed' , 'message' => 'Gagal menyimpan data');
		}
		echo json_encode($message);
	}

	function detail_data(){
		$id = $this->input->get('id');
		if($id){
			$sql = "SELECT * FROM tbl_leave WHERE id = '".$this->db->escape_str($id)."' ";
			$results = $this->db->query($sql)->result();
			if($results){
				$sql2 = "SELECT * FROM tbl_leave WHERE `date_request` = '".$results[0]->date_request."' AND `name` = '".$results[0]->name."'AND `desc` = '".$results[0]->desc."'  ";
				$results2 = $this->db->query($sql2)->result();
				if($results2){
					$res = array('status' => 'success' , 'message' => $results2 );
				}else{
					$res = array('status' => 'failed' , 'message' => 'Data tidak ditemukan' );
				}
			}else{
				$res = array('status' => 'failed' , 'message' => 'Data tidak ditemukan' );
			}
		}else{
			$res = array('status' => 'failed' , 'message' => 'Parameter salah' );
		}
		echo json_encode($res);
	}

	function delete_data(){
		$id = $this->input->get('id');
		if($id){
			$sql = "SELECT * FROM tbl_leave WHERE id = '".$this->db->escape_str($id)."' ";
			$results = $this->db->query($sql)->result();
			if($results){
				$sql2 = "DELETE FROM tbl_leave WHERE `date_request` = '".$results[0]->date_request."' AND `name` = '".$results[0]->name."'AND `desc` = '".$results[0]->desc."'  ";
				$results2 = $this->db->query($sql2);
				if($results2){
					$res = array('status' => 'success' , 'message' => 'Data berasil dihapus' );
				}else{
					$res = array('status' => 'failed' , 'message' => 'Gagal menghapus data' );
				}
			}else{
				$res = array('status' => 'failed' , 'message' => 'Gagal menghapus data' );
			}
		}else{
			$res = array('status' => 'failed' , 'message' => 'Parameter salah' );
		}
		echo json_encode($res);
	}

	function delete_data_byId(){
		$id = $this->input->get('id');
		if($id){
			$sql = "SELECT * FROM tbl_leave WHERE id = '".$this->db->escape_str($id)."' ";
			$results = $this->db->query($sql)->result();
			if($results){
				$sql2 = "DELETE FROM tbl_leave WHERE `id` = '".$id."' ";
				$results2 = $this->db->query($sql2);
				if($results2){
					$res = array('status' => 'success' , 'message' => 'Data berasil dihapus' );
				}else{
					$res = array('status' => 'failed' , 'message' => 'Gagal menghapus data' );
				}
			}else{
				$res = array('status' => 'success' , 'message' => 'Data berasil dihapus' );
			}
		}else{
			$res = array('status' => 'failed' , 'message' => 'Parameter salah' );
		}
		echo json_encode($res);
	}

	function saveEditLeave(){
		$data = $this->input->post('data_edit_leave');
		
		$datas = json_decode($data);

		if($data){
			for ($i=0; $i <count($datas) ; $i++) { 
				$dataUpdate = array(
					'name' => $datas[$i]->name,
					'date_request' => $datas[$i]->date_request,
					'desc' => $datas[$i]->desc,
					'start_date' => $datas[$i]->start_date,
					'end_date' => $datas[$i]->end_date,
					'type' => $datas[$i]->type,
					'change_by' => $this->session->userdata('username'),
					'change_date' => date('Y-m-d H:i:s')	
				);
				if($datas[$i]->id !=''){
					$this->db->where('id',$datas[$i]->id);
					$this->db->update('tbl_leave',$dataUpdate);
				}else{
					$this->db->insert('tbl_leave',$dataUpdate);
				}
			}
			$message = array('status'=> 'success' , 'message' => 'Berhasil mengedit data');
		}else{
			$message = array('status'=> 'failed' , 'message' => 'Gagal mengedit data');
		}
		echo json_encode($message);
	}

	function logout(){
        session_destroy();

        session_start();
        redirect('Login');
	}
}
