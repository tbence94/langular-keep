<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class NotesApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testNotesIndex()
    {
        $this->get('api/notes');

        $this->assertResponseStatus(200);
        $this->assertJson($this->response->getContent());
    }

    public function testNotesStoreInvalid()
    {
        $this->post('api/notes', [
            'title'       => '',
            'description' => '',
        ]);

        $this->assertResponseStatus(422);
        $this->assertJson($this->response->getContent());
    }

    public function testNotesStoreValid()
    {
        $this->post('api/notes', [
            'title'       => 'Some title',
            'description' => 'Some description',
        ]);

        $this->assertResponseStatus(200);
        $this->assertJson($this->response->getContent());
        $this->assertArraySubset([
            'title'       => 'Some title',
            'description' => 'Some description',
        ], json_decode($this->response->getContent(), true));
    }

    public function testNotesShow()
    {
        $this->post('api/notes', [
            'title'       => 'Some title',
            'description' => 'Some description',
        ]);
        $id = (json_decode($this->response->getContent()))->id;

        $this->get('api/notes/' . $id);

        $this->assertResponseStatus(200);
        $this->assertJson($this->response->getContent());

        $this->assertArraySubset([
            'title'       => 'Some title',
            'description' => 'Some description',
        ], json_decode($this->response->getContent(), true));
    }

    public function testNotesDestroy()
    {
        $this->post('api/notes', [
            'title'       => 'Some title',
            'description' => 'Some description',
        ]);
        $id = (json_decode($this->response->getContent()))->id;

        $this->delete('api/notes/' . $id);

        $this->assertResponseStatus(200);
        $this->assertJson($this->response->getContent());

        $this->get('api/notes/' . $id);
        $this->assertResponseStatus(404);
    }
}
