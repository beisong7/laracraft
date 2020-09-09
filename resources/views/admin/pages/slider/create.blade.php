<?php
$sidenav['slider'] = 'active';
$title = "Slider / New";
?>

@section('other_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/basic.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    @include('admin.layouts.breadcrumb')
    @include('layouts.notice')

    <!-- Content Row -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5>Create New Slider</h5>
                        <hr>
                        <form method="POST" action="{{ route('slider.store') }}" aria-label="{{ __('new-slider') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="uuid" value="{{ $uuid }}">

                            <div class="form-group row">

                                <label for="name" class="col-md-2 col-form-label text-md-right">Images * (1 allowed)</label>

                                <div class="col-md-10">
                                    <div id="dropzone" class="dropzone" ></div>
                                    <p class="dz_respo text-danger mt-2 mb-0"></p>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Main Text</label>

                                <div class="col-md-10 ">
                                    <textarea id="" type="text" class="form-control myfield" name="main_text" placeholder="Main Slider Text (keep it short)">{{ old('main_text') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Options</label>

                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col">
                                            <p>Allow Button?</p>
                                            <select name="button" id="" class="form-control">
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <p>Image is clickable</p>
                                            <select name="is_url" id="" class="form-control">
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Image Link (optional)</label>

                                <div class="col-md-10">
                                    <input type="text" autocomplete="off" name="slider_url" value="{{ old('slider_url') }}" class="form-control" placeholder="Example: http://{{ env('SITE_DOMAIN') }}/products">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Button Text</label>

                                <div class="col-md-10">
                                    <input type="text" autocomplete="off" name="button_text" value="{{ old('button_text') }}" class="form-control" placeholder="Example: Learn More!, Get Now!, etc">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Button Link</label>

                                <div class="col-md-10">
                                    <input type="text" autocomplete="off" name="button_url" value="{{ old('button_url') }}" class="form-control" placeholder="Example: http://{{ env('SITE_DOMAIN') }}/products">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">More Text </label>

                                <div class="col-md-10">
                                    <textarea id="" type="text" class="form-control myfield" name="more_text" placeholder="Extra Slider Information">{{ old('more_text') }}</textarea>
                                </div>
                            </div>


                            <hr>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-outline-dark btn-block">
                                        Add Slider
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('other_js')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>

    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">

        let minImageWidth = 500;
        let minImageHeight = 200;

        let md = new Dropzone("#dropzone", {
            url: '{{ route('uploadSlider', !empty($uuid)?$uuid:old('uuid')) }}',
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFiles: 4,
            renameFile: function(file) {
                let dt = new Date();
                let time = dt.getTime();
                return time+file.name;
            },
            removedfile: function(file) {
                let name = file.upload.filename;
                console.log(file);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("sliderDelete", !empty($uuid)?$uuid:old('uuid')) }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                let fileRef;
                return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            addRemoveLinks: true,
            init: function () {
                this.on("thumbnail", function (file) {
                    if (file.width < minImageWidth || file.height < minImageHeight) {
                        file.rejectDimensions()
                    }
                    else {
                        file.acceptDimensions();
                    }
                });
            },
            accept: function (file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() {
                    done("Image width or height too small... min = 500 x 200.");
                    toastr(`The file '${file.name}' either has width or height too small. minimum 500 x 200 required.`);
                    setTimeout(() => {
                        file.previewElement.remove();
                    }, 5500);

                };

            },
            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                console.log(response);
                return false;
            }


        });

        function toastr(msg) {
            let dzr = $('.dz_respo');
            dzr.show();
            dzr.text(msg);
            setTimeout(() => {
                dzr.text("")
                dzr.hide()
            }, 5500);

        }

        function keeper() {
            Dropzone.options.dropzone =
                {
                    maxFilesize: 10,
                    renameFile: function(file) {
                        let dt = new Date();
                        let time = dt.getTime();
                        return time+file.name;
                    },
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 50000,
                    maxFiles: 4,
                    removedfile: function(file) {
                        let name = file.upload.uuid;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ route("sliderDelete", !empty($uuid)?$uuid:old('uuid')) }}',
                            data: {filename: name},
                            success: function (data){
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        let fileRef;
                        return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    }
                };
        }

    </script>

    <script>
        var editor_config = {
            path_absolute : "{{ URL::to('/') }}/",
            selector: "textarea.myfield",
            plugins: [
                "advlist autolink lists link charmap print hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime  nonbreaking save  textcolor contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],

            style_formats: [
                {title: 'Image Left', selector: 'img', styles: {
                    'float' : 'left',
                    'margin': '0 20px 0 10px'
                }},
                {title: 'Image Right', selector: 'img', styles: {
                    'float' : 'right',
                    'margin': '0 10px 0 20px'
                }}
            ],
            style_formats_merge: true,


            toolbar: " undo redo| styleselect | bold italic | alignleft aligncenter alignright alignjustify" +
            " | forecolor backcolor | bullist numlist outdent indent | link | fontsizeselect ",
            relative_urls: false,
            file_browser_callback : function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if(type == 'image'){
                    cmsURL = cmsURL + "&type=Images";
                }else{
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };
        tinymce.init(editor_config);
    </script>
@endsection