<?php
/**
 * Class Assignment
 *
 * This class is a model for handling assignments.
 */
class Assignment extends CI_Model {
    /**
     * Get all assignments from the database.
     *
     * @return array An array of assignments
     */
    public function all(){
        $sql = "SELECT * FROM assignments;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get the count of assignments in the database.
     *
     * @return int The total number of assignments
     */
    public function count(){
        $sql = "SELECT COUNT(*) as total FROM assignments;";
        $query = $this->db->query($sql);
        return (int) $query->row()->total;
    }

    /**
     * Get distinct tracks from the assignments table.
     *
     * @return array An array of tracks
     */
    public function getTracks(){
        $sql = "SELECT DISTINCT track FROM assignments;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get distinct levels from the assignments table.
     *
     * @return array An array of levels
     */
    public function getLevel(){
        $sql = "SELECT DISTINCT level FROM assignments;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Filter assignments based on level and track.
     *
     * @param array $level An array of levels to filter by
     * @param string $track A track to filter by
     * @return array An array of filtered assignments
     */
    public function filter($level, $track){
        $level = $this->input->post('level');
        $track = $this->input->post('track');

        if(empty($level) && empty($track)){
            return $this->all();
        }

        $sql = "SELECT * FROM assignments WHERE ";

        if($level){
            $sql .= "level IN ('" . implode("','", $level) . "') AND ";
        }

        if($track){
            $sql .= "track = '$track' AND ";
        }

        $sql = rtrim($sql, ' AND ');
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
