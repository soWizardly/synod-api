<?php

#use Laravel\Lumen\Testing\DatabaseMigrations;
#use Laravel\Lumen\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProjectAdd()
    {
        $userId = App\User::first()->id??null;
        Auth::shouldReceive('id')->andReturn($userId);

        $project = factory(App\Project::class)->make(["user_id"=>$userId])->toArray();
        $this->post('projects', $project);

        $this->seeInDatabase('project', ["user_id" => $project["user_id"]]);
    }

    public function testProjectList()
    {
        $projectModel = new App\Project;
        $structure    = array_except(array_flip($projectModel->getFillable()), $projectModel->getHidden());
        $this->get("projects")->seeJsonStructure([array_flip($structure)]);
    }

    public function testProjectGet()
    {
        $projectModel = new App\Project;
        $projectId    = $projectModel->first()["id"] ?? null;
        $structure    = array_except(array_flip($projectModel->getFillable()), $projectModel->getHidden());
        $this->get("projects/{$projectId}")->seeJsonStructure(array_flip($structure));
    }

    public function testProjectUpdate()
    {
        $projectModel   = new App\Project;
        $project        = $projectModel->first();
        $project->name  = random_int(100,1000)." test";
        $this->put("projects/{$project->id}", $project->toArray());
        $this->seeInDatabase("project", ["name" => $project->name]);
    }

    public function testProjectDelete()
    {
        $projectModel = new App\Project;
        $projectId    = $projectModel->first()["id"] ?? null;
        $this->delete("projects/{$projectId}")->assertResponseOk();
    }

}
