<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends CI_Controller
{

    use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
    }

    public function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->helper(['jwt']);
    }

    public function login_post()
    {
        $dummy_user = [
            'username' => 'admin',
            'password' => 'admin'
        ];
        $username = $this->post('username');
        $password = $this->post('password');
        if ($username === $dummy_user['username'] && $password === $dummy_user['password']) {
            $token = JWT::generateToken(['username' => $dummy_user['username']]);
            $response = ['code' => 200, 'message' => 'Successful', 'data' => ['token' => $token]];
            $this->response($response, 200);
        } else {
            $this->response(['code' => 404, 'message' => 'Invalid username or password!'], 200);
        }
    }

    private function verify_request()
    {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers)) {
            $token = $headers['Authorization'];
            try {
                $data = JWT::validateToken($token);
                if ($data === false) {
                    $response = ['code' => 401, 'message' => 'Unauthorized Access! A'];
                    $this->response($response, 200);
                    exit();
                } else {
                    return $data;
                }
            } catch (Exception $e) {
                $response = ['code' => 401, 'message' => 'Unauthorized Access! B'];
                $this->response($response, 200);
            }
        } else {
            $response = ['code' => 401, 'message' => 'Authorization Not Found'];
            $this->response($response, 200);
        }
    }

    public function index_get()
    {
        $this->verify_request();
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', 'hobbies' => ['guitar', 'cycling']],
        ];
        $this->response(['code' => 200, 'message' => 'Successful', 'data' => ['users' => $users]], 200);
    }
}

/* End of file User.php */
