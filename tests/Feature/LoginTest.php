<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    // EP1: Valid - Email terdaftar dan password benar
    public function test_ep1_login_berhasil_dengan_kredensial_yang_valid()
    {
        $user = User::factory()->create([
            'email' => 'azizahfitriawibisono@student.telkomuniversity.ac.id',
            'password' => bcrypt('Azzhftr._06'),
        ]);

        $response = $this->post('/login', [
            'email' => 'azizahfitriawibisono@student.telkomuniversity.ac.id',
            'password' => 'Azzhftr._06',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    // EP2: Invalid - Email tidak terdaftar
    public function test_ep2_login_gagal_karena_email_tidak_terdaftar()
    {
        $response = $this->post('/login', [
            'email' => 'tidakada@student.telkomuniversity.ac.id',
            'password' => 'Azzhftr._06',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // EP3: Invalid - Password salah
    public function test_ep3_login_gagal_karena_password_salah()
    {
        User::factory()->create([
            'email' => 'azizahfitriawibisono@student.telkomuniversity.ac.id',
            'password' => bcrypt('Azzhftr._06'),
        ]);

        $response = $this->post('/login', [
            'email' => 'azizahfitriawibisono@student.telkomuniversity.ac.id',
            'password' => 'SalahPassword123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // EP4: Invalid - Format email tidak sesuai
    public function test_ep4_login_gagal_karena_format_email_tidak_valid()
    {
        $response = $this->post('/login', [
            'email' => 'azizahfitriawibisonostudent.telkomuniversity.ac.id',
            'password' => 'Azzhftr._06',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // EP5: Invalid - Email kosong
    public function test_ep5_login_gagal_karena_email_tidak_diisi()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'Azzhftr._06',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // EP6: Invalid - Password kosong
    public function test_ep6_login_gagal_karena_password_not_diisi()
    {
        $response = $this->post('/login', [
            'email' => 'azizahfitriawibisono@student.telkomuniversity.ac.id',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
