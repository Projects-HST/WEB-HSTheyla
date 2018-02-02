<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('eventsmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    //-------------------------Events Add / Update---------------------------------

    public function home()
    {
        $datas                  = $this->session->userdata();
        $user_id                = $this->session->userdata('id');
        $user_role              = $this->session->userdata('user_role');
        $datas['country_list']  = $this->eventsmodel->getall_country_list();
        $datas['category_list'] = $this->eventsmodel->getall_category_list();
        // echo '<pre>'; print_r($datas['country_list']); exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/add_events', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function add_events()
    {
        $datas          = $this->session->userdata();
        $user_id        = $this->session->userdata('id');
        $user_role      = $this->session->userdata('user_role');
        $event_name     = $this->db->escape_str($this->input->post('event_name'));
        $category       = $this->input->post('category');
        $country        = $this->input->post('country');
        $city           = $this->input->post('city');
        $venue          = $this->input->post('venue');
        $address        = $this->db->escape_str($this->input->post('address'));
        $description    = $this->db->escape_str($this->input->post('description'));
        $eventcost      = $this->input->post('eventcost');
        $sdate          = $this->input->post('start_date');
        $dateTime       = new DateTime($sdate);
        $start_date     = date_format($dateTime, 'Y-m-d');
        $edate          = $this->input->post('end_date');
        $dateTime       = new DateTime($edate);
        $end_date       = date_format($dateTime, 'Y-m-d');
        $start_time     = $this->input->post('start_time');
        $end_time       = $this->input->post('end_time');
        //echo $start_time; echo'<br>'; echo $end_time; exit;
        $txtLatitude    = $this->input->post('txtLatitude');
        $txtLongitude   = $this->input->post('txtLongitude');
        $pcontact_cell  = $this->input->post('pcontact_cell');
        $scontact_cell  = $this->input->post('scontact_cell');
        $contact_person = $this->input->post('contact_person');
        $email          = $this->input->post('email');
        //echo $city; exit;

        $event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/banner/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $eadv_status   = $this->input->post('eadv_status');
        $booking_sts   = $this->input->post('booking_sts');
        $hotspot_sts   = $this->input->post('hotspot_sts');
        $colour_scheme = $this->input->post('colour_scheme');
        $event_status  = $this->input->post('event_status');
        $datas         = $this->eventsmodel->insert_events_details($event_name, $category, $country, $city, $venue, $address, $description, $eventcost, $start_date, $end_date, $start_time, $end_time, $txtLatitude, $txtLongitude, $pcontact_cell, $scontact_cell, $contact_person, $email, $event_banner, $colour_scheme, $event_status, $eadv_status, $booking_sts, $hotspot_sts, $user_id, $user_role);
        $sta           = $datas['status'];
        // print_r($sta);exit;
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Added Successfully');
            redirect('events/view_events');
        } else if ($sta == "Already Exist") {
            $this->session->set_flashdata('msg', 'Already Exist');
            redirect('events/view_events');
        } else {
            $this->session->set_flashdata('msg', 'Faild To Add');
            redirect('events/view_events');
        }
    }
    public function get_city_name()
    {
        $country_id  = $this->input->post('country_id');
        //echo $classid;exit;
        $data['res'] = $this->eventsmodel->getcityname($country_id);
        echo json_encode($data['res']);
    }


    public function view_events()
    {
        $datas            = $this->session->userdata();
        $user_id          = $this->session->userdata('id');
        $user_role        = $this->session->userdata('user_role');
        $datas['result']  = $this->eventsmodel->getall_events_details();
        $datas['sts']  = $this->eventsmodel->getall_archived_events_details();
        $datas['popular'] = $this->eventsmodel->events_popularity();
        //echo '<pre>'; print_r($datas['result']); exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/view_events', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }

    public function organizer_events()
    {
        $datas            = $this->session->userdata();
        $user_id          = $this->session->userdata('id');
        $user_role        = $this->session->userdata('user_role');
        $datas['org']  = $this->eventsmodel->getall_organizer_events_details();
        $datas['popular'] = $this->eventsmodel->events_popularity();
        //echo '<pre>'; print_r($datas['org']); exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/organizer_events', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }


    public function edit_events($id)
    {
        $id                     = base64_decode($id);
        $datas                  = $this->session->userdata();
        $user_id                = $this->session->userdata('id');
        $user_role              = $this->session->userdata('user_role');
        $datas['country_list']  = $this->eventsmodel->getall_country_list();
        $datas['category_list'] = $this->eventsmodel->getall_category_list();
        $datas['city_list']     = $this->eventsmodel->getall_city_list();
        $datas['edit']          = $this->eventsmodel->edit_events_details($id);
        //echo '<pre>'; print_r($datas['city_list']); exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/edit_events', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function update_events()
    {
        $datas          = $this->session->userdata();
        $user_id        = $this->session->userdata('id');
        $user_role      = $this->session->userdata('user_role');
        $event_name     = $this->db->escape_str($this->input->post('event_name'));
        $category       = $this->input->post('category');
        $country        = $this->input->post('country');
        $city           = $this->input->post('city');
        $venue          = $this->input->post('venue');
        $address        = $this->db->escape_str($this->input->post('address'));
        $description    = $this->db->escape_str($this->input->post('description'));
        $eventcost      = $this->input->post('eventcost');
        $sdate          = $this->input->post('start_date');
        $dateTime       = new DateTime($sdate);
        $start_date     = date_format($dateTime, 'Y-m-d');
        $edate          = $this->input->post('end_date');
        $dateTime       = new DateTime($edate);
        $end_date       = date_format($dateTime, 'Y-m-d');
        $start_time     = $this->input->post('start_time');
        $end_time       = $this->input->post('end_time');
        //echo $start_time; echo'<br>'; echo $end_time; exit;
        $txtLatitude    = $this->input->post('txtLatitude');
        $txtLongitude   = $this->input->post('txtLongitude');
        $pcontact_cell  = $this->input->post('pcontact_cell');
        $scontact_cell  = $this->input->post('scontact_cell');
        $contact_person = $this->input->post('contact_person');
        $email          = $this->input->post('email');
        $currentcpic    = $this->input->post('currentcpic');
        $eventid        = $this->input->post('eventid');
        $event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name . '.' .$temp;
        $uploaddir      = 'assets/events/banner/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);
        $eadv_status   = $this->input->post('eadv_status');

        $booking_sts   = $this->input->post('booking_sts');
        //echo $booking_sts ;exit;
        $hotspot_sts   = $this->input->post('hotspot_sts');
        $colour_scheme = $this->input->post('colour_scheme');
        $event_status  = $this->input->post('event_status');
        if (empty($event_pic)) {
            $event_banner = $currentcpic;
        } else {
            $event_banner = $event_banner;
        }
        //echo $event_banner;exit;
        $datas = $this->eventsmodel->update_events_details($eventid, $event_name, $category, $country, $city, $venue, $address, $description, $eventcost, $start_date, $end_date, $start_time, $end_time, $txtLatitude, $txtLongitude, $pcontact_cell, $scontact_cell, $contact_person, $email, $event_banner, $colour_scheme, $event_status, $eadv_status, $booking_sts, $hotspot_sts, $user_id, $user_role);
        $sta   = $datas['status'];
        // print_r($sta);exit;
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Update Successfully');
            redirect('events/view_events');
        } else if ($sta == "Already Exist") {
            $this->session->set_flashdata('msg', 'Already Exist');
            redirect('events/view_events');
        } else {
            $this->session->set_flashdata('msg', 'Faild To Update');
            redirect('events/view_events');
        }
    }
    public function view_single_events($id)
    {
        $id            = base64_decode($id);
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('id');
        $user_role     = $this->session->userdata('user_role');
        $datas['view'] = $this->eventsmodel->view_single_events_plans($id);
        //print_r($datas['edit']);exit;
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/events_details', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function delete_events()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $id        = $this->input->post('eventid');
        $datas     = $this->eventsmodel->delete_single_events_plans($id);
        $sta       = $datas['status'];
        if ($sta == "success") {
            //$this->session->set_flashdata('msg','Deleted Successfully');
            //redirect('events/view_events');
            echo "success";
        } else {
            //$this->session->set_flashdata('msg','Faild To Delete');
            //redirect('events/view_events');
            echo "Faild";
        }
    }
    public function add_events_gallery($id)
    {
        $id                = $id;
        $datas             = $this->session->userdata();
        $user_id           = $this->session->userdata('id');
        $user_role         = $this->session->userdata('user_role');
        $datas['evnid']    = $id;
        $datas['view_pic'] = $this->eventsmodel->view_upload_events_pic($id);
        $datas['eventname'] = $this->eventsmodel->get_event_name($id);

        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/add_gallery', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
    public function add_gallery()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $eventid   = $this->input->post('eventid');
        if (!empty($_FILES['eventpicture']['name'])) {
            $allowedExts   = array(
                "gif",
                "jpeg",
                "jpg",
                "png"
            );
            $error_uploads = 0;
            $total_uploads = array();
            $upload_path   = 'assets/events/gallery/';
            foreach ($_FILES['eventpicture']['name'] as $key => $value) {
                $temp1 = pathinfo($_FILES['eventpicture']['name'][$key], PATHINFO_EXTENSION);
                $temp      = explode(".", $_FILES['eventpicture']['name'][$key]);
                $extension = end($temp);
                if ($_FILES["eventpicture"]["type"][$key] != "image/gif" && $_FILES["eventpicture"]["type"][$key] != "image/jpeg" && $_FILES["eventpicture"]["type"][$key] != "image/jpg" && $_FILES["eventpicture"]["type"][$key] != "image/pjpeg" && $_FILES["eventpicture"]["type"][$key] != "image/x-png" && $_FILES["eventpicture"]["type"][$key] != "image/png" && !in_array($extension, $allowedExts)) {
                    $error_uploads++;
                    continue;
                }
                $file_name = time() . rand(1, 5) . rand(6, 10) . '.' .$temp1;
                if (move_uploaded_file($_FILES["eventpicture"]['tmp_name'][$key], $upload_path . $file_name)) {
                    $total_uploads[] = $file_name;
                } else {
                    $error_uploads++;
                }
            }
            //print_r($total_uploads);exit;
            $datas = $this->eventsmodel->upload_events_pic($eventid, $total_uploads);
            $sta   = $datas['status'];
            if ($sta == "success") {
                $this->session->set_flashdata('msg', 'Added Successfully');
                redirect('events/add_events_gallery/' . $eventid . '');
            } else {
                $this->session->set_flashdata('msg', 'Faild To Add');
                redirect('events/add_events_gallery/' . $eventid . '');
            }
        }
    }
    public function delete_events_img($id, $eventid)
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('id');
        $user_role = $this->session->userdata('user_role');
        $datas     = $this->eventsmodel->delete_events_pic($id, $eventid);
        $sta       = $datas['status'];
        if ($sta == "success") {
            $this->session->set_flashdata('msg', 'Deleted Successfully');
            redirect('events/add_events_gallery/' . $eventid . '');
        } else {
            $this->session->set_flashdata('msg', 'Faild To Delete');
            redirect('events/add_events_gallery/' . $eventid . '');
        }
    }
    public function view_events_reviews($id)
    {
        $id             = base64_decode($id);
        $datas          = $this->session->userdata();
        $user_id        = $this->session->userdata('id');
        $user_role      = $this->session->userdata('user_role');
        $datas['views'] = $this->eventsmodel->view_all_reviews($id);
        //echo'<pre>';print_r($datas['views']);exit();
        if ($user_role == 1 || $user_role == 4) {
            $this->load->view('header');
            $this->load->view('events/events_reviews', $datas);
            $this->load->view('footer');
        } else {
            redirect('/');
        }
    }
}
?>
