<?php

class Notes_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'notes';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $notes_table = $this->db->dbprefix('notes');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $notes_table.id=$id";
        }

        $project_id = get_array_value($options, "project_id");
        if ($project_id) {
            $where .= " AND $notes_table.project_id=$project_id";
        }

        $created_by = get_array_value($options, "created_by");
        if ($created_by) {
            $where .= " AND $notes_table.created_by=$created_by";
        }

        $sql = "SELECT $notes_table.*
        FROM $notes_table
        WHERE $notes_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    function get_label_suggestions($user_id) {
        $notes_table = $this->db->dbprefix('notes');
        $sql = "SELECT GROUP_CONCAT(labels) as label_groups
        FROM $notes_table
        WHERE $notes_table.deleted=0 AND $notes_table.created_by=$user_id";
        return $this->db->query($sql)->row()->label_groups;
    }
}
