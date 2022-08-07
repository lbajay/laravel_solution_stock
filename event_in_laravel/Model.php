<!--  we can trigger three way to event  -->



<?php
class PerformanceRate extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id"
    ];

    // first way 1.
    protected $dispatchesEvents = [
        'created' => Mailevent::class
    ];

    //second way  2.
    public static function boot()
    {
        parent::boot();
        static::creating(function ($employees) {
            $employees->name = strtolower($employees->name);
        });
    }
}
?>

<!--  third way 3 (is ) -->

<!-- 
 
step 1.
php artisan make:observer observername

step 2. ( link down code in EventServiceProvider)
    public function boot()
    {
        EventServiceProvider
        Modelname::observe(observername::class);
    }
-->