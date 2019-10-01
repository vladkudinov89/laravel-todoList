@csrf

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Title</label>

    <div class="control">
        <input
            type="text"
            class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full"
            name="name"
            placeholder="Task Title"
            required
            value="{{ $task->name }}">
    </div>
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="description">Description</label>

    <div class="control">
            <textarea
                name="description"
                rows="10"
                class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                placeholder="Task Description"
                required>{{ $task->description }}</textarea>
    </div>
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Task status</label>

    <div class="control">
        <select name="" id="">
            <option value="0"
            @if($task->is_complete == 0){{"selected"}}@else{{ "" }}@endif
            >Not Complete</option>
            <option value="1"
            @if($task->is_complete == 1){{"selected"}}@else{{ "" }}@endif
            >Complete</option>
        </select>
    </div>
</div>


<div class="field mb-6">
    <div class="control">
        <button type="submit" class="button is-link mr-2">Save</button>

        <a href="{{ route('tasks.show' , $task->id) }}" class="text-default">Cancel</a>
    </div>
</div>
