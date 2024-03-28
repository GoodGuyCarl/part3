<?php
/**
 * Class Assignments
 *
 * This class is a controller for handling assignments.
 */
class Assignments extends CI_Controller {

    /**
     * Constructor
     *
     * Loads the Assignment model.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Assignment');
    }
    
    /**
     * Index method
     *
     * Displays all assignments or assignments retrieved from the session.
     */
    public function index() {
        $assignments = $this->session->flashdata('assignments');
        if(!$assignments)
            $assignments = $this->Assignment->all();

        $data = $this->data(
            'All Assignments',
            $assignments,
            count($assignments)
        );
        $this->load->view('layout', $data);
    }

    /**
     * Filter method
     *
     * Filters assignments based on level and track.
     */
    public function filter() {
		$level = $this->input->post('level');
		$track = $this->input->post('track');
		$assignments = $this->Assignment->filter($level, $track);

		$data = $this->data(
			'Filtered Assignments',
			$assignments,
			count($assignments),
		);
		$this->load->view('assignments/table_body', $data);
	}

    /**
     * Data method
     *
     * Prepares data for the view.
     *
     * @param string $title The title of the page
     * @param array $assignments An array of assignments
     * @param int $rows The number of assignments
     * @param string $view The view to load (default: 'assignments/index')
     * @return array An array of data for the view
     */
    private function data($title, $assignments, $rows, $view = 'assignments/index') {
        return [
            'title' => $title,
            'view' => $view,
            'assignments' => $assignments,
            'rows' => $rows,
            'tracks' => $this->Assignment->getTracks(),
            'levels' => $this->Assignment->getLevel(),
        ];
    }
}
