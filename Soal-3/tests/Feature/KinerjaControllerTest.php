<?php

use function Pest\Laravel\postJson;


test('response has correct structure', function () {
    $response = postJson('/kinerja', [
        'hasil_kerja' => 'diatas ekspektasi',
        'perilaku' => 'diatas ekspektasi',
    ]);

    // dd($response->json());

    $response->assertStatus(200)
        ->assertJsonStructure([
            'predikat_kinerja',
        ]);
});
