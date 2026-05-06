<?php

namespace App\Models;

use Database\Factories\StaffFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'role', 'shift'])]
class Staff extends Model
{
    /** @use HasFactory<StaffFactory> */
    use HasFactory;
}
