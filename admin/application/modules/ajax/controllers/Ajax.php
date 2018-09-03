<?php

class Ajax extends Authed_Controller
{

    protected $model;

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
        $this->load->model('mdl_tip');
        $this->load->model('mdl_television');

        $this->model = array(
            'link_sopcast' => $this->mdl_link_sopcast,
            'back_link' => $this->mdl_back_link,
            'tip' => $this->mdl_tip,
            'television' => $this->mdl_television
        );
    }

    public function active()
    {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('model', 'Model', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 400,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $id = $this->input->post('id');
        $model = $this->input->post('model');
        $status = $this->input->post('status');
        if (array_key_exists($model, $this->model)) {
            $this->db->trans_start();
            $success = $this->db->set('status', intval($status))
                                ->where('id_link', $id)
                                ->update($this->model[$model]->table);
            $this->db->trans_complete();
            if ($success) {

                if ($status == 1) {
                    echo json_encode(array(
                        'status' => 200,
                        'state' => 0,
                        'message' => 'Done'
                    ));
                } else {
                    echo json_encode(array(
                        'status' => 200,
                        'state' => 1,
                        'message' => 'Done'
                    ));
                }

            }
            exit();
        }
        echo json_encode(array(
            'result' => 400,
            'message' => 'System error'
        ));
        exit();
    }
}