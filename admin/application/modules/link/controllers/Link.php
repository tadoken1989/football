<?php

class Link extends Authed_Controller
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
    }

    public function index()
    {
        $link_sopcast = $this->mdl_link_sopcast->order_by('datetime', 'DESC')->get_all();
        return $this->blade->set('link_sopcast', $link_sopcast)->render('index');
    }

    public function edit($id)
    {
        $link = $this->mdl_link_sopcast->where('id_link', $id)->get();
        return $this->blade->set('link', $link)->render('edit');

    }

    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('datetime', 'Datetime', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $link = $link = $this->mdl_link_sopcast->where('id_link', intval($id))->get();

        if ($link && $id) {
            $update_data = array(
                'title' => $this->input->post('title'),
                'alias' => slug($this->input->post('title')),
                'datetime' => date('Y-m-d H:i:s', strtotime($this->input->post('datetime'))),
                'status' => $this->input->post('status'),
                'content' => $this->input->post('content'),
            );
            if ($this->mdl_link_sopcast->update($update_data, $id)) {
                $this->session->set_flashdata('success', 'Updated');
                return redirect(site_url('link'));
            }
        }
        $this->session->set_flashdata('error', 'Update failed');
        redirect(site_url('link'));
    }

    public function add()
    {
        return $this->blade->render('add');
    }

    public function addAction()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('datetime', 'Datetime', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $insert_data = array(
            'title' => $this->input->post('title'),
            'alias' => slug($this->input->post('title')),
            'datetime' => date('Y-m-d H:i:s', strtotime($this->input->post('datetime'))),
            'status' => $this->input->post('status'),
            'content' => $this->input->post('content'),
        );
        if ($this->mdl_link_sopcast->insert($insert_data)) {
            $this->session->set_flashdata('success', 'Insert done');
            return redirect(site_url('link'));
        }
        $this->session->set_flashdata('error', 'Insert failed');
        redirect(site_url('link'));
    }
}