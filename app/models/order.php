<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    protected $table = 'narudzbina'; // Table name as per your SQL dump

    protected $fillable = ['user_id', 'oglas_id', 'dan_narucivanja']; // Fillable fields from the table

    public $timestamps = false; // Assuming 'dan_narucivanja' is handled by the database as timestamp

    // Relationships if needed (assuming one-to-many relationships)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'oglas_id');
    }
}

?>