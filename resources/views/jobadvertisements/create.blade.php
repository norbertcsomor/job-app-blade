<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

<div class="card-header card-title">
    <strong>Álláshirdetés létrehozása</strong>
</div>

<div class="card-body">

    <form method="POST" action="/jobadvertisements">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Munkakör megnevezése:</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" />

            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Munkavégzés helye:</label>
            <input type="text" class="form-control" name="location" placeholder="" value="{{ old('location') }}" />

            @error('location')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">
                Állás részletezése:
            </label>
            <textarea class="ckeditor form-control" name="description" rows="10" value="{{ old('description') }}"></textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center">
            <button class="btn btn-success" type="submit">
                Álláshirdetés létrehozása
            </button>
        </div>
    </form>
</div>
