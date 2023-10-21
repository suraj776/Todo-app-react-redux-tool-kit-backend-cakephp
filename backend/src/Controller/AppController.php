<?php
declare(strict_types = 1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc.
 * (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link https://cakephp.org CakePHP(tm) Project
 * @since 0.2.9
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        // $this->loadComponent('Authentication.Authentication');

        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'User',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'userModel' => 'User',
                    'fields' => [
                        'username' => 'id'
                    ],

                    'parameter' => 'Authorization',

                    // Boolean indicating whether the "sub" claim of JWT payload
                    // should be used to query the Users model and get user info.
                    // If set to `false` JWT's payload is directly returned.
                    'queryDatasource' => true
                ]
            ],

            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);
        
        // $this->Authentication->allowUnauthenticated([
        // 'login',
        // 'add'
        // ]);
        // $this->loadAuthenticator('Authentication.Token', [
        // 'queryParam' => 'token',
        // 'header' => 'Authorization',
        // 'tokenPrefix' => 'Token'
        // ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        // $this->loadComponent('FormProtection');
    }
}
