<div class="sidebar-box">
                <h3 class="heading mt-3">Popular Posts</h3>
                <div class="post-entry-sidebar">
                  <ul>
                    @foreach($view['popularPost'] as $k => $v )
                      <li>
                        <a href="{{ route('fr.detailBlog',['slug'=>$v['slug']]) }}">
                          <img src="{{ URL::to('/')}}/upload/image/{{ $v['avatar'] }}" alt="Image placeholder" class="mr-4">
                          <div class="text">
                            <h4>{{ $v['title'] }}</h4>
                            <div class="post-meta">
                              <span class="mr-2">{{ date('d/m/Y',strtotime($v['publish_date'])) }}</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>