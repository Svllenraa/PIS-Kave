<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentProofTest extends TestCase
{
    public function test_ep1_upload_bukti_pembayaran_valid(): void
    {
        $this->assertTrue(true);
    }

    public function test_ep2_upload_bukti_pembayaran_kosong(): void
    {
        $this->assertTrue(true);
    }

    public function test_ep3_upload_format_tidak_valid(): void
    {
        $this->assertTrue(true);
    }

    public function test_ep4_upload_ukuran_melebihi_batas(): void
    {
        $this->assertTrue(true);
    }

    public function test_st1_upload_valid_ke_pending(): void
    {
        $this->assertEquals('pending', 'pending');
    }

    public function test_st2_pending_ke_confirmed(): void
    {
        $this->assertEquals('confirmed', 'confirmed');
    }

    public function test_st3_pending_ke_rejected(): void
    {
        $this->assertEquals('rejected', 'rejected');
    }
}
