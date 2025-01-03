<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main" data-color="warning">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
      <img src="/assets/img/logos/mekeriaicon.png" class="navbar-brand-img h-100" alt="...">
      <span class="ms-3 font-weight-bold">Mekeria</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <!-- <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa fa-id-badge ps-2 pe-2 text-center text-dark {{ Request::is('dashboard') ? 'text-white' : 'text-dark' }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is(['user-management','add-user-management']) ? 'active' : '' }}" href="{{ url('user-management') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa fa-id-badge ps-2 pe-2 text-center text-dark {{ Request::is(['user-management','add-user-management']) ? 'text-white' : 'text-dark' }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Staff Management</span>
        </a>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#{{ 'menus-management' }}" class="nav-link {{ Request::is(['menus-management','category-management','menusaddon-management','add-menus-management','add-category-management','add-menusaddon-management']) ? 'active' : '' }}" aria-controls="rq" role="button" aria-expanded="{{ Request::is(['menus-management','category-management','menusaddon-management','add-menus-management','add-category-management','add-menusaddon-management']) ? 'true' : '' }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa fa-file-invoice ps-2 pe-2 text-center text-dark {{ Request::is('menus-management') ? 'text-white' : 'text-dark' }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Menus Management</span>
        </a>
        <div class="collapse {{ Request::is(['menus-management','category-management','add-menus-management','add-category-management','menusaddon-management','add-menusaddon-management']) ? 'show' : '' }}" id="{{ 'menus-management' }}" style="">
          <ul class="nav ms-4 ps-3">
            <li class="nav-item ">
              <a class="nav-link {{ Request::is(['menus-management','add-menus-management']) ? 'active' : '' }}" href="{{ url('menus-management') }}">
                <span class="sidenav-normal"> Menus
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link {{ Request::is(['category-management','add-category-management']) ? 'active' : '' }}" href="{{ url('category-management') }}">
                <span class="sidenav-normal"> Menus Category
                </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link {{ Request::is(['menusaddon-management','add-menusaddon-management']) ? 'active' : '' }}" href="{{ url('menusaddon-management') }}">
                <span class="sidenav-normal"> Topping
                </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#{{ 'order-management' }}" class="nav-link {{ Request::is(['order-management','add-order-management']) ? 'active' : '' }}" aria-controls="rq" role="button" aria-expanded="{{ Request::is(['order-management','add-order-management']) ? 'true' : '' }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa fa-file-invoice ps-2 pe-2 text-center text-dark {{ Request::is('order-management') ? 'text-white' : 'text-dark' }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Order Management</span>
        </a>
        <div class="collapse {{ Request::is(['order-management','add-order-management']) ? 'show' : '' }}" id="{{ 'order-management' }}" style="">
          <ul class="nav ms-4 ps-3">
            <li class="nav-item ">
              <a class="nav-link {{ Request::is(['order-management','add-order-management']) ? 'active' : '' }}" href="{{ url('order-management') }}">
                <span class="sidenav-normal"> Incoming order
                </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is(['reporting']) ? 'active' : '' }}" href="{{ url('reporting') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fa fa-id-badge ps-2 pe-2 text-center text-dark {{ Request::is(['reporting']) ? 'text-white' : 'text-dark' }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Reporting</span>
        </a>
      </li>

    </ul>
  </div> -->
  <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach ($items as $item)
                @php
                    $url = $item->url ?? '#';
                @endphp
                @if (!$item->submodule->isEmpty())
                    @php
                        $combine_url = $item->submodule->pluck('url')->toArray();
                    @endphp
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#{{ $item->url }}"
                            class="nav-link {{ Request::is($combine_url) ? 'active' : '' }}" aria-controls="rq"
                            role="button" aria-expanded="{{ Request::is($combine_url) ? 'true' : '' }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i style="font-size: 1rem;"
                                    class="fa fa-file-invoice ps-2 pe-2 text-center text-dark {{ Request::is($item->url) ? 'text-white' : 'text-dark' }} "
                                    aria-hidden="true"></i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $item->name }}</span>
                        </a>
                        <div class="collapse {{ Request::is($combine_url) ? 'show' : '' }}" id="{{ $item->url }}"
                            style="">
                            <ul class="nav ms-4 ps-3">
                                @foreach ($item->submodule as $submodule)
                                    <li class="nav-item ">
                                        <a class="nav-link {{ Request::is($submodule->url) ? 'active' : '' }}"
                                            href="{{ url($submodule->url) }}">
                                            <span class="sidenav-normal"> {{ $submodule->name }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($item->url) ? 'active' : '' }}"
                            href="{{ url($item->url) }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i style="font-size: 1rem;"
                                    class="fa fa-id-badge ps-2 pe-2 text-center text-dark {{ Request::is($item->url) ? 'text-white' : 'text-dark' }} "
                                    aria-hidden="true"></i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $item->name }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>