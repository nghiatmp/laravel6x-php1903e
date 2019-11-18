@extends('admin.layout')
{{-- ke thua file layout --}}
@section('title','This is Create-Post')
{{-- day view con sang file layout dang doi san --}}
@section('content')


@push('stylesheet')

    <link rel="stylesheet" href="{{ asset('admin/css/jquery.datetimepicker.min.css') }}">


    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/multiple-select.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css">
@endpush



@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script type="text/javascript" src={{ asset('admin/js/post.js') }}></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('admin/js/multiple-select.min.js') }}"></script> --}}

    <script type="text/javascript">
        $(function(){
            $('#publishDate').datetimepicker({
                format:'d-m-Y H:m:s',
            });
            $(".js-multi-tag").select2();
        })

    </script>
@endpush






    <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.post') }}">List-post</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class="row">
          <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <h3>Create Post</h3>
          </div>
    </div>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($errorPublishDate)
        <div class="alert alert-danger">
            <span>{{ $errorPublishDate }}</span>
        </div>
    @endif
     @if($ErrorAvatar)
        <div class="alert alert-danger">
            <span>{{ $ErrorAvatar }}</span>
        </div>
    @endif
    <form action="{{ route('admin.handlecreatePost')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
        
            <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="titlePost">Title (*)</label>
                    <input type="text" name="titlePost" class="form-control" id="titlePost">
                </div>
                 <div class="form-group">
                    <label for="sapo">Sapo (*)</label>
                    <textarea name="sapoPost" class="form-control" id="sapoPost"></textarea>
                </div>
                 <div class="form-group">
                    <label for="avatarPost">Avatar  (*)</label>
                   <input type="file" name="avatar" class="form-control">
                </div>
                 
           </div>
         
           <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <div class="form-group">
                     <label for="languagePost">Language  (*)</label>
                     <select name="languagePost" class="form-control" id="languagePost">
                       <option value="1"> VietNamese</option>
                        <option value="2"> English</option>
                      
                     </select>
                </div>
                 <div class="form-group">
                     <label for="catePost">Categories  (*)</label>
                     <select name="catePost" class="form-control" id="catePost">
                        <option value=""> ----- Choose ------</option>
                        @foreach($cates as $cate)
                        <option value="{{ $cate['id'] }}">{{ $cate['name_cate'] }}</option>
                        @endforeach
                      
                     </select>
                </div>
                <div class="form-group">
                     <label for="publishDate">Publish Date</label>
                     <input type="text" name="publishDate" id="publishDate" class="form-control">
                </div>
                {{-- chon tag bai viet --}}
                <div class="form-group">
                     <label for="tagPost">Tags (*)</label>
                     
                     <select name="tagPost[]" class="form-control js-multi-tag" id="tagPost" multiple="multiple">
                         @foreach($tags as $tag)
                        <option value="{{ $tag['id'] }}">{{ $tag['name_tags'] }}</option>
                         @endforeach
                        
                     </select>
                </div>
                <button type="submit" class="btn btn-primary">Publish Post</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
           </div>
       
        </div>

        <div class="row">
              <div class="col-12 col-sm-12 col-md-12">
                   <div class="form-group">
                      <label for="contentPost">Content  (*)</label>
                      <textarea name="contentPost" class="form-control" id="contentPost" row="5"></textarea>
                </div>
              </div>
        </div>
    </form>
@endsection



