{{-- Editing the question --}}
<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">
        <div class="level">

            <input class="form-control" type="text" v-model="form.title">


        </div>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <textarea class="form-control" rows="10" v-model="form.body"></textarea>
        </div>
    </div>

    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-primary btn-xs level-item" @click="update">Update</button>
            <button class="btn btn-xs" @click="resetForm">Cancel</button>

            @can('update', $thread)

                <form action="{{ $thread->path() }}" class="ml-a" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>



{{-- Viewing the question --}}
<div class="panel panel-default" v-else>
    <div class="panel-heading">
        <div class="level">
            <img src="{{ $thread->creator->avatar_path }}" width="50" height="50" alt="{{ $thread->creator->name }}"
                class="mr-1">
            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                posted: <span v-text="title"></span>
            </span>
        </div>
    </div>

    <div class="panel-body" v-text="body"></div>

    <div class="panel-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-xs" @click="editing = true">Edit</button>
    </div>
</div>
