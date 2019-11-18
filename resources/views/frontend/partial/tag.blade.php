<div class="sidebar-box">
<h3 class="heading">Tags</h3>
<ul class="tags">
  @foreach($view['tags'] as $tag)
      <li><a href="{{ route('fr.tag',['slug'=>Str::slug($tag['name_tags'],'-'),'id'=>$tag['id']]) }}">{{ $tag['name_tags'] }}</a></li>
  @endforeach

</ul>
</div>