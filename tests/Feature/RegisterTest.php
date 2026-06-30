<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// REGISTER SUCCESS
test('register berhasil dengan data valid', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Gita Naisya Wardani',
        'email' => 'gitanaisyawardani@student.telkomuniversity.ac.id',
        'password' => 'Gnw@0987',
        'role' => 'mahasiswa'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Registrasi Berhasil'
        ]);
});

// NAMA KOSONG
test('register gagal jika nama kosong', function () {

    $response = $this->postJson('/api/register', [
        'name' => '',
        'email' => 'gitanaisyawarrdani@student.telkomuniversity.ac.id',
        'password' => 'Gnw@0987',
        'role' => 'mahasiswa'
    ]);

    $response->assertStatus(422);
});

// EMAIL INVALID
test('register gagal jika format email tidak valid', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Gita Naisya Wardani',
        'email' => 'gitanaisyawardanistudent.telkomuniversity.ac.id',
        'password' => 'Gnw@0987',
        'role' => 'mahasiswa'
    ]);

    $response->assertStatus(422);
});

// PASSWORD < 8
test('register gagal jika password kurang dari 8 karakter', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Gita Naisya Wardani',
        'email' => 'gitanaisyawardani@student.telkomuniversity.ac.id',
        'password' => 'Gnw@09',
        'role' => 'mahasiswa'
    ]);

    $response->assertStatus(422);
});

// PASSWORD KOSONG
test('register gagal jika password kosong', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Gita Naisya Wardani',
        'email' => 'gitanaisyawardani@student.telkomuniversity.ac.id',
        'password' => '',
        'role' => 'mahasiswa'
    ]);

    $response->assertStatus(422);
});
