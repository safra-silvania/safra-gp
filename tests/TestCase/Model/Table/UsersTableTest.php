<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.Roles',
        'app.Notifications',
    ];

    protected $defaultUser = [
        'role_id' => 1,
        'name' => 'Nome de teste',
        'email' => 'teste@teste.com',
        'password' => '123456',
        'password_confirm' => '123456'
    ];

    public function setUp(): void
    {
        parent::setUp();

        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
    }

    public function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->testEmailUnique();
        $this->testPasswordRequired();
    }

    public function testEmailUnique(): void
    {
        //sucesso => inserção normal
        $data = $this->defaultUser;

        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());

        //falha => inserção de usuário com email repetido
        $sameUser = $this->defaultUser;

        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $sameUser, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
    }

    public function testPasswordRequired(): void
    {
        //sucesso => inserção de usuário com senha
        $data = $this->defaultUser;
        $data['email'] = 'pwrequired@required1.com';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());

        //falha => inserção de usuário sem senha
        $data = $this->defaultUser;
        $data['email'] = 'pwrequired@required2.com';
        $data['password'] = '';
        $data['password_confirm'] = '';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());

        //sucesso => edição de usuário com senha
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'pwrequired@required3.com';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());

        //sucesso => edição de usuário SEM senha
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'pwrequired@required4.com';
        $data['password'] = '';
        $data['password_confirm'] = '';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());
    }
    
    public function testValidationPasswords(): void
    {
        $this->testAddUser();
        $this->testEditUser();
    }

    public function testAddUser(): void
    {
        //sucesso => inserção normal
        $data = $this->defaultUser;
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());

        //falha => inserção sem senha
        $data = $this->defaultUser;
        $data['password'] = '';
        $data['password_confirm'] = '';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());

        //falha => inserção com senha curta
        $data = $this->defaultUser;
        $data['password'] = '123';
        $data['password_confirm'] = '123';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());

        //falha => inserção sem a confirmação
        $data = $this->defaultUser;
        $data['password'] = '123456';
        $data['password_confirm'] = '';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
        
        //falha => inserção com senha diferente da confirmação
        $data = $this->defaultUser;
        $data['password'] = '';
        $data['password_confirm'] = '123456';
        $user = $this->Users->newEmptyEntity();
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
    }

    public function testEditUser(): void
    {
        //sucesso => edição de usuário com senha
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = '123456@asdfasdf.com';
        $data['password'] = '123456';
        $data['password_confirm'] = '123456';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());
        
        //sucesso => edição senha longa
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'edicao@edicao1.com';
        $data['password'] = '1234567891011121314151617181920';
        $data['password_confirm'] = '1234567891011121314151617181920';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());
        
        //sucesso => edição sem senha
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'edicao@edicao2.com';
        $data['password'] = '';
        $data['password_confirm'] = '';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertEmpty($user->getErrors());
        
        //falha => edição com senha curta
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'edicao@edicao3.com';
        $data['password'] = '123';
        $data['password_confirm'] = '123';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
        
        //falha => edição sem a confirmação
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'edicao@edicao4.com';
        $data['password'] = '123456';
        $data['password_confirm'] = '';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
        
        //falha => edição com senha diferente da confirmação
        $data = $this->defaultUser;
        $data['id'] = 1;
        $data['email'] = 'edicao@edicao5.com';
        $data['password'] = '';
        $data['password_confirm'] = '123456';
        $user = $this->Users->get($data['id']);
        $this->Users->patchEntity($user, $data, ['validate' => 'passwords']);
        $this->Users->save($user);
        $this->assertNotEmpty($user->getErrors());
    }

    /*
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
    */
}
