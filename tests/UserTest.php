<?php

#use Laravel\Lumen\Testing\DatabaseMigrations;
#use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserAdd()
    {
        $user = factory(App\User::class)->make()->makeVisible(["api_token","password"])->toArray();
        $this->post('users', $user);
        $this->seeInDatabase('user', ["email" => $user["email"]]);
    }

    public function testUserList()
    {
        $userModel = new App\User;
        $structure = array_except(array_flip($userModel->getFillable()), $userModel->getHidden());
        $this->get("users")->seeJsonStructure([array_flip($structure)]);
    }

    public function testUserGet()
    {
        $userModel = new App\User;
        $userId    = $userModel->first()["id"] ?? null;
        $structure = array_except(array_flip($userModel->getFillable()), $userModel->getHidden());
        $this->get("users/{$userId}")->seeJsonStructure(array_flip($structure));
    }

    public function testUserUpdate()
    {
        $userModel   = new App\User;
        $user        = $userModel->first()->makeVisible(["password","api_token"]);
        $user->email = random_int(100000,1000000)."@woowoo.com";
        $this->put("users/{$user["id"]}", $user->toArray());
        $this->seeInDatabase("user", ["email" => $user->email]);
    }

    public function testUserDelete()
    {
        $userModel = new App\User;
        $userId    = $userModel->first()["id"] ?? null;
        $this->delete("users/{$userId}")->assertResponseOk();
    }

}
