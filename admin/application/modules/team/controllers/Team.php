<?php

class Team extends Authed_Controller
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
        $this->load->model('mdl_television');
        $this->load->model('mdl_tip');
    }

    public function index()
    {
        return $this->blade->render('index');
    }

    public function getData()
    {
        $search = $this->input->get('search[value]');
        $list = $this->mdl_teams->with_country()->limit($_GET['length'], $_GET['start']);
        if (!is_null($search)) {
            $list = $list->where('name', 'LIKE', $search);
        }
        $list = $list->as_array()->get_all();
        $data = array();
        if ($list && count($list > 0)) {


            foreach ($list as $key => $team) {
                $row = $team;
                $row['no'] = $key + 1;
                $row['country'] = $team['country']->name;
                $row['team_link'] = '<a href="/team/player-of-team/' . $row["team_id"] . '">' . $team['name'] . '</a>';
                if ($row['status'] == 1) {
                    $row['state'] = '<td><span id="status-' . $row["team_id"] . '" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> active</span></td>';
                } else {
                    $row['state'] = '<td><span id="status-' . $row["team_id"] . '" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> hidden</span></td>';
                }
                $row['action'] = '<td><a href="/team/edit/' . $row['team_id'] . '" class="label label-primary pull-right btn-edit"><i
                                                        class="fa fa-edit"></i> edit</a></td>';
                $data[] = $row;
            }
        } else {
            $data = [];
        }

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->mdl_teams->count_rows(),
            "recordsFiltered" => $this->mdl_teams->count_rows(),
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }

    public function player_of_team($teamId)
    {

        $team = $this->mdl_teams->with_country()->with_players()->where('team_id', intval($teamId))->get();
        return $this->blade->set('team', $team)->render('player_of_team');

    }

    public function edit($id)
    {
        $team = $this->mdl_teams->where('team_id', $id)->get();
        return $this->blade->set('team', $team)->render('edit');

    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'result' => FALSE,
                'message' => validation_errors()
            ));
            return FALSE;
        }
        $team = $this->mdl_teams->where('team_id', $id)->get();

        $link = $team->image;

        if ($_FILES['image']['tmp_name']) {
            $image = $_FILES['image'];
        }
        if ($image) {
            @mkdir('./uploads/teams/', 0755, TRUE);

            $target_dir = "./uploads/teams/";

            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $link = './uploads/teams/' . $team->alias . '.' . $imageFileType;
                $result = copy($target_file, $link);
                if ($result) {
                    $link = substr($link, 2);
                }
            }


        }

        if ($team && $id) {
            $update_data = array(
                'name' => $this->input->post('name'),
                'stadium' => $this->input->post('stadium'),
                'wiki' => $this->input->post('wiki'),
                'website' => $this->input->post('website'),
                'image' => $link,
                'status' => $this->input->post('status'),
                'alias' => slug($this->input->post('name')),
            );
            if ($this->mdl_teams->update($update_data, $id)) {
                $this->session->set_flashdata('success', 'Updated Team');
                return redirect(site_url('team'));
            }
        }
        $this->session->set_flashdata('error', 'Update failed');
        redirect(site_url('link'));
    }
}