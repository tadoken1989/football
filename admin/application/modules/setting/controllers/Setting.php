<?php

class Setting extends Authed_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_leagues');
        $this->load->model('mdl_country');
        $this->load->model('mdl_teams');
        $this->load->model('mdl_season');
        $this->load->model('mdl_league_team');
        $this->load->model('mdl_fixture_matches');
        $this->load->model('mdl_link_sopcast');
        $this->load->model('mdl_setting');
        $this->load->model('mdl_back_link');
    }

    public function index()
    {
        $list = $this->mdl_setting->order_by('created_at', 'DESC')->get_all();
        return $this->blade->set('list', $list)->render('index');
    }

    public function edit($id)
    {
        $item = $this->mdl_setting->where('id', $id)->get();
        return $this->blade->set('item', $item)->render('edit');

    }

    public function update($id)
    {
        $this->form_validation->set_rules('value', 'Value', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $link = $link = $this->mdl_setting->where('id', intval($id))->get();

        if ($link && $id) {
            $update_data = array(
                'value' => $this->input->post('value'),
            );
            if ($this->mdl_setting->update($update_data, $id)) {
                $this->session->set_flashdata('success', 'Updated');
                return redirect(site_url('setting'), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Update failed');
        redirect(site_url('setting'), 'refresh');
    }

    public function back_link()
    {
        $list = $this->mdl_back_link->order_by('created_at', 'DESC')->get_all();
        return $this->blade->set('list', $list)->render('back_link.index');
    }

    public function link_edit($id)
    {
        $item = $this->mdl_back_link->where('id', $id)->get();
        return $this->blade->set('item', $item)->render('back_link.edit');

    }

    public function link_update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('position', 'position', 'required');
        $this->form_validation->set_rules('sort_by', 'sort_by', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $link = $link = $this->mdl_back_link->where('id', intval($id))->get();

        if ($link && $id) {
            $update_data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'position' => $this->input->post('position'),
                'sort_by' => $this->input->post('sort_by'),
                'status' => $this->input->post('status'),
            );
            if ($this->mdl_back_link->update($update_data, $id)) {
                $this->session->set_flashdata('success', 'Updated');
                return redirect(site_url('setting/back-link'), 'refresh');
            }
        }
        $this->session->set_flashdata('error', 'Update failed');
        redirect(site_url('setting/back-link'), 'refresh');
    }

}