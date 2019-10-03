@csrf

<div class="form-group">
    <label class="label text-sm mb-2 block" for="title">Title</label>

    <div class="control">
        <input
            type="text"
            class="input bg-transparent border border-muted-light rounded p-2 text-xs w-50
            @if($errors->has('name')) error @endif"
            name="name"
            placeholder="Task Title"
            required
            value="@if(old('name')){{old('name')}}@else{{ $task->name ?? ""  }}@endif"
        >
    </div>
    @if($errors->has('name'))
        <div class="alert alert-danger w-50">{{$errors->first('name')}}</div>
    @endif
</div>

<div class="form-group">
    <label class="label text-sm mb-2 block" for="description">Description</label>

    <div class="control">
            <textarea
                name="description"
                rows="10"
                class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-50
                @if($errors->has('name')) error @endif"
                placeholder="Task Description"
                required>@if(old('description')){{old('description')}}@else{{ $task->description ?? ""  }}@endif</textarea>
    </div>
    @if($errors->has('description'))
        <div class="alert alert-danger w-50">{{$errors->first('description')}}</div>
    @endif
</div>

<div class="form-group">
    <label class="label text-sm mb-3 block" for="title">Task status</label>

    <div>
        <select name="status" id="status" class="w-25">
            <option value="0"
            @if($task->status ?? 0 == 0){{"selected"}}@else{{ "" }}@endif
            >Not Complete
            </option>
            <option value="1"
            @if($task->status ?? 1 == 1){{"selected"}}@else{{ "" }}@endif
            >Complete
            </option>
        </select>
    </div>
</div>

<div class="">
    <button type="submit" class="btn btn-primary w-50">{{$buttonAction}}</button>
</div>
