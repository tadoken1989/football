<?php

class League extends Authed_Controller
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
        $list = $this->mdl_leagues->with_country();
        if (!is_null($search)) {
            $list = $list->where('name', 'LIKE', $search);
        }
        $list = $list->limit($_GET['length'], $_GET['start'])->as_array()->get_all();
        $data = array();
        if ($list && count($list) > 0) {
            foreach ($list as $key => $league) {
                $row = $league;
                $row['no'] = $key + 1;
                $row['country'] = $row['country']->name;
                if ($row['status'] == 1) {
                    $row['state'] = '<td><a id="status-' . $row["id"] . '" class="label label-success pull-right btn-hidden" data-id=' . $row["id"] . '><i
                                                        class="fa fa-check"></i> active</a></td>';
                } else {
                    $row['state'] = '<td><a id="status-' . $row["id"] . '" class="label label-waring pull-right btn-enable" data-id=' . $row["id"] . '><i
                                                        class="fa fa-check"></i> hidden</a></td>';
                }
                $row['action'] = '<td><a id="edit-' . $row["id"] . '" class="label label-primary pull-right btn-edit" data-id="' . $row["id"] . '" data-name="' . $row["name"] . '"><i
                                                        class="fa fa-edit"></i> edit</a></td>' . '<td><a style="margin-right: 10px" id="delete-' . $row["id"] . '" class="label label-danger pull-right btn-delete" data-id=' . $row["id"] . '" data-name="' . $row["name"] . '"><i
                                                        class="fa fa-remove"></i> delete</a></td>';
                $data[] = $row;
            }
        } else {
            $data = [];
        }
        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->mdl_leagues->count_rows(),
            "recordsFiltered" => $this->mdl_leagues->count_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_country()
    {
        return $this->blade->render('list_country');

    }

    public function list_season()
    {
        return $this->blade->render('list_season');

    }

    public function get_season()
    {

        $list = $this->mdl_season->limit($_GET['length'], $_GET['start'])->as_array()->get_all();
        $data = array();
        foreach ($list as $key => $season) {
            $row = $season;
            $row['no'] = $key + 1;
            if ($row['is_current'] == 1) {
                $row['is_current'] = '<td><span id="status-' . $row["season_id"] . '" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> Yes</span></td>';
            } else {
                $row['is_current'] = '<td><span id="status-' . $row["season_id"] . '" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> No</span></td>';
            }

            if ($row['status'] == 1) {
                $row['state'] = '<td><span id="status-' . $row["season_id"] . '" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> active</span></td>';
            } else {
                $row['state'] = '<td><span id="status-' . $row["season_id"] . '" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> hidden</span></td>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->mdl_season->count_rows(),
            "recordsFiltered" => $this->mdl_season->count_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_country()
    {

        $search = $this->input->get('search[value]');

        $list = $this->mdl_country->with_region();

        if (!is_null($search)) {
            $list = $list->where('name', 'LIKE', $search);
        }
        $list = $list->limit($_GET['length'], $_GET['start'])->as_array()->get_all();
        $data = array();

        if ($list && count($list) > 0) {
            foreach ($list as $key => $country) {
                $row = $country;
                $row['no'] = $key + 1;
                $row['region_name'] = $country['region']->name;
                if ($row['status'] == 1) {
                    $row['state'] = '<td><span id="status-' . $row["id"] . '" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> active</span></td>';
                } else {
                    $row['state'] = '<td><span id="status-' . $row["id"] . '" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> hidden</span></td>';
                }
                $row['action'] = '<td><a id="edit-' . $row["id"] . '" class="label label-primary pull-right btn-edit" data-id="' . $row["id"] . '" data-name="' . $row["name"] . '"><i
                                                        class="fa fa-edit"></i> edit</a></td>';
                $data[] = $row;
            }
        } else {
            $data = [];
        }
        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->mdl_country->count_rows(),
            "recordsFiltered" => $this->mdl_country->count_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function update()
    {
        $id = $this->input->get('id');
        $league = $this->mdl_leagues->where('id', $id);
        $this->db->trans_start();
        if ($league->get()->status) {
            $this->db->set('status', 0)
                ->where('id', $id)
                ->update('leagues');
        } else {
            $this->db->set('status', 1)
                ->where('id', $id)
                ->update('leagues');
        }
        $this->db->trans_complete();

        return $league;
    }

    public function updateLeague()
    {
        $id = $this->input->post('id');
        $league = $this->mdl_leagues->where('id', $id);
        $this->db->trans_start();
        $this->db->set('name', $this->input->post('name'))
            ->set('alias', slug($this->input->post('name')))
            ->where('id', $id)
            ->update('leagues');
        $this->db->trans_complete();

        return $league;
    }

    public function updateNation()
    {
        $id = $this->input->post('id');
        $country = $this->mdl_country->where('id', $id);
        $this->db->trans_start();
        $this->db->set('name', $this->input->post('name'))
            ->where('id', $id)
            ->update('country');
        $this->db->trans_complete();

        return $country;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->trans_start();
        $this->db->where('league_id', $id)->delete('league_group_cup');
        $this->db->where('league_id', $id)->delete('league_info');
        $this->db->where('league_id', $id)->delete('league_team');
        $this->db->where('league_id', $id)->delete('league_team_standing');
        $this->db->where('league_id', $id)->delete('fixture_matches');
        $this->db->where('league_id', $id)->delete('matches_history');
        $this->db->where('league_id', $id)->delete('top_scorers');
        $this->db->where('id', $id)->delete('leagues');
        $this->db->trans_complete();

        return true;
    }
}