<?php

namespace Tests\Feature;

use App\User;
use App\Output;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;


class OutputApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp()
    {
        parent::setUp();
        
        Artisan::call('passport:client', ['--personal' => TRUE, '--name' => 'test']);
    }
    
    /** @test */
    public function unauthenticated_users_cant_access_the_api()
    {
        $response = $this->get('/api/output');
    
        dd($response);
        
        $response->assertStatus(302);
    }
    
    /** @test */
    public function users_can_receive_access_tokens_with_their_credentials()
    {
        $user = factory(User::class)->create();
        
        $response = $this->json('POST', 'api/login', [
            'username' => $user->username,
            'password' => 'secret'
        ]);
        
        $response->assertStatus(200)
                 ->assertJsonFragment(['accessToken']);
    }
    
    /** @test */
    public function users_cant_receive_acces_tokens_with_invalid_credentials()
    {
        $user = factory(User::class)->create();
        
        $response = $this->json('POST', 'api/login', [
            'username' => $user->username,
            'password' => 'wrong password'
        ]);
        
        $response->assertStatus(200)
                 ->assertJsonFragment(['Invalid credentials.'])
                 ->assertJsonMissing(['accessToken']);
    }
    
    /** @test */
    public function all_outputs_can_be_listed()
    {
        Passport::actingAs(factory(User::class)->create());
        
        $outputs = factory(Output::class, 2)->create();
        
        $response = $this->json('GET', '/api/output');
        
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $outputs[0]->name])
                 ->assertJsonFragment(['name' => $outputs[1]->name]);
    }
    
    /** @test */
    public function a_new_output_can_be_created()
    {
        Passport::actingAs(factory(User::class)->create());
        
        $data = [
            'name' => 'pump',
            'pin' => 5,
        ];
        
        $response = $this->json('POST', '/api/output', $data);
        
        $response->assertStatus(200)
                 ->assertJsonFragment($data);
        
        $this->assertCount(1, Output::all());
    }
    
    /** @test */
    public function a_single_output_can_be_fetched()
    {
        Passport::actingAs(factory(User::class)->create());
        $output = factory(Output::class)->create();
        
        $response = $this->json('GET', 'api/output/' . $output->id);
        
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => $output->name,
                     'pin' => $output->pin
                 ]);
    }
    
    /** @test */
    public function existing_coutputs_can_be_updated()
    {
        Passport::actingAs(factory(User::class)->create());
        $output = factory(Output::class)->create();
        
        $newData = [
            'name' => 'newname',
            'pin' => 1
        ];
        
        $resonse = $this->json('PATCH', 'api/output/' . $output->id, $newData);
        
        $resonse->assertStatus(200)
                ->assertJsonFragment($newData);
        
        $this->assertEquals('newname', $output->fresh()->name);
        $this->assertEquals(1, $output->fresh()->pin);
    }
    
    /** @test */
    public function existing_outputs_can_be_deleted()
    {
        Passport::actingAs(factory(User::class)->create());
        $output = factory(Output::class)->create();
        
        $response = $this->json('DELETE', 'api/output/' . $output->id);
        
        $response->assertStatus(200);
        $this->assertCount(0, Output::all());
    }
    
    /** @test */
    public function a_output_can_be_enabled()
    {
        Passport::actingAs(factory(User::class)->create());
        $output = factory(Output::class)->create();
        
        $this->assertFalse($output->fresh()->active);
        
        $response = $this->json('GET', '/api/output/' . $output->id . '/enable');
        
        $response->assertStatus(200)
                 ->assertJsonFragment(['active' => TRUE]);
        
        $this->assertTrue($output->fresh()->active);
    }
    
    /** @test */
    public function a_output_can_be_disabled()
    {
        Passport::actingAs(factory(User::class)->create());
        $output = factory(Output::class)->create(['active' => TRUE]);
        
        $this->assertTrue($output->fresh()->active);
        
        $response = $this->json('GET', '/api/output/' . $output->id . '/disable');
        
        $response->assertStatus(200)
                 ->assertJsonFragment(['active' => FALSE]);
        
        $this->assertFalse($output->fresh()->active);
    }
}
