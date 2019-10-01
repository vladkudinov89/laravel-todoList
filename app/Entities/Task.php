<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskList
 * @package App\Entities
 *
 * @property string name
 * @property string description
 * @property boolean is_complete
 */
class Task extends Model
{
    protected $table = 'task_lists';

    protected $fillable = [
        'name',
        'description',
        'is_complete'
    ];

    protected $casts = [
      'is_complete' => 'boolean'
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isComplete(): bool
    {
        return $this->is_complete;
    }
}
