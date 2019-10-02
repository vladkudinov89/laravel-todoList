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
            value="@if(old('name')){{old('name')}}@else{{ $task->name ?? ""  }}@endif"
        >
    </div>
    @if($errors->has('name'))
        <div class="alert alert-danger">{{$errors->first('name')}}</div>
    @endif
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="description">Description</label>

    <div class="control">
            <textarea
                name="description"
                rows="10"
                class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                placeholder="Task Description"
                required>@if(old('description')){{old('description')}}@else{{ $task->description ?? ""  }}@endif</textarea>
    </div>
    @if($errors->has('description'))
        <div class="alert alert-danger">{{$errors->first('description')}}</div>
    @endif
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Task status</label>

    <div class="control">
        <select name="status" id="status">
            <option value="0"
            @if($task->is_complete ?? 0 == 0){{"selected"}}@else{{ "" }}@endif
            >Not Complete</option>
            <option value="1"
            @if($task->is_complete ?? 1 == 1){{"selected"}}@else{{ "" }}@endif
            >Complete</option>
        </select>
    </div>
</div>


<div class="field mb-6">
    <div class="control">
        <button type="submit" class="button is-link mr-2">{{$buttonAction}}</button>
    </div>
</div>
