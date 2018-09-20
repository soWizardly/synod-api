<?php

#use Laravel\Lumen\Testing\DatabaseMigrations;
#use Laravel\Lumen\Testing\DatabaseTransactions;

class ProposalTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProposalAdd()
    {
        $userId = App\User::first()->id ?? null;
        Auth::shouldReceive('id')->andReturn($userId);
        $projectId = App\Project::first()->id ?? null;

        $proposal = factory(App\Proposal::class)->make([
            "user_id"    => $userId,
            "project_id" => $projectId
        ])->toArray();

        $this->post('proposals', $proposal);

        $this->seeInDatabase('proposal', [
            "user_id"    => $proposal["user_id"],
            "project_id" => $proposal["project_id"]
        ]);
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
