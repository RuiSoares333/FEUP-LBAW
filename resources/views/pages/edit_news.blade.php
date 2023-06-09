@extends('layouts.app')
@section('page-title', 'Edit News Post')
@section('content')

    @include('partials.header')

    <section class="p-3 p-lg-5 my-5 col-12 col-lg-10 container-xl">
        <h2 class="h2 fw-bold">Create a Post</h2>
        <hr class="rounded">

        <section class="container w-100 mt-4 form-group">
            <form method="POST" enctype="multipart/form-data" id="create_news_form" name="edit_form" action="{{ route('update_news') }}" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="news_post_id" value="{{$newspost->id}}">
                <section id="title" class="mb-5">
                    <label for="new-post-title" class="h5 form-label">Title</label>
                    <input type="text" class="form-control" id="new-post-title" name="title" value="{{ $newspost -> title }}" required>
                    @foreach($errors->get('title') as $error)
                        <li class="error">{{$error}}</li>
                    @endforeach
                </section>

                <section id="body" class="mb-5">
                    <label for="editor-body" class="h5 form-label">Content</label>
                    <textarea id="editor-body" name="content">{!! $newspost->content !!}</textarea>
                    @foreach($errors->get('body') as $error)
                        <li class="error">{{$error}}</li>
                    @endforeach
                </section>

                <section id="tags" class="mb-5">
                    <label for="select-tags" class="h5 form-label">Tags - </label> <span>Select 5 tags at most</span>
                        <div id="tag-list" style="overflow-y: hidden; max-height: 15vh;" required>   
                            <input id="radio-for-checkboxes" class="d-none" type="radio" name="radio-for-required-checkboxes" required/> <!-- needs to be hidden in css -->
                            @foreach($tags as $tag)
                                <label for="{{ $tag->tag_name }}">
                                    @if($tag->checked)
                                        <input type="checkbox" id="{{ $tag->tag_name }}" class="check" value="{{ $tag->tag_name }}" name="tags[]" checked/> 
                                    @else
                                        <input type="checkbox" id="{{ $tag->tag_name }}" class="check" value="{{ $tag->tag_name }}" name="tags[]"/> 
                                    @endif
                                    {{ $tag->tag_name }}
                                </label>
                            @endforeach
                        </div>
                        <div id="tag-selection" class="d-flex justify-content-center"><i class="bi bi-chevron-down"></i></div>
                    @foreach($errors->get('tags') as $error)
                        <li class="error">{{$error}}</li>
                    @endforeach
                </section>

                <section id="submission" class="container create_post_buttons mb-2 mb-lg-0">
                    <div class="row d-flex justify-content-around">
                        <button type="button" class="col-5 col-md-4 col-lg-3 btn fw-bold"
                                onclick="window.location.href=document.referrer">Cancel
                        </button>
                        <button type="button" onclick="submitEdit()" id="create_news_button" class="col-5 col-md-4 col-lg-3 btn text-light fw-bold">Edit</button>
                    </div>
                </section>
            </form>
        </section>
    </section>
    
@endsection

@section('scripts')
    <!-- TinyMCE -->
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute : "{{ URL::to('/') }}/",
            selector: "textarea#editor-body",
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
            tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
            tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
            tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
            tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
            mobile: {
                plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
            },
            menu: {
                tc: {
                title: 'Comments',
                items: 'addcomment showcomments deleteallconversations'
                }
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                })
            },
        };
        tinymce.init(editor_config);
    </script>

    <script>        
        var tagSel = document.getElementById("tag-selection");

        var downIcon = document.createElement("i");
        downIcon.setAttribute("class","bi bi-chevron-down");
        var upIcon = document.createElement("i");
        upIcon.setAttribute("class","bi bi-chevron-up");

        tagSel.addEventListener("click", function() {
            this.classList.toggle("active");
            var tagList = this.previousElementSibling;
            if (tagList.style.overflowY === "hidden") {
                tagList.style.overflowY = "scroll";
                tagList.style.maxHeight = "25vh";
                this.removeChild(this.firstChild);
                this.appendChild(upIcon);
            } else {
                tagList.style.overflowY = "hidden";
                tagList.style.maxHeight = "15vh";
                this.removeChild(this.firstChild);
                this.appendChild(downIcon);
            }
        });
    </script>

    <script>
        function submitEdit(){
            document.forms["edit_form"].submit(); 
        }
    </script>

    <script>
        var checks = document.querySelectorAll(".check");
        var max = 5;
        for (var i = 0; i < checks.length; i++)
        checks[i].onclick = selectiveCheck;

        function selectiveCheck (event) {
        var checkedChecks = document.querySelectorAll(".check:checked");
        if (checkedChecks.length >= max + 1)
            return false;
        }

    var inputs = document.querySelectorAll('[name="tags[]"]')
    var radioForCheckboxes = document.getElementById('radio-for-checkboxes')

    function checkCheckboxes () {
        var isAtLeastOneServiceSelected = false;

        for(var i = inputs.length-1; i >= 0; --i) {
            if (inputs[i].checked) isAtLeastOneCheckboxSelected = true;
        }
        radioForCheckboxes.checked = isAtLeastOneCheckboxSelected;
    }

    function checkCheckboxes2 () {
    var allCheckboxesDeselected = true;

    for(var i = inputs.length-1; i >= 0; --i) {
        if (inputs[i].checked) {
            allCheckboxesDeselected = false;
            break;
        }
    }
    radioForCheckboxes.checked = !allCheckboxesDeselected;
    }

    for(var i = inputs.length-1; i >= 0; --i) {
        inputs[i].addEventListener('change', checkCheckboxes);
        inputs[i].addEventListener('change', checkCheckboxes2);
    }
    </script>

@endsection