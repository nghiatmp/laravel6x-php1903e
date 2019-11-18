@extends('admin.layout')
{{-- ke thua file layout --}}
@section('title','This is Update-Post')
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
          <li class="breadcrumb-item active">UpdatePost</li>
    </ol>
    <div class="row">
          <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <h3>Update Post</h3>
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

    <form action="{{ route('admin.handleupdatePost',['id'=>$info['id']])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
        
            <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="titlePost">Title (*)</label>
                    <input type="text" name="titlePost" class="form-control" id="titlePost" value="{{ $info['title'] }}">
                </div>
                 <div class="form-group">
                    <label for="sapo">Sapo (*)</label>
                    <textarea name="sapoPost" class="form-control" id="sapoPost">{!! $info['title'] !!}</textarea>
                </div>
                 <div class="form-group">
                    <p><img src="{{ URL::to('/') }}/upload/image/{{ $info['avatar'] }}" alt="{{ $info['title'] }}" width="120" height="150" class="img-fluid"></p>
                    <label for="avatarPost">Avatar  (*)</label>
                   <input type="file" name="avatar" class="form-control">
                </div>
                 
           </div>
         
           <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                <div class="form-group">
                     <label for="languagePost">Language  (*)</label>
                     <select name="languagePost" class="form-control" id="languagePost">
                       <option value="1" {{ $info['lang_id'] == 1 ? 'selected = selected' : '' }}> VietNamese</option>
                        <option value="2" {{ $info['lang_id'] == 2 ? 'selected = selected' : '' }}> English</option>
                      
                     </select>
                </div>
                 <div class="form-group">
                     <label for="catePost">Categories  (*)</label>
                     <select name="catePost" class="form-control" id="catePost">
                        <option value=""> ----- Choose ------</option>
                        @foreach($cates as $cate)
                        <option {{ $info['cate_id']== $cate['id'] ? 'selected = selected' : ''}}  value="{{ $cate['id'] }}"   >{{ $cate['name_cate'] }}</option>
                        @endforeach
                      
                     </select>
                </div>
                <div class="form-group">
                     <label for="publishDate">Publish Date</label>
                     <input type="text" name="publishDate" id="publishDate" class="form-control" value="{{ $info['publish_date'] }}">
                </div>
                {{-- chon tag bai viet --}}
                <div class="form-group">
                     <label for="tagPost">Tags (*)</label>
                     
                     <select name="tagPost[]" class="form-control js-multi-tag" id="tagPost" multiple="multiple">
                         @foreach($tags as $tag)
                        <option {{ in_array($tag['id'], $arrIdTag) ? 'selected = selected' : ''}}   value="{{ $tag['id'] }}">{{ $tag['name_tags'] }}</option>
                         @endforeach
                        
                     </select>
                </div>

                {{-- status bài viết --}}
                <div class="form-group">
                    <label for="status"> Status(*)</label>
                    <select name="status" class="form-control" id="status">
                        <option value="0" {{ $info['status'] == 0 ? 'selected = selected' : '' }}>Deactive</option>
                        <option value="1" {{ $info['status'] == 1 ? 'selected = selected' : '' }}>Active</option>}
                    
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
           </div>
       
        </div>

        <div class="row">
              <div class="col-12 col-sm-12 col-md-12">
                   <div class="form-group">
                      <label for="contentPost">Content  (*)</label>
                      <textarea name="contentPost" class="form-control" id="contentPost" row="5">{!! $info['content_web'] !!}</textarea>
                </div>
              </div>
        </div>
    </form>
@endsection



