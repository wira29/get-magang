@extends('dashboard.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Halaman Jurnal</h1>

        <div class="row">
            <div class="col-12">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                    <div class="alert-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Jurnal</h5>
                    </div>
                    <div class="card-body">
                        <form
                            id="form"
                            action="{{ route('updateJournal', $journal->id) }}"
                            method="POST"
                        >
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Judul</label>
                                    <input
                                        type="text"
                                        value="{{ $journal->title }}"
                                        name="title"
                                        class="form-control"
                                        placeholder="Membuat CRUD User"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <div class="clearfix">
                                        <div id="quill-toolbar">
                                            <span class="ql-formats">
                                                <select
                                                    class="ql-font"
                                                ></select>
                                                <select
                                                    class="ql-size"
                                                ></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-bold"
                                                ></button>
                                                <button
                                                    class="ql-italic"
                                                ></button>
                                                <button
                                                    class="ql-underline"
                                                ></button>
                                                <button
                                                    class="ql-strike"
                                                ></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select
                                                    class="ql-color"
                                                ></select>
                                                <select
                                                    class="ql-background"
                                                ></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-script"
                                                    value="sub"
                                                ></button>
                                                <button
                                                    class="ql-script"
                                                    value="super"
                                                ></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-header"
                                                    value="1"
                                                ></button>
                                                <button
                                                    class="ql-header"
                                                    value="2"
                                                ></button>
                                                <button
                                                    class="ql-blockquote"
                                                ></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-list"
                                                    value="ordered"
                                                ></button>
                                                <button
                                                    class="ql-list"
                                                    value="bullet"
                                                ></button>
                                                <button
                                                    class="ql-indent"
                                                    value="-1"
                                                ></button>
                                                <button
                                                    class="ql-indent"
                                                    value="+1"
                                                ></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-direction"
                                                    value="rtl"
                                                ></button>
                                                <select
                                                    class="ql-align"
                                                ></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button
                                                    class="ql-link"
                                                ></button>
                                            </span>
                                        </div>
                                        <div
                                            name="description"
                                            id="quill-editor"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            <button
                                type="reset"
                                class="btn btn-outline-secondary"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection @section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (!window.Quill) {
            return $(
                "#quill-editor,#quill-toolbar,#quill-bubble-editor,#quill-bubble-toolbar"
            ).remove();
        }
        var editor = new Quill("#quill-editor", {
            modules: {
                toolbar: "#quill-toolbar",
            },
            placeholder: "Type something",
            theme: "snow",
        });

        editor.container.firstChild.innerHTML = `{{ $journal->description }}`.replace(/&lt;/g, '<').replace(/&gt;/g, '>')

        $("#form").submit(function (e) {
            e.preventDefault();

            const url = $(this).attr("action");

            const editor_value = editor.container.firstChild.innerHTML;

            const fd = new FormData(document.getElementById("form"))
            fd.append("description", editor_value)

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: url,
                data: fd,
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function (e) {
                    window.location.href = `{{ route('journal.index', ['success' => '${e.message}']) }}`
                },
            });

        });
    });
</script>
@endsection
