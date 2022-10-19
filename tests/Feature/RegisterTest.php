<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

     /** @test */
     public function user_can_register()

     {

     $this->artisan('passport:install');

     $this->post('api/players', [
     'name' => 'user1',
     'nickname' => 'user1',
     'email' => 'user1@user1.net',
     'password' => '123456',
     'password_confirmation' => '123456'])
     ->assertStatus(200);
         $this->assertDatabaseCount('users', 1);
    
    }
 
 
 
   /** @test */
      public function user_cant_register_with_empty_nickname()
     
      {

        $this->artisan('passport:install');

        $this->post('api/players', [
        'name' => "",
        'nickname' => 'user2',
        'email' => 'user2@user2.net',
        'password' => '123456',
        'password_confirmation' => '123456'
        ])
        ->assertInvalid([
         'name' => 'The name field is required.',
 
     ]);
     
      }
 
 
 
  /** @test */
   public function user_cant_register_with_empty_password()
   
   {

    $this->artisan('passport:install');

     $this->post('api/players', [
     'name' => "user2",
     'nickname' => 'user2',
     'email' => 'user2@user2.net',
     'password' => '',
     'password_confirmation' => '123456'
     ])
     ->assertInvalid([
      'password' => 'The password field is required.',
 
  ]);
  
   }
 
 
 
 /** @test */
 public function user_cant_register_with_empty_password_confirmation()
 
 {

   $this->artisan('passport:install');

   $this->post('api/players', [
   'name' => "user2",
   'nickname' => 'user2',
   'email' => 'user2@user2.net',
   'password' => '123456',
   'password_confirmation' => ''
   ])
   ->assertInvalid([
    'password' => 'The password confirmation does not match.',
 
   
 
 
 ]);
 
  
     }
}