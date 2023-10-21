<?php
declare(strict_types = 1);
namespace App\Controller;

use Cake\Database\Exception\DatabaseException;
use App\Auth\JwtToken;
use Cake\Event\EventInterface;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Auth->allow([
            'add',
            'login'
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->paginate($this->User);

        $this->set(compact('user'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => [
                'DailyTodo'
            ]
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method, used as signup
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = [];
        $data['status']="200";
        $user = $this->User->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            $datetime = new \DateTime(); // Current date and time

            // Format the datetime to match MySQL datetime format
            $user->created_on = $datetime->format('Y-m-d H:i:s');

            try {
                if ($this->User->save($user)) {
                    $data['data'] = $user;
                    $data['message'] = "Registered sucessfully";
                } else {
                    $data['status']="403";
                    $data['data'] = $user;
                    $data['error'] = $user->getErrors();
                }
            } catch (DatabaseException $e) {
                $data['status']="403";
                $data['data'] = $user;
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

    public function login()
    {
        $data = [];
        $result = $this->Auth->identify();
        if (! empty($result)) {
            $user = $result;
            $jwt = new JwtToken();
            $token = $jwt->generateToken($user);

            $data = [
                'token' => $token, // used RS256 algo
                'user' => $user,
                'message' => "Login Sucessfully"
            ];
        } else {
            $this->response = $this->response->withStatus(401);

            $data = [
                'error'=>"Email/Password is wrong"
            ];
        }
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
//         $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->request->getParam('id');
        $user = $this->User->get($id, [
            'contain' => []
        ]);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {

            $user = $this->User->patchEntity($user, $this->request->getData());
            $datetime = new \DateTime(); // Current date and time

            // Format the datetime to match MySQL datetime format
            $user->created_on = $datetime->format('Y-m-d H:i:s');

            try {
                if ($this->User->save($user)) {
                    $data['data'] = $user;
                    $data['message'] = "data updated sucessfully";
                } else {
                    $data['data'] = $user;
                    $data['error'] = $user->getErrors();
                }
            } catch (DatabaseException $e) {
                $data['data'] = $user;
                $data['error'] = $e->getMessage();
            }
        }
        $this->set([
            'data' => $data,
            '_serialize' => [
                'data'
            ]
        ]);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $user = $this->User->get($id);
        if ($this->User->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            'action' => 'index'
        ]);
    }
}
