<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('HUST',1);
define('NEU', 2);
define('NUCE', 3);
define('MALE', 1);

class Main extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('school_model');
        $this->load->model('major_model');
        $this->load->model('env_var_model');
    }

    public function index(){
        $this->load->view('home/view');
        $this->make_decision();
    }

    public function manage(){
        $this->load->view('table/view');
    }

    public function make_decision(){
        $scores = array('math' => 8, 'physics' => 9, 'other' => 9, 'prior' => 0.5);
        $school_id = 1;
        $major_chosen = [17, 20, 21, 18];
        $sex = 1;


        //step 0
        // major_id follow ascending order.
        $initial_arr = $this->init_variables($school_id, $major_chosen, $scores, $sex);

        //chuyen vi vector de de tinh toan hon
        $transpose_initial_arr = $this->transpose_array($initial_arr);

        // step 1: normalize values by normalized vector
        $normalized_arr = $this->normalized_vector($transpose_initial_arr);

        //step 2: calculate by weights
        $normalized_arr = $this->calculate_by_weights($normalized_arr);

        //step 3: calculate ideal solutions
        $ideal_solutions_arr = $this->calculate_ideal_arr($normalized_arr);

        // chuyen vi lai vector chuan hoa de tinh toan
        $transpose_normalized_arr = $this->transpose_array($normalized_arr);
        // them vao major_id de nhan dang ma nganh

        //step 4: calculate to ideal solutions
        $distance_to_ideal_solutions_arr = $this->calculate_to_ideal_solutions($ideal_solutions_arr, $transpose_normalized_arr);

        //step 5: calculate familiar measures to ideal solutions
        $familar_measures_arr = $this->calculate_familiar_measures_to_ideal_sol($distance_to_ideal_solutions_arr);

        // add id for major and order by familiar measures
        $result = $this->add_id_and_order_array($familar_measures_arr, $major_chosen);
        if(!empty($result)){
            return $result;
        }
        return false;

    }

    private function init_variables($school_id, $major_chosen, $scores, $sex){
        $majors = $this->major_model->get_majors_by_ids($major_chosen);
        if($majors){
            $num_major = count($major_chosen);
            // index for hobbies
            $hobbies = array();
            for($i = 0; $i < $num_major; $i++){
                $id = "" . $major_chosen[$i];
                $hobbies[$id] = $num_major-$i;
            }
            ksort($hobbies, SORT_NUMERIC);

            // get total score
            $scores = $this->count_score($school_id, $scores);

            // init data
            $initial_arr = array();
            foreach ($majors as &$major){
                $initial_ele = array();
                $initial_ele[] = $major['amount'];
                $initial_ele[] = round($scores['score_1']/$major['reference_1'], 2);
                $initial_ele[] = round($scores['score_2']/$major['reference_2'], 2);
                $initial_ele[] = $hobbies[$major['id']];
                $initial_ele[] = $major['work_opportunity'];
                $initial_ele[] = ($sex == MALE)?$major['rate_of_male']:( 1 - floatval($major['rate_of_male']));
                // push to initial data
                $initial_arr[] = $initial_ele;
            }
            return $initial_arr;
        }
        return false;
    }

    private function normalized_vector($data){
        if(!empty($data)){
            $normalized_arr = array();
            for ($i = 0; $i < count($data); $i++){
                $normalized_arr[] = $this->cal_normalized_vector($data[$i]);
            }
            return $normalized_arr;
        }
        return false;
    }

    private function calculate_by_weights($data){
        if(!empty($data)){
            $weights = $this->env_var_model->get_weights_by_types(array(AMOUNT, BIAS_1, BIAS_1, HOBBY, WORK_OPPORTUNITY, SEX));
            for($i = 0; $i < count($weights); $i++){
                $data[$i] = $this->multiple_weight($data[$i], $weights[$i]["weight"]);
            }
            return $data;
        }
        return false;
    }

    private function calculate_ideal_arr($data){
        if(!empty($data)){
            $best_values = array();
            $worst_values = array();
            for ($i = 0; $i < count($data); $i++){
                $best_values[] = max($data[$i]);
                $worst_values[] = min($data[$i]);
            }
            return array(
                'best' => $best_values,
                'worst' => $worst_values
            );
        }
        return false;
    }

    private function calculate_to_ideal_solutions($ideal_solutions_arr, $transpose_normalized_arr){
        if(!empty($transpose_normalized_arr) && !empty($ideal_solutions_arr)){
            $to_best_solutions = array();
            $to_worst_solutions = array();
            for($i = 0; $i < count($transpose_normalized_arr); $i++){
                $solution = $transpose_normalized_arr[$i];
                // distance between two vectors
                $to_best_solution = 0;
                $to_worst_solution = 0;
                for($j = 0; $j < count($solution); $j++){
                    $to_best_solution += pow($solution[$j] - $ideal_solutions_arr['best'][$j], 2);
                    $to_worst_solution += pow($solution[$j] - $ideal_solutions_arr['worst'][$j], 2);
                }
                $to_best_solutions[] = round(sqrt($to_best_solution), 4);
                $to_worst_solutions[] = round(sqrt($to_worst_solution), 4);
            }
            return array(
                'best' => $to_best_solutions,
                'worst' => $to_worst_solutions
            );
        }
        return false;
    }

    private function calculate_familiar_measures_to_ideal_sol($distance_to_ideal_solutions_arr){
        if(!empty($distance_to_ideal_solutions_arr)){
            $familiar_measures_arr = array();
            for($i = 0; $i < count($distance_to_ideal_solutions_arr['best']); $i++){
                $distance =
                    $distance_to_ideal_solutions_arr['worst'][$i]/($distance_to_ideal_solutions_arr['worst'][$i] + $distance_to_ideal_solutions_arr['best'][$i]);
                $familiar_measures_arr[] = round($distance, 4);
            }
            return $familiar_measures_arr;
        }
        return false;
    }

    private function add_id_and_order_array($familar_measures_arr, $major_chosen){
        if(!empty($familar_measures_arr) && !empty($major_chosen)){
            sort($major_chosen);
            $result = array();
            for ($i = 0; $i < count($familar_measures_arr); $i++){
                $result[] = array(
                    'id' => $major_chosen[$i],
                    'value' => $familar_measures_arr[$i]
                );
            }
            //sort by value
            usort($result, function ($a, $b){
                return ($a['value'] - $b['value'])*10;
            });
            return $result;
        }
        return false;
    }

    ///////////SUPPORTED FUNCTION
    private function count_score($id, $scores){
        if(isset($id) && isset($scores)){
            $score_1 = 0;
            $score_2 = 0;
            if($id == HUST){
                $score_1 = round($scores['math'] + $scores['physics'] + $scores['other'], 2) + $scores['prior'];
                $score_2 = round(($scores['math']*2 + $scores['physics'] + $scores['other'])*0.75, 2) + $scores['prior'];
            }else if($id == NEU){
                $score_1 = round($scores['math'] + $scores['physics'] + $scores['other'], 2) + $scores['prior'];
                $score_2 = $score_1;
            }else if($id == NUCE){
                $score_1 = round($scores['math']*2 + $scores['physics'] + $scores['other']) + $scores['prior'];
                $score_2 = round($scores['math'] + $scores['physics'] + $scores['other'], 2) + $scores['prior'];
            }
            return array(
                'score_1' => $score_1,
                'score_2' => $score_2
            );
        }
        return false;
    }

    private function cal_normalized_vector($vectors){
        $sum = 0;
        for ($i = 0; $i < count($vectors); $i++){
            $sum += $vectors[$i]*$vectors[$i];
        }
        $sum = sqrt($sum);
        $normalized_vector = array();
        for ($i=0; $i < count($vectors); $i++){
            $normalized_vector[] = round($vectors[$i]/$sum, 4   );
        }
        return $normalized_vector;
    }

    private function transpose_array($data){
        $retData = array();
        foreach ($data as $row => $columns) {
            foreach ($columns as $row2 => $column2) {
                $retData[$row2][$row] = $column2;
            }
        }
        return $retData;
    }

    private function multiple_weight($arr, $weight){
        if(isset($arr) && isset($weight)){
            for($i = 0; $i < count($arr); $i++){
                $arr[$i] = round($arr[$i]*$weight, 4);
            }
            return $arr;
        }
        return false;
    }
}