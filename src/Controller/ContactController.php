<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\InvalidCsrfTokenException;
use App\Model\Table\ContactsTable;
use Cake\View\Exception\MissingTemplateException;
use Cake\Validation\Validator;
//use Fzaninotto\Faker;
use Faker\Factory as Faker;

//require_once '/srv/users/curnow/apps/curnow/public/vendor/fzaninotto/faker/src/autoload.php';

class ContactController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
		$this->loadComponent('Paginator');
    }
	
	var $return = [
	'code' => '403',
	'message' => '',
	'body' => '',
	];
	
	





    public function index()
    {
		
		$data = $this->request->getData();
		$page = $this->request->getQuery('page');
		$page= ($page-1)*25;
		
		$this->loadModel('Contacts');
        $contact = $this->Contacts->find('all', array('limit'=>25,'offset'=>$page));
	
		$this->return['message']='Contacts';
		$this->return['body']=(object)$contact;
		$this->return['code']='200';
		echo $this->_json($this->return); exit;
    }

    public function view($id)
    {
		$this->loadModel('Contacts');
		$Record = $this->Contacts->find()->where(['id' => $id])->first();
		if($Record){
        $contact = $this->Contacts->get($id);
        $this->return['message']='Contact';
		$this->return['body']=(object)$contact;
		$this->return['code']='200';
		echo $this->_json($this->return); exit; 
		} else {
        $this->return['message']='Record Not Found';
		$this->return['body']=(object)[];
		$this->return['code']='404';
		echo $this->_json($this->return); exit; 
        }
    }

    public function add()
    {
		
	
        $this->request->allowMethod(['post']);
		
		$data = $this->request->getData();
		//echo "<pre>"; print_R($data); die;
		$this->loadModel('Contacts');
		$check= $this->validation($data,'add');
		 
		 if($check){
			$this->return['message']='Validation Error';
		$this->return['body']=(object) $check;
		$this->return['code']='400';
		echo $this->_json($this->return); exit;  
			 
		 }
		 
		
        $contact = $this->Contacts->newEntity($this->request->getData());
        if ($this->Contacts->save($contact)) {
        $this->return['message']='Contact Added Successfully';
		$this->return['body']=(object) $contact;
		$this->return['code']='200';
		echo $this->_json($this->return); exit; 
        } else {
        $this->return['message']='Invalid Data';
		$this->return['body']=(object)[];
		$this->return['code']='400';
		echo $this->_json($this->return); exit; 
        }
		
			  
    }

    public function edit($id)
    {
		
        $this->request->allowMethod(['put']);
		$this->loadModel('Contacts');
		$data = $this->request->getData();
		$Record = $this->Contacts->find()->where(['id' => $id])->first();
		
		$check= $this->validation($data,'update');
		 
		 if($check){
			$this->return['message']='Validation Error';
		$this->return['body']=(object) $check;
		$this->return['code']='400';
		echo $this->_json($this->return); exit;  
			 
		 }
		 
		if(!$Record){
        $this->return['message']='Record Not Found';
		$this->return['body']=(object)[];
		$this->return['code']='404';
		echo $this->_json($this->return); exit; 
		} 
			
			
		
        $contact = $this->Contacts->get($id);
        $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
		
		
        
		if ($this->Contacts->save($contact)) {
         $this->return['message']='Contact Updated Successfully';
		$this->return['body']=(object) $contact;
		$this->return['code']='200';
		echo $this->_json($this->return); exit; 
        } else {
        $this->return['message']='Invalid Data';
		$this->return['body']=(object)[];
		$this->return['code']='400';
		echo $this->_json($this->return); exit; 
        }
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
		$this->loadModel('Contacts');
		
		$Record = $this->Contacts->find()->where(['id' => $id])->first();
		
		if ($Record) {
		$contact = $this->Contacts->get($id);
		$this->Contacts->delete($contact);
        $this->return['message']='Contacts Deleted Successfully';
		$this->return['body']=(object)[];
		$this->return['code']='200';
		echo $this->_json($this->return); exit; 
        } else {
        $this->return['message']='Record Not Found';
		$this->return['body']=(object)[];
		$this->return['code']='404';
		echo $this->_json($this->return); exit; 
        }
		
    }
	
  public function _json($body, $message = '') {
   $this->_code = isset($body['code']) && $body['code'] ? $body['code'] : 200;
   header("message:" . $body['message']);
   @$this->_set_headers($body['code']);
   if (strlen(trim($message))) {
       $body['message'] = $message;
   }
   return json_encode($body); 
  }
	private function _set_headers($code) {
	   header('Content-Type: application/json');
	   header("HTTP/1.1 " . $this->_code . " " . $this->get_status_message($code));
	}
	
	private function get_status_message($code) {
   $status = array(
       100 => 'Continue',
       101 => 'Switching Protocols',
       200 => 'OK',
       201 => 'Created',
       202 => 'Accepted',
       203 => 'Non-Authoritative Information',
       204 => 'No Content',
       205 => 'Reset Content',
       206 => 'Partial Content',
       300 => 'Multiple Choices',
       301 => 'Moved Permanently',
       302 => 'Found',
       303 => 'See Other',
       304 => 'Not Modified',
       305 => 'Use Proxy',
       306 => '(Unused)',
       307 => 'Temporary Redirect',
       400 => 'Bad Request',
       401 => 'Unauthorized',
       402 => 'Payment Required',
       403 => 'Forbidden',
       404 => 'Not Found',
       405 => 'Method Not Allowed',
       406 => 'Not Acceptable',
       407 => 'Proxy Authentication Required',
       408 => 'Request Timeout',
       409 => 'Conflict',
       410 => 'Gone',
       411 => 'Length Required',
       412 => 'Precondition Failed',
       413 => 'Request Entity Too Large',
       414 => 'Request-URI Too Long',
       415 => 'Unsupported Media Type',
       416 => 'Requested Range Not Satisfiable',
       417 => 'Expectation Failed',
       500 => 'Internal Server Error',
       501 => 'Not Implemented',
       502 => 'Bad Gateway',
       503 => 'Service Unavailable',
       504 => 'Gateway Timeout',
       505 => 'HTTP Version Not Supported');
   return (isset($this->_html_response_code['code']) && strlen(trim($this->_html_response_code['code'])) && isset($status[$this->_html_response_code['code']])) ? $status[$this->_html_response_code['code']] : $status[$code];
}

	public function validation($data, $type) {
		$validator = new Validator();
		$fields = ['first_name'=> 'First Name','last_name'=> 'Last Name','company'=> 'Company','address'=> 'Address','city'=> 'City','county'=> 'County','state_province'=> 'State/Province','zip'=> 'ZIP/Postal Code','phone_1'=> 'Phone No.','phone_2'=> 'Phone No. 2','email'=> 'Email','web'=> 'Web'];
		foreach($fields as $field => $value){
			if($type == 'add'){
			$data[$field] = isset($data[$field])? $data[$field] : '' ;
			} 
			$validator->notEmptyString($field, "We need {$value}.");
			
		}
		$validator->notEmptyString('email', 'We need email.')->add(
          'email', 'validFormat', ['rule' => 'email','message' => 'E-mail must be valid']);
         
         return $validator->validate($data);
	}
}