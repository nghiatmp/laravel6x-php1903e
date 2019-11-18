@extends('admin.layout')
{{-- ke thua file layout --}}
@section('title','This is Post')
{{-- day view con sang file layout dang doi san --}}
@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">POST</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class="row">
      @if($createPostSuccess)
        <div class="alert alert-success">
            <span>{{ $createPostSuccess }}</span>
        </div>
    @endif
      @if($UpdatePostSuccess)
        <div class="alert alert-success">
            <span>{{ $UpdatePostSuccess }}</span>
        </div>
    @endif
        <div class="col-12 col-sm-12 col-lg-12">

           <div class="row">
                 <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                       <a href="{{ route('admin.createPost') }}" class="btn btn-primary btn-sm">Create Post</a>
                        <a href="{{ route('admin.post') }}" class="btn btn-primary btn-sm">View All</a>
                  </div>
                  <div class="col-12 col-sm-12 col-lg-6 col-md-6">
                        <div class="input-group mb-3">
                              <input type="text" name="" class="form-control w-75" id="js-keyword" value="{{ $keyword }}">
                              <div class="input-group-append">
                                  <span class="input-group-text" id="js-search">Search</span>
                              </div>
                        </div>
                  </div>

           </div>
            
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Tags</th>
                  <th>Author</th>
                  <th>Publish Date</th>
                  <th>View</th>
                  <th colspan="2" width="5%">AcTion</th>
                </tr>
              </thead>
              <tbody>
                @foreach($listPost as $key => $post)
                  <tr class="js-post-{{ $post['id'] }}">
                    <td>{{ $post['id'] }}</td>
                    <td>
                        <img src="{{ URL::to('/') }}/upload/image/{{ $post['avatar'] }}" alt="{{ $post['title'] }}" width="120" height="120" class="img-fluid">
                    </td>
                    <td>
                        <h5>{{ $post['title'] }}</h5>
                        <div class="my-2">
                          <p style="font-size:10px">{!! $post['sapo'] !!}</p>
                        </div>
                    </td>
                   <td>{{ $post['name_cate'] }}</td>
                   <td>
                        @if($post['listTags'])
                            @foreach($post['listTags'] as $item)
                              <p class="border-bottom">  {!! $item  !!} </p>

                            @endforeach
                        @endif
                   </td>
                   <td>{{ $post['fullname'] }}</td>
                   <td>{{ $post['publish_date'] }}</td>
                   <td>{{ $post['count_view'] }}</td>
                   <td>
                        <button id="{{ $post['id'] }}" type="" class=" btn btn-danger btn-sm js-delete-post">Delete</button>
                   </td>
                    <td>
                        <a href="{{ route('admin.editPost',['slug' => $post['slug'] ,'id'=>$post['id']]) }}" class="btn btn-info btn-sm">Update</a>
                   </td>
                  </tr>
                @endforeach
              </tbody>
            </table>


            <div class="w-100px mt-5" style=" margin: auto;width: 100px">
                   {{ $paginate->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')

<script type="text/javascript">
    $(function(){
        $('.js-delete-post').click(function(){
            var self = $(this);
            var idpost = self.attr('id').trim();
            if($.isNumeric(idpost)){
                $.ajax({
                    url:"{{ route('admin.deletePost') }}",
                    type:"POST",
                    data:{id:idpost},
                    beforesend: function(){
                        self.text('Loading...');
                    },
                    success:function(data){
                         self.text('Delete');
                         if(data ==='fail'|| data ==='err'){
                              alert('Có Lỗi Xảy ra Vui lòng thử lại');
                         }else{
                              $('.js-post-'+idpost).hide();
                              alert('xoa thanh cong');
                         }
                    }
                });
            }
        });

        $('#js-search').click(function(){
            var keyword = $('#js-keyword').val().trim();
            // alert(keyword);
            if(keyword.length > 0){
                window.location.href = "{{ route('admin.post') }}"+"?keyword="+keyword;
            }
        });
    });
</script>
@endpush

