<?php

#use Laravel\Lumen\Testing\DatabaseMigrations;
#use Laravel\Lumen\Testing\DatabaseTransactions;

class SessionTest extends TestCase
{

    public function testSessionLogin() {
        $user = App\User::first()->makeVisible(["password"]);
        $this->post('login', $user->toArray())->seeJsonStructure(["api_token"]);
    }

}
