<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow the convention (plural of model name)
    protected $table = 'oglasi';

    // Specify the primary key field
    protected $primaryKey = 'id';

    // If the primary key is not an incrementing integer
    public $incrementing = true;

    // Specify the primary key type if it's not an integer
    protected $keyType = 'int';

    // Enable the default Laravel timestamps handling
    public $timestamps = true;

    // Define the name of the "created at" column
    const CREATED_AT = 'datum_kreiranja';

    // Define the name of the "updated at" column if it exists, else leave it as null
    const UPDATED_AT = null;

    // Specify the fillable properties to allow mass assignment
    protected $fillable = [
        'naslov',
        'opis',
        'marka',
        'model',
        'godina',
        'cena',
        'kilometraza',
        'url_slike',
        'premium',
        'kreator_id'
    ];

    // Define a relationship to the user (creator of the ad)
    public function creator()
    {
        return $this->belongsTo(User::class, 'kreator_id');
    }
}

?>