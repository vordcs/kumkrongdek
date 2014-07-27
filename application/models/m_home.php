<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class m_home extends CI_Model {

    public function get_slides($id = NULL) {
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        if ($id != NULL) {
            $this->db->where('slide_id', $id);
        }
        $this->db->where('slide_status', 'active');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_highlight() {
        $highlight = array();
        $news = $this->get_news(NULL, 1);

        if (count($news) > 0) {
            foreach ($news as $row) {
                $itemp = array(
                    'controller' => "News",
                    'id' => $row['news_id'],
                    'title' => $row['news_title'],
                    'subtitle' => $row['news_subtitle'],
                    'image' => $row['image_small'],
                    'type' => $this->get_news_type($row['news_type'])[0]['news_type_name'],
                    'date' => $this->m_datetime->DateThai($row['publish_date']),
                );
                array_push($highlight, $itemp);
            }
        }

        $activity = $this->get_activitys(NULL, 1);

        if (count($activity) > 0) {
            foreach ($activity as $row) {
                $itemp = array(
                    'controller' => "Activitys",
                    'id' => $row['activity_id'],
                    'title' => $row['activity_title'],
                    'subtitle' => $row['activity_subtitle'],
                    'image' => $row['image_small'],
                    'type' => $this->get_activity_type($row['activity_type'])[0]['activity_type_name'],
                    'date' => $this->m_datetime->DateThai($row['publish_date']),
                );
                array_push($highlight, $itemp);
            }
        }

        return $highlight;
    }

    public function get_news($id = NULL, $highlight = NULL) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img', 'left');
        $this->db->where('news_status', 'active');
        $this->db->where('publish_date <=', $this->m_datetime->getDateTodayTH());
        if ($id != NULL) {
            $this->db->where('news_id', $id);
        }
        if ($highlight != NULL) {
            $this->db->where('news_highlight', 1);
        }
        $this->db->order_by("publish_date", 'desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();

        return $itemp;
    }

    public function get_news_type($type_id = NULL) {
        $this->db->select('*');
        $this->db->from('news_types');
        $this->db->where('news_type_id !=', '1');
        $this->db->order_by('news_type_id');
        if ($type_id != NULL) {
            $this->db->where('news_type_id', $type_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_activitys($id = NULL, $highlight = NULL) {

        $this->db->select('*');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img', 'left');
        $this->db->where('activity_status', 'active');
        $this->db->where('publish_date <=', $this->m_datetime->getDateTodayTH());
        if ($id != NULL) {
            $this->db->where('activity_id', $id);
        }
        if ($highlight != NULL) {
            $this->db->where('activity_highlight', 1);
        }
        $this->db->order_by('publish_date desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_image_activity($activity_id = NULL) {
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id = images.image_id', 'left');
        $this->db->where('activity_status', 'active');
        if ($activity_id != NULL) {
            $this->db->where('activity_id', $activity_id);
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function get_activity_type($type_id = NULL) {

        $this->db->select('*');
        $this->db->from('activity_types');
        $this->db->order_by('activity_type_id');
        $this->db->where('activity_type_id >', 1);
        if ($type_id != NULL) {
            $this->db->where('activity_type_id', $type_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kindness($id = NULL) {
        $this->db->select('*');
        $this->db->from('kindness');
        $this->db->join('images', 'image_id = kindness_img');
        $this->db->where('kindness_status', 'active');
        $this->db->where('publish_date <=', $this->m_datetime->getDateTodayTH());
        if ($id != NULL) {
            $this->db->where('kindness_id', $id);
        }
        $this->db->order_by("publish_date desc,create_date desc");
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }
    
        public function get_newsletters($id = NULL) {

        $this->db->select('*');
        $this->db->from('journals');
        $this->db->join('files', 'file_id = journal_file');
        $this->db->where('publish_date <=', $this->m_datetime->getDateTodayTH());
        if ($id != NULL) {
            $this->db->where('journal_id', $id);
        }
        $this->db->order_by('journal_year desc,journal_mounth desc,journal_issue desc,journal_year_no desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

}
