<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskList
 * @package App\Entities
 *
 * @property string $name
 * @property string $description
 * @property boolean $status
 */
class Task extends Model
{
    protected $table = 'task_lists';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
      'status' => 'boolean'
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function path(): string
    {
        return "tasks/{$this->id}";
    }
}
