<?php
declare(strict_types = 1);
namespace App\Controller;

use Cake\Database\Exception\DatabaseException;
use Cake\Event\EventInterface;

/**
 * DailyTodo Controller
 *
 * @property \App\Model\Table\DailyTodoTable $DailyTodo
 * @method \App\Model\Entity\DailyTodo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DailyTodoController extends AppController
{

//     public function beforeRender(EventInterface $event)
//     {
//         $this->setCorsHeaders();
//     }

//     public function beforeFilter(EventInterface $event)
//     {
//         if ($this->request->is('options')) {
//             $this->setCorsHeaders();
//             return $this->response;
//         }
//     }

//     private function setCorsHeaders()
//     {
//         $this->response = $this->response->cors($this->request)
//         ->alloworigin(['*'])
//         ->allowmethods(['*'])
//         ->exposeheaders(['x-total-pages'])
//         ->maxage(800)
//         ->build();
//     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $id =$this->request->getParam('id');
        $data = [];
        $data['status'] = "200";
        $dailyTodo = $this->DailyTodo->find()->where([
            'user_id'=>$id
        ])->all();
        $dailyTodo = $dailyTodo;
        $data['data'] = $dailyTodo;
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Daily Todo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dailyTodo = $this->DailyTodo->get($id, [
            'contain' => []
        ]);

        $this->set(compact('dailyTodo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // die("dc");
        $data = [];
        $data['status'] = "200";
        $dailyTodo = $this->DailyTodo->newEmptyEntity();
        if ($this->request->is('post')) {
            $dailyTodo = $this->DailyTodo->patchEntity($dailyTodo, $this->request->getData());
            if ($this->request->getData()['saved'] == "True") {
                $dailyTodo->saved = True;
            } else {
                $dailyTodo->saved = False;
            }
            if ($this->request->getData()['completed'] == "True") {
                $dailyTodo->completed = True;
            } else {
                $dailyTodo->completed = False;
            }
            $datetime = new \DateTime(); // Current date and time

            // Format the datetime to match MySQL datetime format
            $dailyTodo->created_on = $datetime->format('Y-m-d H:i:s');

            try {
                if ($this->DailyTodo->save($dailyTodo)) {
                    $data['data'] = $dailyTodo;
                    $data['message'] = "data saved sucessfully";
                } else {
                    $data['status'] = "403";
                    $data['data'] = $dailyTodo;
                    $data['error'] = $dailyTodo->getErrors();
                }
            } catch (DatabaseException $e) {
                $data['status'] = "403";
                $data['data'] = $dailyTodo;
                $data['error'] = $e->getMessage();
            }
        }
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Daily Todo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = [];
        $data['status'] = "200";
        $id =$this->request->getParam('id');
        
        $dailyTodo = $this->DailyTodo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $dailyTodo = $this->DailyTodo->patchEntity($dailyTodo, $this->request->getData());
            if (isset($this->request->getData()['completed'])) {
                if($this->request->getData()['completed'] == "True"){
                    $dailyTodo->completed = 1;
                    
                }else {
                    $dailyTodo->completed = 0;
                }
            } 
            try {
                if ($this->DailyTodo->save($dailyTodo)) {
                    $data['data'] = $dailyTodo;
                    $data['message'] = "data updated sucessfully";
                } else {
                    $data['status'] = "403";
                    $data['data'] = $dailyTodo;
                    $data['error'] = $dailyTodo->getErrors();
                }
            } catch (DatabaseException $e) {
                $data['status'] = "403";
                $data['data'] = $dailyTodo;
                $data['error'] = $e->getMessage();
            }
        }
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Daily Todo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id =$this->request->getParam('id');
//         print_r();die;
        $data = [];
        $data['status'] = "200";
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $dailyTodo = $this->DailyTodo->get($id);
        if ($this->DailyTodo->delete($dailyTodo)) {
            $data['message'] = "The daily todo has been deleted.";
        } else {
            $data['status'] = "403";
            $data['error'] = $dailyTodo->getErrors();
        }
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
    }
}
