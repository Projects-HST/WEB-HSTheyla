<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Advertisement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('advertisementmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    //------------------------- Advertisement Add / Update---------------------------------
    public function home()
    {
        $datas             = $this->session->userdata();
        $user_id           = $this->session->userdata('id');
        $user_role         = $this->session->userdata('user_role');
        $datas['all_plan'] = $this->advertisementmodel->view_advertisement_plan_details();
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/add_plan', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function add_plans()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $planname  = $this->input->post('planname');
        $planrate  = $this->input->post('plan_rate');
        $datas     = $this->advertisementmodel->add_advertisement_plan_details($user_id, $planname, $planrate);
        $sta       = $datas['status'];
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Advertisement plan created successfully');
            redirect('advertisement/home');
        } else if ($sta == "Already Exist") {
            $this->session->set_flashdata('msg', 'Advertisement plan already exists!');
            redirect('advertisement/home');
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/home');
        }
    }
    public function edit_plans($id)
    {
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('id');
        $user_role     = $this->session->userdata('user_role');
        $datas['edit'] = $this->advertisementmodel->edit_advertisement_plan_details($id);
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/edit_plan', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function update_plans()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $planid    = $this->input->post('planid');
        $planname  = $this->input->post('planname');
        $planrate  = $this->input->post('plan_rate');
        $datas     = $this->advertisementmodel->update_advertisement_plan_details($planid, $planname, $planrate, $user_id);
        $sta       = $datas['status'];
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Changes made are saved');
            redirect('advertisement/home');
        } else if ($sta == "Already Exist") {
            $this->session->set_flashdata('msg', 'Advertisement plan already exists!');
            redirect('advertisement/home');
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/home');
        }
    }
    public function delete_plans()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $id        = $this->input->post('planid');
        $datas     = $this->advertisementmodel->delete_advertisement_plan_details($id);
        $sta       = $datas['status'];
        if ($sta == "success") {
            echo "success";
            //$this->session->set_flashdata('msg','Deleted Successfully');
            //redirect('advertisement/home');
        } else {
            echo "Faild";
            //$this->session->set_flashdata('msg','Faild To Delete');
            //redirect('advertisement/home');
        }
    }
    public function view_adv_plan()
    {
        $datas           = $this->session->userdata();
        $user_id         = $this->session->userdata('id');
        $user_role       = $this->session->userdata('user_role');
        $datas['result'] = $this->advertisementmodel->getall_events_details();
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/view_adv_list', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    //------------------------------------History--------------------------------
    public function add_advertisement_details($id, $category_id)
    {
        $datas                = $this->session->userdata();
        $user_id              = $this->session->userdata('id');
        $user_role            = $this->session->userdata('user_role');
        $datas['result']      = $this->advertisementmodel->getall_adv_history_details($id, $category_id);
        $datas['plans']       = $this->advertisementmodel->getall_adv_plans();
        $datas['event_id']    = $id;
        $datas['category_id'] = $category_id;
		
		//print_r( $datas['result'] );
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/adv_details', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
	
	
    public function add_adv_history()
    {
        $datas       = $this->session->userdata();
        $user_id     = $this->session->userdata('id');
        $user_role   = $this->session->userdata('user_role');
        $event_id    = $this->input->post('event_id');
        $category_id = $this->input->post('category_id');
        $sdate       = $this->input->post('start_date');
        $dateTime    = new DateTime($sdate);
        $start_date  = date_format($dateTime, 'Y-m-d');
        $edate       = $this->input->post('end_date');
        $dateTime    = new DateTime($edate);
        $end_date    = date_format($dateTime, 'Y-m-d');
        //$start_date=$this->input->post('start_date');
        //$end_date=$this->input->post('end_date');
        $start_time  = $this->input->post('start_time');
        $end_time    = $this->input->post('end_time');
        $adv_plan    = $this->input->post('adv_plan');

		$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/slider/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $status      = $this->input->post('status');
        $datas       = $this->advertisementmodel->add_advertisement_plan_history($event_id, $category_id, $start_date, $end_date, $start_time, $end_time, $adv_plan, $status, $user_id,$event_banner);
        $sta         = $datas['status'];
        //$id=$datas['eid'];
        //$category_id=$datas['cid'];
        $id          = str_replace(' ', '', $datas['eid']);
        $category_id = str_replace(' ', '', $datas['cid']);
        //print_r($sta);exit;
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Advertisement details added');
            //redirect('examinationresult/exam_mark_details?var1='.$clsmastid.'&var2='.$exam_id.'',$datas);
            redirect('advertisement/add_advertisement_details/' . $id . '/' . $category_id . '', $datas);
        } else if ($sta == "AE") {
            $this->session->set_flashdata('msg', 'Dates are occupied! Please re-schedule your plan to some other dates. ');
            redirect('advertisement/add_advertisement_details/' . $id . '/' . $category_id . '', $datas);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/add_advertisement_details/' . $id . '/' . $category_id . '', $datas);
        }
    }
    public function delete_history()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $id        = $this->input->post('advid');
        $datas     = $this->advertisementmodel->delete_adv_history($id);
        $sta       = $datas['status'];
        if ($sta == "success") {
            //$this->session->set_flashdata('msg','Deleted Successfully');
            //redirect('advertisement/view_adv_plan',$datas);
            echo "success";
        } else {
            //$this->session->set_flashdata('msg','Faild To Delete');
            //redirect('advertisement/view_adv_plan',$datas);
            echo "Faild";
        }
    }
    public function delete_history_all()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $id        = $this->input->post('advid');
        $datas     = $this->advertisementmodel->delete_adv_history($id);
        $sta       = $datas['status'];
        if ($sta == "success") {
            //$this->session->set_flashdata('msg','Deleted Successfully');
            //redirect('advertisement/view_adv_history',$datas);
            echo "success";
        } else {
            //$this->session->set_flashdata('msg','Faild To Delete');
            //redirect('advertisement/view_adv_history',$datas);
            echo "Faild";
        }
    }
    public function edit_history($id)
    {
        $datas          = $this->session->userdata();
        $user_id        = $this->session->userdata('id');
        $user_role      = $this->session->userdata('user_role');
        $datas['edit']  = $this->advertisementmodel->getall_adv_history($id);
        $datas['plans'] = $this->advertisementmodel->getall_adv_plans();
		
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/edit_adv_details', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function edit_history_all($id)
    {
        $datas          = $this->session->userdata();
        $user_id        = $this->session->userdata('id');
        $user_role      = $this->session->userdata('user_role');
        $datas['edit']  = $this->advertisementmodel->getall_adv_history($id);
        $datas['plans'] = $this->advertisementmodel->getall_adv_plans();
		//print_r($datas);
		
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/edit_adv_history', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function update_adv_history()
    {
        $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('id');
        $user_role    = $this->session->userdata('user_role');
        $event_id     = $this->input->post('event_id');
        $id           = $this->input->post('id');
        $category_id  = $this->input->post('category_id');
        $sdate        = $this->input->post('start_date');
        $dateTime     = new DateTime($sdate);
        $start_date   = date_format($dateTime, 'Y-m-d');
        $edate        = $this->input->post('end_date');
        $dateTime     = new DateTime($edate);
        $end_date     = date_format($dateTime, 'Y-m-d');
        //$start_date=$this->input->post('start_date');
        //$end_date=$this->input->post('end_date');
        //$start_time   = $this->input->post('start_time');
        //$end_time     = $this->input->post('end_time');
         $adv_plan  = $this->input->post('adv_plan');
         $status    = $this->input->post('status');

		$currentcpic    = $this->input->post('currentcpic');
		
       	$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/slider/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

		if (empty($event_pic)) {
            $event_banner = $currentcpic;
        } else {
            $event_banner = $event_banner;
        }

        $datas        = $this->advertisementmodel->aupdate_advertisement_plan_history($id, $event_id, $category_id, $start_date, $end_date,$adv_plan,$status, $user_id,$event_banner);
		
        $sta          = $datas['status'];
        $eid          = str_replace(' ', '', $event_id);
        $ecategory_id = str_replace(' ', '', $category_id);
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Changes made are saved');
            //redirect('examinationresult/exam_mark_details?var1='.$clsmastid.'&var2='.$exam_id.'',$datas);
            redirect('advertisement/add_advertisement_details/' . $eid . '/' . $ecategory_id . '', $datas);
        } else if ($sta == "AE") {
            $this->session->set_flashdata('msg', 'Dates are occupied! Please re-schedule your plan to some other dates. ');
            redirect('advertisement/add_advertisement_details/' . $eid . '/' . $ecategory_id . '', $datas);
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/add_advertisement_details/' . $eid . '/' . $ecategory_id . '', $datas);
        }
    }
    public function update_adv_history_all()
    {
         $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('id');
        $user_role    = $this->session->userdata('user_role');
        $event_id     = $this->input->post('event_id');
        $id           = $this->input->post('id');
        $category_id  = $this->input->post('category_id');
        $sdate        = $this->input->post('start_date');
        $dateTime     = new DateTime($sdate);
        $start_date   = date_format($dateTime, 'Y-m-d');
        $edate        = $this->input->post('end_date');
        $dateTime     = new DateTime($edate);
        $end_date     = date_format($dateTime, 'Y-m-d');
        //$start_date=$this->input->post('start_date');
        //$end_date=$this->input->post('end_date');
       // $start_time   = $this->input->post('start_time');
        //$end_time     = $this->input->post('end_time');
         $adv_plan     = $this->input->post('adv_plan');
         $status       = $this->input->post('status');

		$currentcpic    = $this->input->post('currentcpic');
		
       	$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/slider/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

		if (empty($event_pic)) {
            $event_banner = $currentcpic;
        } else {
            $event_banner = $event_banner;
        }

        $datas        = $this->advertisementmodel->aupdate_advertisement_plan_history($id, $event_id, $category_id, $start_date,$end_date,$adv_plan,$status, $user_id,$event_banner);
        $sta          = $datas['status'];

        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Changes made are saved');
            redirect('advertisement/view_adv_history');
        } else if ($sta == "AE") {
            $this->session->set_flashdata('msg', 'Dates are occupied! Please re-schedule your plan to some other dates. ');
            redirect('advertisement/view_adv_history');
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/view_adv_history');
        }
    }
    public function view_adv_history()
    {
        $datas             = $this->session->userdata();
        $user_id           = $this->session->userdata('id');
        $user_role         = $this->session->userdata('user_role');
        $datas['adv_view'] = $this->advertisementmodel->view_adv_history_details();
        // print_r($datas['adv_view'] );exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/view_adv_history_list', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
	
	public function assign_advertisement($plan_id)
    {
        $datas                = $this->session->userdata();
        $user_id              = $this->session->userdata('id');
        $user_role            = $this->session->userdata('user_role');
        $datas['adv_events']  = $this->advertisementmodel->getall_advevents_details();
		$datas['adv_plan_history']  = $this->advertisementmodel->get_plan_advevents_details($plan_id);
		//print_r($datas['adv_plan_history']);
		$datas['plan_id']    = $plan_id;
		
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('advertisement/assign_advertisement', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
	
	 public function add_plan_history()
    {
        $datas       = $this->session->userdata();
        $user_id     = $this->session->userdata('id');
        $user_role   = $this->session->userdata('user_role');
		
        $event_cat_id    = $this->input->post('event_id');
        $result = explode("|", $event_cat_id);
        $event_id=$result[0];  
        $category_id= $result[1];
		
        $sdate       = $this->input->post('start_date');
        $dateTime    = new DateTime($sdate);
        $start_date  = date_format($dateTime, 'Y-m-d');
        $edate       = $this->input->post('end_date');
        $dateTime    = new DateTime($edate);
        $end_date    = date_format($dateTime, 'Y-m-d');
        
/*      $start_time  = $this->input->post('start_time');
        $end_time    = $this->input->post('end_time'); */
        $plan_id    = $this->input->post('plan_id');

		$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/slider/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $status      = $this->input->post('status');
        $datas       = $this->advertisementmodel->add_plan_history($event_id, $category_id, $start_date, $end_date, $plan_id, $status, $user_id,$event_banner);

        $sta         = $datas['status'];
		$id         = $datas['plan_id'];
		
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Advertisement details added');
            redirect('advertisement/view_adv_history');
            //redirect('advertisement/add_advertisement_details/' . $id . '/' . $category_id . '', $datas);
        } else if ($sta == "AE") {
            $this->session->set_flashdata('msg', 'Dates are occupied! Please re-schedule your plan to some other dates. ');
            redirect('advertisement/assign_advertisement/' . $id );
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong! Please try again later.');
            redirect('advertisement/assign_advertisement/' . $id );
        }
    }
	
}
?>
