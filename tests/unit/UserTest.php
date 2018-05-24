<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase{
    public function testGetAndSetName(){
        $user = new User();
        $user->setFirstName('Ibrahim');
        $user->setLastName('Ahmed');
        $this->assertEquals($user->getFirstName(),'Ibrahim');
        $this->assertEquals($user->getLastName(),'Ahmed');
        $this->assertEquals($user->getFullName(),'Ibrahim Ahmed');
    }

    public function testNameAreTrimed(){
        $user = new User();
        $user->setFirstName('  Ibrahim  ');
        $user->setLastName('  Ahmed  ');
        $this->assertEquals($user->getFirstName(),'Ibrahim');
        $this->assertEquals($user->getLastName(),'Ahmed');
    }

    public function testEmailSetAndGet(){
        $user = new User();
        $user->setEmail('ibrahim21383@gmail.com');
        $this->assertEquals($user->getEmail(),'ibrahim21383@gmail.com');
    }

    public function testGetEmailVariables(){
        $user = new User();
        $user->setFirstName('Ibrahim');
        $user->setLastName('Ahmed');
        $user->setEmail('ibrahim21383@gmail.com');
        $emailVariables = $user->getEmailVariables();
        $this->assertArrayHasKey('full_name',$emailVariables);
        $this->assertArrayHasKey('email',$emailVariables);
        $this->assertEquals($emailVariables['full_name'],'Ibrahim Ahmed');
        $this->assertEquals($emailVariables['email'],'ibrahim21383@gmail.com');
    }
}
