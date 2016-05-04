<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('item_model');
    $this->load->model('message_model');
    $this->load->model('account_model');
    $this->load->helper('text');
    $this->load->helper('links');
    $this->load->library('pagination');
  }

  public function index(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-profile-settings';
    $data['active_link'] = 'profile';
    $data['title_link'] = 'Profile';
    $data['user'] = $this->_get_session_data();
    $data['is_logged_in'] = ($this->_get_session_data() ? true : false);
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function profile(){
    $this->index();
  }

  public function account(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-account-settings';
    $data['active_link'] = 'account';
    $data['title_link'] = 'Account';

    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);

  }

  public function email(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-email-settings';
    $data['active_link'] = 'email';
    $data['title_link'] = 'account';

    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function wishlist(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-wishlist-settings';
    $data['active_link'] = 'wishlist';
    $data['title_link'] = 'Wishlist';
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function stars(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-stars-settings';
    $data['active_link'] = 'stars';
    $data['title_link'] = 'Stars';
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function my_offers(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-my-offers-settings';
    $data['active_link'] = 'my_offers';
    $data['title_link'] = 'My Offers';
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function offers(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-offers-settings';
    $data['active_link'] = 'offers';
    $data['title_link'] = 'Offers';
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

  public function profile_logs(){
    $this->_data['title'] = 'BarterKings PH - My Dashboard';
    $data['template_view'] = 'dashboard/dashboard-profile-logs-settings';
    $data['active_link'] = 'profile_logs';
    $data['title_link'] = 'Profile Logs';
    $data['settings_labels'] = $this->account_model->get_settings_labels();
    $this->_load_view('dashboard/index', $data);
  }

}
