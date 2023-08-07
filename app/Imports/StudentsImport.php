<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class StudentsImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return User::updateOrCreate(
            [
                'email' => strtolower($row['email']),
            ],
            [
                'id' => Str::uuid()->toString(),
                'first_name' => trim($row['first_name']),
                'middle_name' => trim($row['middle_name']),
                'last_name' => trim($row['last_name']),
                'gender' => ucwords($row['gender']),
                'phone_1' => $row['phone'],
                'password' => strtolower(trim($row['last_name'])),
                'email_verified_at' => now(),
                'account_type' => 'Student',
                'created_by' => Auth::user()->id,
            ]
        );
    }
}
