<?php
require_once __DIR__ . '/Database.php';
 class Boilerplate {
    protected $db;
    protected $table;
    protected $category;

	public function __construct($category) {
	$this->category = $category;
	$this->db = new Database();
	}

    public function getCategory() {
        return $this->category;
    }

    public function getAllCategories() {
        $categoriesArray = $this->db->query('SELECT category FROM boilerplates GROUP BY(category)')->fetchAll();
        return $categoriesArray;
    }

    public function getCode($sorting) {
        $code = $this->db->query('SELECT * FROM boilerplates WHERE category = ? AND sorting = ? ORDER BY boilerplates.sorting DESC LIMIT 1', $this->category, $sorting)->fetchArray()['code'];
        return $code;
    }

    public function getBoilerplates() {
        $boilerplates = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting ASC', $this->category)->fetchAll();
        foreach ($boilerplates as $boilerplate) {
            $html = "<tr class='content-row d-flex'>".
                        "<th class='col-1'>" . $boilerplate['sorting'] . "</th>".
                        "<td class='col-7'>" . $boilerplate['name'] . "</td>".
                        "<td class='col-1'><i class='fas fa-file-code' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "editModal_" . $boilerplate['sorting'] . "'></i></td>".
                        "<td class='col-1'><i class='far fa-clipboard' onclick='copyToClipboard(" . $boilerplate['sorting'] . ")'></i></td>".
                        "<td class='col-1'><i class='far fa-trash-alt' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "removeModal_" . $boilerplate['sorting'] . "'></i></td>".
                        "<td class='col-1'><i class='fas fa-sort'></i></td>".
                    "</tr>";
            echo $html;
        }
        //return $html_all;
    }
    public function getBoilerplatesString() {
        $boilerplates = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting ASC', $this->category)->fetchAll();
        $html_all = '';
        foreach ($boilerplates as $boilerplate) {
            $html = "<tr class='content-row d-flex'>".
                        "<th class='col-1'>" . $boilerplate['sorting'] . "</th>".
                        "<td class='col-7'>" . $boilerplate['name'] . "</td>".
                        "<td class='col-1'><i class='fas fa-file-code' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "editModal_" . $boilerplate['sorting'] . "'></i></td>".
                        "<td class='col-1'><i class='far fa-clipboard' onclick='copyToClipboard(" . $boilerplate['sorting'] . ")'></i></td>".
                        "<td class='col-1'><i class='far fa-trash-alt' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "removeModal_" . $boilerplate['sorting'] . "'></i></td>".
                        "<td class='col-1'><i class='fas fa-sort'></i></td>".
                    "</tr>";
            $html_all .= $html;
        }
        return $html_all;
    }
    public function getBoilerplatesModals() {
        $boilerplates = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting ASC', $this->category)->fetchAll();
        foreach ($boilerplates as $boilerplate) {
            echo "<div class='modal fade' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                    "<div class='modal-dialog' role='document'>".
                        "<div class='modal-content'>".
                            "<form method='POST'>".
                                "<div class='modal-header'>".
                                    "<h5 class='modal-title' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label'>Edit " . $this->category . " Boilerplate</h5>".
                                "</div>".
                                "<div class='modal-body'>".
                                    "<div class='form-group'>".
                                        "<input type='text' class='form-control' id='" . $this->category . "_boilerplate_name_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_name' value='" . $boilerplate['name'] ."'>".
                                    "</div>".
                                    "<div class='form-group'>".
                                        "<textarea class='form-control' id='" . $this->category . "_boilerplate_code_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_code' rows='5'>" . $boilerplate['code'] . "</textarea>".
                                    "</div>".
                                "</div>".
                                "<div class='modal-footer'>".
                                    "<input type='hidden' class='form-control' id='edit_boilerplate_category_" . $boilerplate['sorting'] . "' name='edit_boilerplate_category' value='" . $this->category . "'>".
                                    "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_edit_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>Close</button>".
                                    "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_edit_save_" . $boilerplate['sorting'] . "' onclick='editBoilerplate(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>Save</button>".
                                "</div>".
                            "</form>".
                        "</div>".
                    "</div>".
                "</div>".
                "<div class='modal fade' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                    "<div class='modal-dialog' role='document'>".
                        "<div class='modal-content'>".
                            "<form method='POST'>".
                                "<div class='modal-header'>".
                                    "<h5 class='modal-title' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label'>Remove Boilerplate?</h5>".
                                "</div>".
                                "<div class='modal-body'>".
                                "</div>".
                                "<div class='modal-footer'>".
                                    "<input type='hidden' class='form-control' id='remove_boilerplate_category_" . $boilerplate['sorting'] . "' name='remove_boilerplate_category' value='" . $this->category . "'>".
                                    "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_remove_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>NO</button>".
                                    "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_remove_save_" . $boilerplate['sorting'] . "' onclick='removeBoilerplateEvent(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ")' data-dismiss='modal'>YES</button>".
                                "</div>".
                            "</form>".
                        "</div>".
                    "</div>".
                "</div>";
        }
    }

    public function getBoilerplatesModalsString() {
        $boilerplates = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting ASC', $this->category)->fetchAll();
        $html_all = '';
        foreach ($boilerplates as $boilerplate) {
            $html = "<div class='modal fade' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                    "<div class='modal-dialog' role='document'>".
                        "<div class='modal-content'>".
                            "<form method='POST'>".
                                "<div class='modal-header'>".
                                    "<h5 class='modal-title' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label'>Edit " . $this->category . " Boilerplate</h5>".
                                "</div>".
                                "<div class='modal-body'>".
                                    "<div class='form-group'>".
                                        "<input type='text' class='form-control' id='" . $this->category . "_boilerplate_name_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_name' value='" . $boilerplate['name'] ."'>".
                                    "</div>".
                                    "<div class='form-group'>".
                                        "<textarea class='form-control' id='" . $this->category . "_boilerplate_code_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_code' rows='5'>" . $boilerplate['code'] . "</textarea>".
                                    "</div>".
                                "</div>".
                                "<div class='modal-footer'>".
                                    "<input type='hidden' class='form-control' id='edit_boilerplate_category_" . $boilerplate['sorting'] . "' name='edit_boilerplate_category' value='" . $this->category . "'>".
                                    "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_edit_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>Close</button>".
                                    "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_edit_save_" . $boilerplate['sorting'] . "' onclick='editBoilerplate(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>Save</button>".
                                "</div>".
                            "</form>".
                        "</div>".
                    "</div>".
                "</div>".
                "<div class='modal fade' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                    "<div class='modal-dialog' role='document'>".
                        "<div class='modal-content'>".
                            "<form method='POST'>".
                                "<div class='modal-header'>".
                                    "<h5 class='modal-title' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label'>Remove Boilerplate?</h5>".
                                "</div>".
                                "<div class='modal-body'>".
                                "</div>".
                                "<div class='modal-footer'>".
                                    "<input type='hidden' class='form-control' id='remove_boilerplate_category_" . $boilerplate['sorting'] . "' name='remove_boilerplate_category' value='" . $this->category . "'>".
                                    "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_remove_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>NO</button>".
                                    "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_remove_save_" . $boilerplate['sorting'] . "' onclick='removeBoilerplateEvent(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ")' data-dismiss='modal'>YES</button>".
                                "</div>".
                            "</form>".
                        "</div>".
                    "</div>".
                "</div>";
            $html_all .= $html;
        }
        return $html_all;
    }

    public function getLastBoilerplate() {
        $boilerplate = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting DESC LIMIT 1', $this->category)->fetchArray();
        $html =  "<tr class='content-row d-flex'>".
                 "<th class='col-1'>" . $boilerplate['sorting'] . "</th>".
                 "<td class='col-7'>" . $boilerplate['name'] . "</td>".
                 "<td class='col-1'><i class='fas fa-file-code' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "editModal_" . $boilerplate['sorting'] . "'></i></td>".
                 "<td class='col-1'><i class='far fa-clipboard' onclick='copyToClipboard(" . $boilerplate['sorting'] . ")'></i></td>".
                 "<td class='col-1'><i class='far fa-trash-alt' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "removeModal_" . $boilerplate['sorting'] . "'></i></td>".
                 "<td class='col-1'><i class='fas fa-sort'></i></td>".
                 "</tr>";
        return $html;
    }

    public function getLastModal($modal_type) {
        $boilerplate = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting DESC LIMIT 1', $this->category)->fetchArray();
        if($modal_type == 'edit') {
            $html = "<div class='modal fade' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                        "<div class='modal-dialog' role='document'>".
                            "<div class='modal-content'>".
                                "<form method='POST'>".
                                    "<div class='modal-header'>".
                                        "<h5 class='modal-title' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label'>Edit " . $this->category . " Boilerplate</h5>".
                                    "</div>".
                                    "<div class='modal-body'>".
                                        "<div class='form-group'>".
                                            "<input type='text' class='form-control' id='" . $this->category . "_boilerplate_name_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_name' value='" . $boilerplate['name'] ."'>".
                                        "</div>".
                                        "<div class='form-group'>".
                                            "<textarea class='form-control' id='" . $this->category . "_boilerplate_code_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_code' rows='5'>" . $boilerplate['code'] . "</textarea>".
                                        "</div>".
                                    "</div>".
                                    "<div class='modal-footer'>".
                                        "<input type='hidden' class='form-control' id='edit_boilerplate_category_" . $boilerplate['sorting'] . "' name='edit_boilerplate_category' value='" . $this->category . "'>".
                                        "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_edit_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>Close</button>".
                                        "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_edit_save_" . $boilerplate['sorting'] . "' onclick='editBoilerplate(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>Save</button>".
                                    "</div>".
                                "</form>".
                            "</div>".
                        "</div>".
                    "</div>";
        }
        else if ($modal_type == 'remove') {
            $html = "<div class='modal fade' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                        "<div class='modal-dialog' role='document'>".
                            "<div class='modal-content'>".
                                "<form method='POST'>".
                                    "<div class='modal-header'>".
                                        "<h5 class='modal-title' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label'>Remove Boilerplate?</h5>".
                                    "</div>".
                                    "<div class='modal-body'>".
                                    "</div>".
                                    "<div class='modal-footer'>".
                                        "<input type='hidden' class='form-control' id='remove_boilerplate_category_" . $boilerplate['sorting'] . "' name='remove_boilerplate_category' value='" . $this->category . "'>".
                                        "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_remove_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>NO</button>".
                                        "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_remove_save_" . $boilerplate['sorting'] . "' onclick='removeBoilerplateEvent(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>YES</button>".
                                    "</div>".
                                "</form>".
                            "</div>".
                        "</div>".
                    "</div>";
        }
        return $html;
    }

    public function setBoilerplate($boilerplate_name, $boilerplate_code) {
        $boilerplate = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting DESC LIMIT 1', $this->category)->fetchArray();
        if ($boilerplate) {
            $sorting_id = $boilerplate['sorting'] + 1;
        }
        else {
            $sorting_id = 1;
        }
        // Insert new record
        $insert = $this->db->query('INSERT INTO boilerplates (category,name,code,sorting) VALUES (?,?,?,?)', $this->category, $boilerplate_name, $boilerplate_code,$sorting_id);
        return $insert;
    }

    public function updateBoilerplate($boilerplate_id, $boilerplate_name, $boilerplate_code) {
        // Update record
        $update = $this->db->query('UPDATE boilerplates SET name=?, code=? WHERE id=?', $boilerplate_name, $boilerplate_code, $boilerplate_id);
        return $update;
    }

    public function removeBoilerplate($boilerplate_id) {
        // Remove record
        $update = $this->db->query('DELETE FROM boilerplates WHERE id=?', $boilerplate_id);
        return $update;
    }

    public function swapBoilerplate($sorting_a, $sorting_b) {
        $boilerplate_a = $this->db->query('SELECT * FROM boilerplates WHERE category = ? AND sorting = ?', $this->category, $sorting_a)->fetchArray();
        $boilerplate_b = $this->db->query('SELECT * FROM boilerplates WHERE category = ? AND sorting = ?', $this->category, $sorting_b)->fetchArray();
        $id_a = $boilerplate_a['id'];
        $id_b = $boilerplate_b['id'];
        $this->db->query('UPDATE boilerplates SET sorting=? WHERE id=?', $sorting_b, $id_a);
        $this->db->query('UPDATE boilerplates SET sorting=? WHERE id=?', $sorting_a, $id_b);
    }

    public function getBoilerplate($boilerplate_sorting, $boilerplate_selected) {
        $boilerplate = $this->db->query('SELECT * FROM boilerplates WHERE category = ? AND sorting = ?', $this->category, $boilerplate_sorting)->fetchArray();
        if ($boilerplate_selected == 'selected') {
            $html =  "<tr class='content-row d-flex row-selected'>";
        }
        else {
            $html =  "<tr class='content-row d-flex'>";
        }
        $html .= "<th class='col-1'>" . $boilerplate['sorting'] . "</th>";
        $html .=  "<td class='col-7'>" . $boilerplate['name'] . "</td>";
        $html .= "<td class='col-1'><i class='fas fa-file-code' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "editModal_" . $boilerplate['sorting'] . "'></i></td>".
                 "<td class='col-1'><i class='far fa-clipboard' onclick='copyToClipboard(" . $boilerplate['sorting'] . ")'></i></td>".
                 "<td class='col-1'><i class='far fa-trash-alt' data-toggle='modal' data-backdrop='static' data-keyboard='false' data-target='#" . $this->category . "removeModal_" . $boilerplate['sorting'] . "'></i></td>";
        if ($boilerplate_selected == 'selected') {
            $html .= "<td class='col-1 col-selected'><i class='fas fa-sort'></i></td>";
        }
        else {
            $html .= "<td class='col-1'><i class='fas fa-sort'></i></td>";
        }
        $html .= "</tr>";
        return $html;
    }

    public function getModal($boilerplate_sorting, $modal_type) {
        do {
            $boilerplate = $this->db->query('SELECT * FROM boilerplates WHERE category = ? AND sorting = ?', $this->category, $boilerplate_sorting)->fetchArray();
        } while ($boilerplate['sorting'] === NULL);
        
        if($modal_type == 'edit') {
            $html = "<div class='modal fade' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                        "<div class='modal-dialog' role='document'>".
                            "<div class='modal-content'>".
                                "<form method='POST'>".
                                    "<div class='modal-header'>".
                                        "<h5 class='modal-title' id='" . $this->category . "editModal_" . $boilerplate['sorting'] . "Label'>Edit " . $this->category . " Boilerplate</h5>".
                                    "</div>".
                                    "<div class='modal-body'>".
                                        "<div class='form-group'>".
                                            "<input type='text' class='form-control' id='" . $this->category . "_boilerplate_name_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_name' value='" . $boilerplate['name'] ."'>".
                                        "</div>".
                                        "<div class='form-group'>".
                                            "<textarea class='form-control' id='" . $this->category . "_boilerplate_code_" . $boilerplate['sorting'] . "' name='" . $this->category . "_boilerplate_code' rows='5'>" . $boilerplate['code'] . "</textarea>".
                                        "</div>".
                                    "</div>".
                                    "<div class='modal-footer'>".
                                        "<input type='hidden' class='form-control' id='edit_boilerplate_category_" . $boilerplate['sorting'] . "' name='edit_boilerplate_category' value='" . $this->category . "'>".
                                        "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_edit_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>Close</button>".
                                        "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_edit_save_" . $boilerplate['sorting'] . "' onclick='editBoilerplate(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>Save</button>".
                                    "</div>".
                                "</form>".
                            "</div>".
                        "</div>".
                    "</div>";
        }
        else if ($modal_type == 'remove') {
            $html = "<div class='modal fade' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "' tabindex='-1' role='dialog' aria-labelledby='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label' aria-hidden='true'>".
                        "<div class='modal-dialog' role='document'>".
                            "<div class='modal-content'>".
                                "<form method='POST'>".
                                    "<div class='modal-header'>".
                                        "<h5 class='modal-title' id='" . $this->category . "removeModal_" . $boilerplate['sorting'] . "Label'>Remove Boilerplate?</h5>".
                                    "</div>".
                                    "<div class='modal-body'>".
                                    "</div>".
                                    "<div class='modal-footer'>".
                                        "<input type='hidden' class='form-control' id='remove_boilerplate_category_" . $boilerplate['sorting'] . "' name='remove_boilerplate_category' value='" . $this->category . "'>".
                                        "<button type='button' class='btn btn-secondary' id='" . $this->category . "_boilerplate_remove_close_" . $boilerplate['sorting'] . "' data-dismiss='modal'>NO</button>".
                                        "<button type='button' class='btn btn-primary' name='submit' id='" . $this->category . "_boilerplate_remove_save_" . $boilerplate['sorting'] . "' onclick='removeBoilerplateEvent(" . $boilerplate['sorting'] . ", " . $boilerplate['id'] . ");' data-dismiss='modal'>YES</button>".
                                    "</div>".
                                "</form>".
                            "</div>".
                        "</div>".
                    "</div>";
        }
        
        return $html;
    }

    public function resortBoilerplates() {
        $boilerplates = $this->db->query('SELECT * FROM boilerplates WHERE category = ? ORDER BY boilerplates.sorting ASC', $this->category)->fetchAll();
        $i = 0;
        foreach ($boilerplates as $boilerplate) {
            $i++;
            $id = $boilerplate['id'];
            $this->db->query('UPDATE boilerplates SET sorting=? WHERE id=?', $i, $id);
        }
    }
}
