<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KamarRequest extends FormRequest
{

    public function rules()
    {
        // Jika metode request adalah POST (create)
        if ($this->isMethod('post')) {
            return [
                'nomor_kamar' => [
                    'required',
                    Rule::unique('kamars', 'nomor_kamar'),
                ],
                'status_kamar'  => 'nullable',
                'harga_kamar'   => 'required|numeric',
                'penyewa_id'    => 'nullable|exists:penyewas,id',
                'files'         => 'nullable',
                'panjang_kamar' => 'nullable',
                'lebar_kamar' => 'nullable',
            ];
        } 
        // Jika metode request adalah PUT atau PATCH (update)
        elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'status_kamar'  => 'nullable',
                'harga_kamar'   => 'required|numeric',
                'penyewa_id'    => 'nullable|exists:penyewas,id',
                'files'         => 'nullable',
            ];
        }

        // Jika metode request bukan POST, PUT, atau PATCH
        return [];
    }
}