<div class="sidebar-box">
<h3 class="heading">Categories</h3>
<ul class="categories">
  
  @foreach($view['catePost'] as $v)
  	<li><a href="{{ route('fr.categories',['slug'=>Str::slug($v['name_cate'],'-'),'id'=>$v['id']]) }}">{{ $v['name_cate']  }} <span>({{ $v['sl'] }})</span></a></li>
  @endforeach
</ul>
</div>