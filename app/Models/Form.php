<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
    ];

    /**
     * @return HasMany
     */
    public function data(): HasMany
    {
        return $this->hasMany(FormData::class);
    }

    /**
     * @return false|string
     */
    public function fieldsJson()
    {
        return json_encode($this->fields);
    }

    /**
     * @param  array  $fields
     */
    public function setFields(array $fields): void
    {
        $this->update(['fields' => $fields]);
    }

    public function clearFields(): void
    {
        $this->update(['fields' => []]);
    }

    /**
     * @param  string  $name
     * @return mixed
     */
    public static function get(string $name = null)
    {
        return self::latest()->first();
    }

    /**
     * @param  array  $formData
     * @param  Form|null  $form
     * @return Form
     */
    public static function saveModel(
        array $formData,
        Form $form = null
    ) {
        if (!$form) {
            $form = new Form();
        }

        $form->title = $formData['title'];
        $form->save();

        $form->setFields($formData['fields'] ?? []);

        return $form;
    }
}
