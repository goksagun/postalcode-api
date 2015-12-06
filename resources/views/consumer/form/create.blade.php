<div class="well">
    <form role="form" method="post" action="{{ $consumer->name ? '/consumer/'.$consumer->id.'/settings' : '/consumer/create' }}">
        <legend>Application Details</legend>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="{{ $errors->has('name') ? 'form-group has-error' : 'form-group' }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name"
                           placeholder="Enter name" value="{{ old('name', $consumer->name) }}">
                </div>
            </div>
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            <span class="help-block help-static">Your application name. This is used to attribute the source of a tweet and in user-facing authorization screens. 32 characters max.</span>
        </div>
        <div class="{{ $errors->has('description') ? 'form-group has-error' : 'form-group' }}">
            <label for="description">Description <span class="text-danger">*</span></label>
            <input type="text" name="description" class="form-control" id="description"
                   placeholder="Enter description" value="{{ old('description', $consumer->description) }}">
            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
            <span class="help-block help-static">Your application description, which will be shown in user-facing authorization screens. Between 10 and 200 characters max.</span>
        </div>
        <div class="{{ $errors->has('website') ? 'form-group has-error' : 'form-group' }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="website">Website <span class="text-danger">*</span></label>
                    <input type="text" name="website" class="form-control"
                           id="website" placeholder="Website" value="{{ old('website', $consumer->website) }}">
                    {!! $errors->first('website', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
                <span class="help-block help-static">Your application's publicly accessible home page, where users can go to download, make use of, or find out more information about your application. This fully-qualified URL is used in the source attribution for tweets created by your application and will be shown in user-facing authorization screens. <br>
(If you don't have a URL yet, just put a placeholder here but remember to change it later.)</span>
        </div>
        <button type="submit" class="btn btn-default">{{ $consumer->name ? 'Update settings' : 'Create your application' }}</button>
    </form>
</div>