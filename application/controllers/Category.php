<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('categorymodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    //-------------------------Category Add / Update---------------------------------
    public function home()
    {
        $datas           = $this->session->userdata();
        $user_id         = $this->session->userdata('id');
        $user_role       = $this->session->userdata('user_role');
        $datas['result'] = $this->categorymodel->getall_category_details();
        //print_r($datas['result']); exit;
        if ($user_role == 1) {
            $this->load->view('header');
            $this->load->view('category/add', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function add_category()
    {
        $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('id');
        $user_role    = $this->session->userdata('user_role');
        $categoryname = $this->input->post('categoryname');
        $status       = $this->input->post('eventsts');
        $disp_order = $this->input->post('disp_order');
        //echo $categoryname; echo $status;
        $category_pic = $_FILES['categorypic']['name'];
        $temp = pathinfo($category_pic, PATHINFO_EXTENSION);
        $file_name    = time() . rand(1,5) . rand(6,10);
        $categorypic1 = $file_name . '.' .$temp;
        $uploaddir    = 'assets/category/';
        $profilepic   = $uploaddir . $categorypic1;
        move_uploaded_file($_FILES['categorypic']['tmp_name'], $profilepic);
        $datas = $this->categorymodel->insert_category($categoryname, $categorypic1, $disp_order, $status, $user_id, $user_role);
        $sta   = $datas['status'];
        //print_r($sta);exit;
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Category added successfully');
            redirect('category/home');
        } else if ($sta == "Category already exists!") {
            $this->session->set_flashdata('msg', $sta);
            redirect('category/home');
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('category/home');
        }
    }
    public function edit_category($id)
    {
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('id');
        $user_role     = $this->session->userdata('user_role');
        $datas['edit'] = $this->categorymodel->edit_category($id, $user_id, $user_role);
         $datas['result'] = $this->categorymodel->getall_category_details();
        if ($user_role == 1) {
            $this->load->view('header');
            $this->load->view('category/edit', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function update_category()
    {
        $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('id');
        $user_role    = $this->session->userdata('user_role');

        $status       = $this->input->post('eventsts');
        $currentpic   = $this->input->post('currentcpic');
        $category_id  = $this->input->post('id');

        $old_disp_order=$this->input->post('old_disp_order');
        $disp_order=$this->input->post('disp_order');

        $category_pic = $_FILES['categorypic']['name'];
        $temp = pathinfo($category_pic, PATHINFO_EXTENSION);
        $file_name    = time() . rand(1, 5) . rand(6, 10);
       // $categorypic1 = $file_name . $category_pic;
        $categorypic1 = $file_name . '.' .$temp;
        $uploaddir    = 'assets/category/';
        $profilepic   = $uploaddir . $categorypic1;
        move_uploaded_file($_FILES['categorypic']['tmp_name'], $profilepic);
        if (empty($category_pic)) {
            $categorypic1 = $currentpic;
        }
        $datas = $this->categorymodel->update_category_details($category_id,$categorypic1,$disp_order,$old_disp_order,$status,$user_id,$user_role);
        $sta   = $datas['status'];
        //print_r($sta);exit;
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Changes made are saved');
            redirect('category/home');
        } else if ($sta == "Category already exists!") {
            $this->session->set_flashdata('msg', $sta);
            redirect('category/home');
        } else {
            $this->session->set_flashdata('msg', $sta);
            redirect('category/home');
        }
    }


		public function change_category_name(){
			$datas           = $this->session->userdata();
			$user_id         = $this->session->userdata('id');
			$user_role       = $this->session->userdata('user_role');
			if ($user_role == 1) {
				$categoryname = $this->input->post('categoryname');
				$ct_id       = $this->input->post('ct_id');
				$datas= $this->categorymodel->save_category_name($user_id,$categoryname,$ct_id);
			}else{
				redirect('/');
			}
		}
}
?>
