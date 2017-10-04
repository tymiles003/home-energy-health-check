<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testWeCanSeeHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function testWeCantSeeNonExistentPages()
    {
        $response = $this->get('/foobarbaz');
        $response->assertStatus(404);
    }

    public function testMethodIsNotAllowedOnEndpoint()
    {
        $response = $this->get('/submit/1');
        $response->assertStatus(405);
    }

    public function testWeCanSeeSubmissionForm()
    {
        $response = $this->get('/submit/1/edit');
        $response->assertStatus(200);
        $response->assertViewIs('submission.edit');
        $response->assertViewHas('json_parts');
        $response->assertViewHas('json_improvements');
    }
}
