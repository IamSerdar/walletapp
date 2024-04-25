<form  action="{{ Route($data['title']) }}" method="get">
    <div class="row mb-3">
        <div class="col-md-11">
            <div class="form-group">
                <input type="text" name="q" class="form-control form-control-lg" value="{{ request('q') }}" placeholder="@lang('search')..." aria-label="search">
            </div>
        </div>
        <div class="col-md-1 text-right">
            <button class="btn btn-primary btn-lg"><em class="icon ni ni-search"></em></button>
        </div>
    </div>
</form>
